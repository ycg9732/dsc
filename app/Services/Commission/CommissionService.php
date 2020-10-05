<?php

namespace App\Services\Commission;

use App\Models\Category;
use App\Models\Goods;
use App\Models\MerchantsServer;
use App\Models\MerchantsShopInformation;
use App\Models\OrderGoods;
use App\Models\OrderInfo;
use App\Models\OrderReturn;
use App\Models\OrderSettlementLog;
use App\Models\ReturnGoods;
use App\Models\SellerAccountLog;
use App\Models\SellerBillGoods;
use App\Models\SellerBillOrder;
use App\Models\SellerBillOrderReturn;
use App\Models\SellerCommissionBill;
use App\Models\SellerNegativeBill;
use App\Models\SellerNegativeOrder;
use App\Repositories\Common\BaseRepository;
use App\Repositories\Common\DscRepository;
use App\Repositories\Common\TimeRepository;
use App\Services\Cart\CartCommonService;
use App\Services\Common\CommonManageService;
use App\Services\Order\OrderCommonService;
use App\Services\Order\OrderGoodsService;
use App\Services\Order\OrderRefoundService;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    protected $baseRepository;
    protected $dscRepository;
    protected $timeRepository;
    protected $config;
    protected $commonManageService;
    protected $orderCommonService;
    protected $orderRefoundService;
    protected $orderGoodsService;
    protected $cartCommonService;

    public function __construct(
        BaseRepository $baseRepository,
        DscRepository $dscRepository,
        TimeRepository $timeRepository,
        CommonManageService $commonManageService,
        OrderCommonService $orderCommonService,
        OrderRefoundService $orderRefoundService,
        OrderGoodsService $orderGoodsService,
        CartCommonService $cartCommonService
    )
    {
        $this->baseRepository = $baseRepository;
        $this->dscRepository = $dscRepository;
        $this->timeRepository = $timeRepository;
        $this->config = $this->dscRepository->dscConfig();
        $this->commonManageService = $commonManageService;
        $this->orderCommonService = $orderCommonService;
        $this->orderRefoundService = $orderRefoundService;
        $this->orderGoodsService = $orderGoodsService;
        $this->cartCommonService = $cartCommonService;
    }

    /**
     * 商家佣金比例信息
     *
     * @param int $ru_id
     * @return mixed
     */
    public function getSellerCommissionInfo($ru_id = 0)
    {
        $row = MerchantsServer::where('user_id', $ru_id);
        $row = $row->with('getMerchantsPercent');
        $row = $this->baseRepository->getToArrayFirst($row);

        if (isset($row['get_merchants_percent']) && $row['get_merchants_percent']) {
            $row = $this->baseRepository->getArrayMerge($row, $row['get_merchants_percent']);
        }

        return $row;
    }

    /**
     * 账单商家列表缓存文件
     *
     * @return mixed
     * @throws \Exception
     */
    public function getCacheSellerList()
    {
        $res = MerchantsShopInformation::where('merchants_audit', 1);

        $res = $res->with([
            'getMerchantsServer' => function ($query) {
                $query->with([
                    'getMerchantsPercent'
                ]);
            }
        ]);

        $res = $res->orderBy('sort_order');

        $res = $this->baseRepository->getToArrayGet($res);

        if ($res) {
            foreach ($res as $key => $row) {
                $server = $row['get_merchants_server'] ?? [];

                $server_info = [];
                if (isset($server['get_merchants_percent']) && $server['get_merchants_percent']) {
                    $server_info = $this->baseRepository->getArrayMerge($server, $server['get_merchants_percent']);
                }

                if (isset($server_info['cycle']) && $server_info['cycle'] > 0) {
                    $row['cycle'] = $server_info['cycle'];
                } else {
                    $row['cycle'] = 0;
                }

                $row['seller_id'] = $row['user_id'];
                $row['day_number'] = $server_info['day_number'] ?? 0;
                $row['bill_time'] = $server_info['bill_time'] ?? 0;
                $row['percent_value'] = $server_info['percent_value'] ?? 0;
                $row['commission_model'] = $server_info['commission_model'] ?? 0;

                $res[$key] = $row;
            }

            cache()->forever('seller_list', $res);
        }

        return $res;
    }

    /**
     * 账单信息
     *
     * @param int $id
     * @param int $start_time
     * @param int $end_time
     * @return mixed
     */
    public function getBillDetail($id = 0, $start_time = 0, $end_time = 0)
    {
        $row = SellerCommissionBill::whereRaw(1);

        if ($id) {
            $row = $row->where('id', $id);
        }

        if ($start_time) {
            $row = $row->where('start_time', '>=', $start_time);
        }

        if ($end_time) {
            $row = $row->where('end_time', '<=', $end_time);
        }

        $row = $row->with([
            'getMerchantsServer' => function ($query) {
                $query->select('user_id', 'commission_model', 'bill_freeze_day');
            }
        ]);

        $row = $this->baseRepository->getToArrayFirst($row);

        if ($row) {

            /* 负账单信息 */
            $negative_bill = $this->getNegativeBllTotal($row['seller_id'], $row['end_time']);

            $row['negative_bill'] = $negative_bill;
            $row['negative_bill']['format_amount'] = $this->dscRepository->getPriceFormat($negative_bill['amount'], false);
            $row['negative_bill']['format_shippingfee'] = $this->dscRepository->getPriceFormat($negative_bill['shippingfee'], false);
            $row['negative_bill']['format_total'] = $this->dscRepository->getPriceFormat($negative_bill['total'], false);

            $row = $this->baseRepository->getArrayMerge($row, $row['get_merchants_server']);

            $row['bill_freeze_day'] = isset($row['bill_freeze_day']) ? $row['bill_freeze_day'] : 0;

            /** 合计已单独结算订单佣金金额 start **/
            $row['settle_accounts'] = 0;
            if ($row['chargeoff_status'] == 1 || $row['chargeoff_status'] == 3) {
                $order_id = $this->getBillOrderInfo($row['id'], $row['start_time'], $row['end_time']);
                $row['settle_accounts'] = $this->getOrderTakeBrokerage($row['seller_id'], $order_id, $row['chargeoff_time']);
            } elseif ($row['chargeoff_status'] == 2) {
                if ($row['actual_amount'] > 0) {
                    $row['settle_accounts'] = $row['should_amount'] - $row['actual_amount'];
                }
            }
            /** 合计已单独结算订单佣金金额 end **/

            $row['format_rate_fee'] = $this->dscRepository->getPriceFormat($row['rate_fee'], false);
            $row['format_order_amount'] = $this->dscRepository->getPriceFormat($row['order_amount'], false);

            $row['format_return_fee'] = $this->dscRepository->getPriceFormat($row['return_amount'], false);
            $row['format_shipping_fee'] = $this->dscRepository->getPriceFormat($row['return_shippingfee'], false);

            $row['format_shipping_amount'] = $this->dscRepository->getPriceFormat($row['shipping_amount'], false);
            $row['format_return_amount'] = $this->dscRepository->getPriceFormat($row['return_amount'] + $row['return_shippingfee'], false);

            $row['proportion'] = isset($row['proportion']) && !empty($row['proportion']) ? $row['proportion'] : 0;
            $row['gain_proportion'] = round(100 - $row['proportion'], 2);
            $row['should_proportion'] = $row['proportion'];

            $detail_other = [
                'seller_id' => $row['seller_id'],
                'bill_id' => $row['id'],
                'start_time' => $row['start_time'],
                'end_time' => $row['end_time'],
                'proportion' => $row['proportion'],
                'chargeoff_time' => $row['chargeoff_time'],
                'commission_model' => $row['commission_model'],
                'order_status' => OS_RETURNED
            ];
            $detail_list = $this->billDetailList(1, $detail_other);

            $row['gain_commission'] = floatval($row['gain_commission']);
            $row['should_amount'] = floatval($row['should_amount']);

            if ($detail_list) {
                if ($row['gain_commission'] > 0) {
                    $row['gain_commission'] = number_format($row['gain_commission'] - $detail_list['all_gain_commission'], 2, '.', '');
                }

                if ($row['should_amount'] > 0) {
                    $row['should_amount'] = number_format($row['should_amount'] - $detail_list['all_should_amount'], 2, '.', '');
                }
            }

            $row['negative_amount'] = floatval($row['negative_amount']);

            if ($row['negative_amount'] == 0) {
                $row['format_negative_amount'] = $this->dscRepository->getPriceFormat($row['negative_bill']['total'], false);
            } else {
                $row['format_negative_amount'] = $this->dscRepository->getPriceFormat($row['negative_amount'], false);
            }

            $row['format_gain_commission'] = $this->dscRepository->getPriceFormat($row['gain_commission'], false);
            $row['format_should_amount'] = $this->dscRepository->getPriceFormat($row['should_amount'] - $row['settle_accounts'], false);
            $row['format_frozen_money'] = $this->dscRepository->getPriceFormat($row['frozen_money'], false);

            $row['format_chargeoff_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row['chargeoff_time']);
            $row['format_start_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row['start_time']);
            $row['format_end_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row['end_time']);
            $row['format_settleaccounts_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row['settleaccounts_time']);
            $row['format_apply_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row['apply_time']);
        }

        return $row;
    }

    /**
     * 查询账单订单
     *
     * @param int $id 账单ID
     * @param int $start_time 账单开始时间
     * @param int $end_time 账单结束时间
     * @return mixed
     */
    public function getBillOrderInfo($id = 0, $start_time = 0, $end_time = 0)
    {
        $where = [
            'start_time' => $start_time,
            'end_time' => $end_time
        ];
        $order_id = SellerBillOrder::selectRaw("GROUP_CONCAT(order_id) AS order_id")
            ->where('bill_id', $id)
            ->where(function ($qeury) use ($where) {
                $qeury->where('confirm_take_time', '>=', $where['start_time'])
                    ->where('confirm_take_time', '<=', $where['end_time']);
            })
            ->value('order_id');

        $order_id = $order_id ? $order_id : 0;

        return $order_id;
    }

    /**
     * 查询已单独结算佣金金额
     *
     * @param int $seller_id
     * @param int $order_id
     * @param int $chargeoff_time
     * @return mixed
     */
    public function getOrderTakeBrokerage($seller_id = 0, $order_id = 0, $chargeoff_time = 0)
    {
        $res = SellerAccountLog::selectRaw("SUM(amount) AS amount")
            ->where('is_paid', 1)
            ->where('log_type', 1)
            ->where('add_time', '>', $chargeoff_time);

        if ($seller_id) {
            $res = $res->where('ru_id', $seller_id);
        }

        if ($order_id) {
            $order_id = $this->baseRepository->getExplode($order_id);
            $res = $res->whereIn('order_id', $order_id);
        }

        $res = $res->whereHas('getSellerBillOrder');

        $res = $res->value('amount');

        return $res;
    }

    /**
     * 账单列表
     *
     * @param int $ajax_bill 检测出账单
     * @return array
     */
    public function commissionBillList($ajax_bill = 0)
    {
        $adminru = $this->commonManageService->getAdminIdSeller();
        $seller_path = $this->commonManageService->isAdminSellerPath();

        /* 过滤信息 */
        if ($seller_path == 2) {
            $filter['id'] = $adminru['ru_id'];
        } else {
            $filter['id'] = empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']);
        }

        $filter['sort_by'] = isset($_REQUEST['sort_by']) && !empty($_REQUEST['sort_by']) ? trim($_REQUEST['sort_by']) : 'end_time';
        $filter['sort_order'] = isset($_REQUEST['sort_order']) && !empty($_REQUEST['sort_order']) ? trim($_REQUEST['sort_order']) : 'DESC';

        $filter['bill_sn'] = isset($_REQUEST['bill_sn']) && !empty($_REQUEST['bill_sn']) ? trim($_REQUEST['bill_sn']) : '';
        $filter['start_time'] = isset($_REQUEST['start_time']) && !empty($_REQUEST['start_time']) ? trim($_REQUEST['start_time']) : '';
        $filter['start_time'] = !empty($filter['start_time']) ? $this->timeRepository->getLocalStrtoTime($filter['start_time']) : '';
        $filter['end_time'] = isset($_REQUEST['end_time']) && !empty($_REQUEST['end_time']) ? trim($_REQUEST['end_time']) : '';
        $filter['end_time'] = !empty($filter['end_time']) ? $this->timeRepository->getLocalStrtoTime($filter['end_time']) : '';
        $filter['bill_apply'] = isset($_REQUEST['bill_apply']) && !empty($_REQUEST['bill_apply']) ? intval($_REQUEST['bill_apply']) : -1;

        /* 分页大小 */
        $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        $page_size = request()->cookie('dsccp_page_size');
        if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0) {
            $filter['page_size'] = intval($_REQUEST['page_size']);
        } elseif (intval($page_size) > 0) {
            $filter['page_size'] = intval($page_size);
        } else {
            $filter['page_size'] = 15;
        }

        /* 查询 */
        $res = SellerCommissionBill::whereRaw(1);

        if ($filter['id']) {
            $res = $res->where('seller_id', $filter['id']);
        }

        if ($filter['bill_sn']) {
            $res = $res->whereRaw("bill_sn LIKE '%" . $filter['bill_sn'] . "%'");
        }

        if ($filter['start_time']) {
            $res = $res->where('start_time', '>=', $filter['start_time']);
        }

        if ($filter['end_time']) {
            $res = $res->where('end_time', '<=', $filter['end_time']);
        }

        if ($filter['bill_apply'] > -1) {
            $res = $res->where('bill_apply', $filter['bill_apply'])
                ->where('chargeoff_status', 1);
        }

        $row = $res;

        if ($ajax_bill == 0) {
            $record_count = $res;

            $filter['record_count'] = $record_count->count();
            $filter['page_count'] = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;

            $row = $row->orderBy($filter['sort_by'], $filter['sort_order']);

            $start = ($filter['page'] - 1) * $filter['page_size'];
            if ($start > 0) {
                $row = $row->skip($start);
            }

            if ($filter['page_size'] > 0) {
                $row = $row->take($filter['page_size']);
            }
        } else {
            $row = $row->where('chargeoff_status', 0);
        }

        $row = $row->with([
            'getMerchantsServer' => function ($query) {
                $query->select('user_id', 'commission_model', 'bill_freeze_day');
            }
        ]);

        $row = $this->baseRepository->getToArrayGet($row);

        $gmtime = $this->timeRepository->getGmTime();

        /* 格式话数据 */
        if ($row) {
            foreach ($row as $key => $value) {
                $value['model'] = $value['commission_model'];

                $value = $this->baseRepository->getArrayMerge($value, $value['get_merchants_server']);

                $value['bill_freeze_day'] = isset($value['bill_freeze_day']) ? $value['bill_freeze_day'] : 1;
                $row[$key] = $value;

                $row[$key]['model'] = $value['model'];

                $row[$key]['format_settleaccounts_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $value['settleaccounts_time']);
                $row[$key]['format_start_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $value['start_time']);
                $row[$key]['format_end_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $value['end_time']);

                //出账时间
                $chargeoff_time = $value['chargeoff_time'] + 24 * 3600 * $value['bill_freeze_day'];

                if ($gmtime > $chargeoff_time) {
                    $row[$key]['is_bill_freeze'] = 1;
                } else {
                    $row[$key]['is_bill_freeze'] = 0;
                }

                //未出账单
                if (empty($value['chargeoff_status'])) {
                    $detail = $this->getBillAmountDetail($value['id'], $value['seller_id'], $value['proportion'], $value['start_time'], $value['end_time'], $value['chargeoff_status'], $value['commission_model']);

                    /* 初始应结金额 */
                    $should_amount = $detail['should_amount'];

                    //出账单，绑定满足账单订单 start
                    if ($detail && $value['end_time'] < $gmtime) {
                        $other['chargeoff_status'] = 1;
                        $other['order_amount'] = $detail['order_amount'];
                        $other['rate_fee'] = $detail['rate_fee'];
                        $other['shipping_amount'] = $detail['shipping_amount'];
                        $other['return_amount'] = $detail['return_amount'];
                        $other['return_shippingfee'] = $detail['return_shippingfee'];
                        $other['return_rate_fee'] = $detail['return_rate_fee'];
                        $other['gain_commission'] = $detail['gain_commission'];
                        $other['should_amount'] = $detail['should_amount'];
                        $other['drp_money'] = $detail['drp_money'];
                        $other['commission_model'] = $detail['commission_model'];
                        $other['chargeoff_time'] = $this->timeRepository->getGmTime();

                        SellerCommissionBill::where('id', $value['id'])->update($other);

                        /* 更新负账单 */
                        if ($detail['should_amount'] > 0) {

                            $negative_bill = $this->getNegativeBllTotal($value['seller_id'], $value['end_time']);

                            if (isset($negative_bill['negative_id']) && !empty($negative_bill['negative_id'])) {

                                $negative_id = $this->baseRepository->getExplode($negative_bill['negative_id']);

                                $negativeOther = [
                                    'commission_bill_id' => $value['id'],
                                    'commission_bill_sn' => $value['bill_sn']
                                ];

                                $is_negative = SellerNegativeBill::whereIn('id', $negative_id)
                                    ->where('return_amount', '<=', $detail['should_amount'])
                                    ->update($negativeOther);

                                if ($is_negative) {
                                    if (isset($negative_bill['total']) && $negative_bill['total'] > 0) {
                                        $negativeBillOther['negative_amount'] = $negative_bill['total'];
                                        $negativeBillOther['should_amount'] = $other['should_amount'] - $negative_bill['total'];
                                        SellerCommissionBill::where('id', $value['id'])->update($negativeBillOther);

                                        $row[$key]['negative_amount'] = $negativeBillOther['negative_amount'];

                                        $should_amount = $negativeBillOther['should_amount'];
                                    }
                                }
                            }
                        }

                        $row[$key]['chargeoff_status'] = $other['chargeoff_status'];

                        $bill_order_other['bill_id'] = $value['id'];
                        $bill_order_other['chargeoff_status'] = $other['chargeoff_status'];

                        $billOrderUpdate = SellerBillOrder::where('confirm_take_time', '>=', $value['start_time'])
                            ->where('confirm_take_time', '<=', $value['end_time'])
                            ->where('seller_id', $value['seller_id'])
                            ->where('chargeoff_status', '<>', 2)
                            ->where('bill_id', 0);
                        $billOrderUpdate = $this->orderCommonService->orderQuerySelect($billOrderUpdate, 'confirm_take');
                        $billOrderUpdate->update($bill_order_other);

                        $order_list = SellerBillOrder::select('order_id')->where('bill_id', $value['id']);
                        $order_list = $this->baseRepository->getToArrayGet($order_list);
                        $order_list = $this->baseRepository->getKeyPluck($order_list, 'order_id');

                        if ($order_list) {
                            OrderInfo::whereIn('order_id', $order_list)->update([
                                'chargeoff_status' => $other['chargeoff_status']
                            ]);

                            OrderReturn::whereIn('order_id', $order_list)->update([
                                'chargeoff_status' => $other['chargeoff_status']
                            ]);
                        }

                        $value['chargeoff_time'] = $other['chargeoff_time'];
                    }
                    //出账单，绑定满足账单订单 end

                    $value['order_amount'] = $detail['order_amount'];
                    $value['shipping_amount'] = $detail['shipping_amount'];
                    $value['return_amount'] = $detail['return_amount'] + $detail['return_shippingfee'];
                    $value['drp_money'] = $detail['drp_money'];

                    $row[$key]['format_gain_commission'] = $this->dscRepository->getPriceFormat($detail['gain_commission'], false);
                    $row[$key]['format_should_amount'] = $this->dscRepository->getPriceFormat($should_amount, false);
                } else {
                    if ($value['chargeoff_status'] == 1) {
                        $return_info = SellerBillOrder::selectRaw("SUM(return_amount) AS return_amount, SUM(return_shippingfee) AS return_shippingfee")
                            ->where('bill_id', $value['id']);

                        $where = [
                            'shipping_status' => OS_UNCONFIRMED,
                            'pay_status' => PS_UNPAYED,
                            'order_status' => OS_RETURNED
                        ];
                        $return_info = $return_info->whereHas('getOrder', function ($query) use ($where) {
                            $query->where('shipping_status', $where['shipping_status'])
                                ->where('pay_status', $where['pay_status'])
                                ->where('order_status', $where['order_status']);
                        });

                        $return_info = $this->baseRepository->getToArrayFirst($return_info);

                        if ($return_info && ($return_info['return_amount'] > 0 || $return_info['return_shippingfee'] > 0)) {
                            $value['return_amount'] = $return_info['return_amount'] > 0 ? $return_info['return_amount'] : 0;
                            $value['return_shippingfee'] = $return_info['return_shippingfee'] > 0 ? $return_info['return_shippingfee'] : 0;

                            $return_amount = 0;
                            $return_shippingfee = 0;
                            if ($value['return_amount'] && empty($value['return_shippingfee'])) {
                                $return_amount = $return_info['return_amount'];
                            } elseif ($value['return_shippingfee'] && empty($value['return_amount'])) {
                                $return_shippingfee = $return_info['return_shippingfee'];
                            } elseif ($value['return_amount'] && $value['return_shippingfee']) {
                                $return_amount = $return_info['return_amount'];
                                $return_shippingfee = $return_info['return_shippingfee'];
                            }

                            $other = [
                                'return_amount' => DB::raw("return_amount  + ('$return_amount')"),
                                'return_shippingfee' => DB::raw("return_shippingfee  + ('$return_shippingfee')")
                            ];

                            SellerCommissionBill::where('id', $value['id'])->update($other);
                        }
                    }

                    $value['return_amount'] = $value['return_amount'] + $value['return_shippingfee'];

                    $row[$key]['format_gain_commission'] = $this->dscRepository->getPriceFormat($value['gain_commission'], false);
                    $row[$key]['format_should_amount'] = $this->dscRepository->getPriceFormat($value['should_amount'], false);
                }

                $value['proportion'] = isset($value['proportion']) && !empty($value['proportion']) ? $value['proportion'] : 0;
                $row[$key]['gain_proportion'] = round(100 - $value['proportion'], 2); //收取佣金比例
                $row[$key]['should_proportion'] = $value['proportion'];     //结算佣金比例

                $value['drp_money'] = isset($value['drp_money']) ? $value['drp_money'] : 0;

                /** 合计已单独结算订单佣金金额 end * */
                $row[$key]['format_order_amount'] = $this->dscRepository->getPriceFormat($value['order_amount'], false);
                $row[$key]['format_shipping_amount'] = $this->dscRepository->getPriceFormat($value['shipping_amount'], false);
                $row[$key]['format_return_amount'] = $this->dscRepository->getPriceFormat($value['return_amount'], false);
                $row[$key]['format_drp_money'] = $this->dscRepository->getPriceFormat($value['drp_money'], false);
                $row[$key]['format_frozen_money'] = $this->dscRepository->getPriceFormat($value['frozen_money'], false);

                /* 出账时间 */
                $row[$key]['format_chargeoff_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $value['chargeoff_time']);

                $filter['commission_model'] = $value['commission_model'];
            }
        }

        if ($ajax_bill == 0) {
            $arr = ['bill_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']];
            return $arr;
        } else {
            return $row;
        }
    }

    /**
     * 账单明细列表
     *
     * @param int $type
     * @param array $bill
     * @return array
     */
    public function billDetailList($type = 0, $bill = [])
    {
        $filter = [];
        if ($type == 1) {
            if (isset($bill['seller_id'])) {
                $filter['seller_id'] = $bill['seller_id'];
            }

            if (isset($bill['bill_id'])) {
                $filter['bill_id'] = $bill['bill_id'];
            }
        } else {

            /* 过滤信息 */
            $filter['bill_id'] = empty($_REQUEST['bill_id']) ? 0 : intval($_REQUEST['bill_id']);
            $filter['commission_model'] = empty($_REQUEST['commission_model']) ? 0 : intval($_REQUEST['commission_model']);
            $filter['seller_id'] = empty($_REQUEST['seller_id']) ? 0 : intval($_REQUEST['seller_id']);
            $filter['proportion'] = isset($_REQUEST['proportion']) ? floatval($_REQUEST['proportion']) : 0;

            $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'order_id' : trim($_REQUEST['sort_by']);
            $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

            /* 分页大小 */
            $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

            $page_size = request()->cookie('dsccp_page_size');
            if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0) {
                $filter['page_size'] = intval($_REQUEST['page_size']);
            } elseif (intval($page_size) > 0) {
                $filter['page_size'] = intval($page_size);
            } else {
                $filter['page_size'] = 15;
            }
        }

        $proportion = 0;
        if (isset($filter['bill_id']) && $filter['bill_id']) {
            if (!$bill) {
                $bill = SellerCommissionBill::where('id', $filter['bill_id']);
                $bill = $this->baseRepository->getToArrayFirst($bill);
            }

            $proportion = $bill['proportion'];
        }

        $is_order = SellerAccountLog::where('add_time', '<', $bill['chargeoff_time'])->value('order_id');
        $is_order = $is_order ? $is_order : 0;

        $where = '';
        $record_where = '';
        if (isset($filter['seller_id']) && $filter['seller_id']) {
            $where = $record_where = "seller_id = '" . $filter['seller_id'] . "'";
        }

        if ($type == 0) {
            $record_count = SellerBillOrder::whereRaw(1);

            if ($filter['bill_id']) {
                $record_where .= " AND (confirm_take_time >= '" . $bill['start_time'] . "' AND confirm_take_time <= '" . $bill['end_time'] . "')";
                if ($is_order > 0) {
                    $record_where .= " AND order_id <> '$is_order'";
                }
            }

            $record_count = $record_count->whereRaw("IF(chargeoff_status > 0, bill_id = '" . $filter['bill_id'] . "', $record_where)");
            $record_count = $record_count->whereHas('getOrder');
            $filter['record_count'] = $record_count->count();

            $filter['page_count'] = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;
        }

        /* 查询 */
        if ($filter['bill_id']) {
            $where .= " AND (confirm_take_time >= '" . $bill['start_time'] . "' AND confirm_take_time <= '" . $bill['end_time'] . "')";
            if ($is_order > 0) {
                $where .= " AND order_id <> '$is_order'";
            }
        }

        $row = SellerBillOrder::selectRaw("*, " . $this->orderCommissionTotalField() . " AS total_fee, " . $this->orderActivityFieldAdd() . " AS activity_fee, " . $this->orderCommissionField() . " AS commission_total_fee")
            ->whereRaw("IF(chargeoff_status > 0, bill_id = '" . $filter['bill_id'] . "', $where)");

        $order_where = [
            'type' => $type,
            'order_status' => isset($bill['order_status']) ? $bill['order_status'] : 0,
            'is_status' => OS_RETURNED
        ];
        $row = $row->whereHas('getOrder', function ($query) use ($order_where) {
            if ($order_where['type'] == 1) {
                if ($order_where['order_status'] == $order_where['is_status']) {
                    $query->where('order_status', $order_where['order_status']);
                }
            }
        });

        $row = $row->with([
            'getOrder'
        ]);

        if ($type != 1) {
            $row = $row->orderBy($filter['sort_by'], $filter['sort_order']);

            $start = ($filter['page'] - 1) * $filter['page_size'];
            if ($start > 0) {
                $row = $row->skip($start);
            }

            if ($filter['page_size'] > 0) {
                $row = $row->take($filter['page_size']);
            }
        }

        foreach (['order_sn'] as $val) {
            if (isset($filter[$val])) {
                $filter[$val] = stripslashes($filter[$val]);
            }
        }

        $row = $this->baseRepository->getToArrayGet($row);

        $all_gain_commission = 0;
        $all_should_amount = 0;

        /* 格式话数据 */
        if ($row) {
            foreach ($row as $key => $value) {

                $order = $value['get_order'];
                $row[$key]['is_settlement'] = $order['is_settlement'] ?? 0;

                $value['commission_model'] = MerchantsServer::where('user_id', $value['seller_id'])->value('commission_model');
                $row[$key]['commission_model'] = $value['commission_model'];

                $return_amount = $value['return_amount'];
                $return_shippingfee = $value['return_shippingfee'];

                $value['bill_return_amount'] = $return_amount;
                $value['bill_return_shippingfee'] = $return_shippingfee;

                $value['return_amount'] = 0;
                $value['return_shippingfee'] = 0;

                $value['order_amount'] = $value['total_fee'] - $value['discount'];

                /* 商品佣金比例 start */
                $order = [
                    'goods_amount' => $value['goods_amount'],
                    'activity_fee' => $value['activity_fee']
                ];

                $row[$key]['is_goods_rate'] = 0;

                $goods_rate = $this->getAloneGoodsRate($value['order_id'], 0, $order);
                $row[$key]['goods_rate'] = $goods_rate;

                if ($goods_rate) {
                    /**
                     * 减去商品单独佣金比例的商品总金额
                     * 剩余有效订单参与店铺佣金的金额
                     */
                    $value['commission_total_fee'] = $value['commission_total_fee'] - $goods_rate['total_fee'];

                    /**
                     * 扣除单独设置商品佣金比例的商品总金额
                     */
                    if ($goods_rate['total_fee']) {
                        if ($value['commission_total_fee'] <= 0) {
                            $row[$key]['is_goods_rate'] = 1;
                        }

                        if ($value['commission_total_fee'] < 0) {
                            $value['commission_total_fee'] = 0;
                        }
                    }
                }
                /* 商品佣金比例 end */

                if ($bill['commission_model'] != -1) {
                    $value['commission_model'] = $bill['commission_model'];
                }

                if ($value['commission_model']) {

                    /**
                     * 分类佣金
                     */
                    $cat_commission = $this->getCatGainShouldAmount($value);
                    $cat_commission['should_amount'] = $cat_commission ? $cat_commission['should_amount'] : 0;
                    $cat_commission['gain_commission'] = $cat_commission ? $cat_commission['gain_commission'] : 0;

                    $goods_rate['gain_commission'] = $goods_rate ? $goods_rate['gain_commission'] : 0;

                    $format_gain_commission = $cat_commission['gain_commission'] + $goods_rate['gain_commission'];
                    $format_gain_commission = number_format($format_gain_commission, 2, '.', '');

                    $should_amount = $cat_commission['should_amount'];
                    $gain_commission = $cat_commission['gain_commission'];

                    /* 是否已扣除退款 0:未扣除 1:已扣除 */
                    $is_minus_return = $cat_commission['is_minus_return'];
                } else {

                    /**
                     * 店铺佣金
                     */
                    $commission = $this->getGainShouldAmount($proportion, $value);

                    $commission['should_amount'] = $commission ? $commission['should_amount'] : 0;
                    $commission['gain_commission'] = $commission ? $commission['gain_commission'] : 0;

                    $goods_rate['gain_commission'] = $goods_rate ? $goods_rate['gain_commission'] : 0;

                    $should_amount = $commission['should_amount'];
                    $format_gain_commission = $commission['gain_commission'] + $goods_rate['gain_commission'];
                    $format_gain_commission = number_format($format_gain_commission, 2, '.', '');

                    $row[$key]['format_gain_commission'] = $this->dscRepository->getPriceFormat($format_gain_commission, false);

                    $row[$key]['format_drp_money'] = $this->dscRepository->getPriceFormat($value['drp_money'], false);
                    $row[$key]['format_integral_money'] = $this->dscRepository->getPriceFormat($value['integral_money'], false);

                    $gain_commission = $commission['gain_commission'];

                    /* 是否已扣除退款 0:未扣除 1:已扣除 */
                    $is_minus_return = $commission['is_minus_return'];
                }

                $should_amount = $this->dscRepository->changeFloat($should_amount);       //应结佣金

                if ($should_amount == 0 && $goods_rate) {
                    $value['commission_total_fee'] = $goods_rate['total_fee'] + $goods_rate['rate_activity'];
                }

                $row[$key]['gain_commission'] = $this->dscRepository->changeFloat($gain_commission);   //收取佣金
                $row[$key]['should_amount'] = $should_amount;       //应结佣金

                if (isset($goods_rate['should_amount'])) {
                    $format_should_amount = $should_amount + $goods_rate['should_amount'];
                } else {
                    $format_should_amount = $should_amount;
                }

                $format_should_amount = $this->dscRepository->changeFloat($format_should_amount);       //应结佣金

                if ($type == 1 && $row[$key]['is_settlement'] == 1) {
                    $all_gain_commission += $format_gain_commission;
                    $all_should_amount += $format_should_amount;
                }

                if ($value['order_status'] == OS_RETURNED) {
                    $format_gain_commission = 0;
                    $format_should_amount = 0;
                }

                if ($format_should_amount > 0 && $is_minus_return == 0) {
                    $format_should_amount -= $return_amount;
                }

                $row[$key]['format_gain_commission'] = $this->dscRepository->getPriceFormat($format_gain_commission, false);
                $row[$key]['format_should_amount'] = $this->dscRepository->getPriceFormat($format_should_amount, false);

                $row[$key]['format_drp_money'] = $this->dscRepository->getPriceFormat($value['drp_money'], false);
                $row[$key]['format_integral_money'] = $this->dscRepository->getPriceFormat($value['integral_money'], false);
                $row[$key]['format_order_amount'] = $this->dscRepository->getPriceFormat($value['order_amount'], false);
                $row[$key]['commission_total_fee'] = $value['commission_total_fee'];
                $row[$key]['format_commission_total_fee'] = $this->dscRepository->getPriceFormat($value['commission_total_fee'], false);
                $row[$key]['format_shipping_fee'] = $this->dscRepository->getPriceFormat($value['shipping_fee'], false);
                $row[$key]['format_return_amount'] = $this->dscRepository->getPriceFormat($return_amount + $return_shippingfee, false);
                $filter['proportion'] = isset($filter['proportion']) ? $filter['proportion'] : 0;
                $row[$key]['gain_proportion'] = round(100 - $filter['proportion'], 2);
                $row[$key]['should_proportion'] = $filter['proportion'];
                if ($bill) {
                    $alog_count = SellerAccountLog::where('is_paid', 1)
                        ->where('ru_id', $value['seller_id'])
                        ->where('order_id', $value['order_id'])
                        ->where('log_type', 2)
                        ->where('add_time', '<=', $bill['settleaccounts_time'])
                        ->count();

                    if ($alog_count > 0) {
                        $row[$key]['chargeoff_before'] = 1;
                    } else {
                        $row[$key]['chargeoff_before'] = 2;
                    }
                } else {
                    $row[$key]['chargeoff_before'] = 0;
                }

                if ($value['order_status'] == OS_RETURNED) {
                    $row[$key]['gain_commission'] = $this->dscRepository->getPriceFormat(0, false);
                    $row[$key]['should_amount'] = $this->dscRepository->getPriceFormat(0, false);
                    $row[$key]['goods_rate']['gain_commission'] = $this->dscRepository->getPriceFormat(0, false);
                    $row[$key]['goods_rate']['should_amount'] = $this->dscRepository->getPriceFormat(0, false);
                }
            }
        }

        if ($type == 1) {
            $row['all_gain_commission'] = $all_gain_commission;
            $row['all_should_amount'] = $all_should_amount;

            $arr = $row;
        } else {
            $arr = ['bill_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']];
        }

        return $arr;
    }

    /**
     * 运算订单的佣金金额
     *
     * @param $seller_id
     * @param $start_time
     * @param $end_time
     * @param $commission_model
     * @param $proportion
     * @return mixed
     */
    public function getBillOrderAmount($seller_id, $start_time, $end_time, $commission_model, $proportion)
    {
        $chargeoff_status = isset($chargeoff_status) ?: 0;

        $order_list = SellerBillOrder::selectRaw("*, (" . $this->orderCommissionTotalField() . ") AS total_fee, (" . $this->orderCommissionField() . ") AS commission_total_fee, (" . $this->orderActivityFieldAdd() . ") AS activity_fee")
            ->where('seller_id', $seller_id)
            ->where('bill_id', 0)
            ->where('confirm_take_time', '>=', $start_time)
            ->where('confirm_take_time', '<=', $end_time);

        $order_list = $this->orderCommonService->orderQuerySelect($order_list, 'confirm_take');

        if ($chargeoff_status <= 1) {
            $order_list = $order_list->whereIn('chargeoff_status', [0, 1]);
        } else {
            $order_list = $order_list->where('chargeoff_status', $chargeoff_status);
        }

        $order_list = $order_list->whereHas('getOrder', function ($query) {
            $query->where('is_settlement', 0);
        });

        $order_list = $order_list->with([
            'getSellerBillGoods' => function ($query) {
                $query->selectRaw('order_id, SUM(drp_money) as drp_money');
            }
        ]);

        $order_list = $order_list->orderBy('order_id', 'desc');

        $order_list = $this->baseRepository->getToArrayGet($order_list);

        $arr['gain_commission'] = 0;
        $arr['should_amount'] = 0;

        /* 格式话数据 */
        if ($order_list) {
            foreach ($order_list as $key => $value) {

                $value['drp_money'] = $value['get_seller_bill_goods']['drp_money'] ?? 0;

                /* 商品佣金比例 start */
                $order = [
                    'goods_amount' => $value['goods_amount'],
                    'activity_fee' => $value['activity_fee']
                ];

                $goods_rate = $this->getAloneGoodsRate($value['order_id'], 0, $order);

                if ($goods_rate) {
                    /**
                     * 减去商品单独佣金比例的商品总金额
                     * 剩余有效订单参与店铺佣金的金额
                     */
                    $value['commission_total_fee'] = $value['commission_total_fee'] - $goods_rate['total_fee'];

                    /**
                     * 扣除单独设置商品佣金比例的商品总金额
                     */
                    if ($goods_rate['total_fee']) {
                        if ($value['commission_total_fee'] < 0) {
                            $value['commission_total_fee'] = 0;
                        }
                    }
                }
                /* 商品佣金比例 end */

                $goods_rate['gain_commission'] = $goods_rate && isset($goods_rate['gain_commission']) ? $goods_rate['gain_commission'] : 0;
                $goods_rate['should_amount'] = $goods_rate && isset($goods_rate['should_amount']) ? $goods_rate['should_amount'] : 0;

                if ($commission_model) {

                    /**
                     * 分类佣金
                     */
                    $cat_commission = $this->getCatGainShouldAmount($value);

                    $gain_commission = $cat_commission ? $cat_commission['gain_commission'] : 0;
                    $should_amount = $cat_commission ? $cat_commission['should_amount'] : 0;

                    $arr['gain_commission'] += $gain_commission + $goods_rate['gain_commission'];
                    $arr['should_amount'] += $should_amount + $goods_rate['should_amount'];
                } else {

                    /**
                     * 店铺佣金
                     */
                    $commission = $this->getGainShouldAmount($proportion, $value);

                    $commission['gain_commission'] = $commission ? $commission['gain_commission'] : 0;
                    $commission['should_amount'] = $commission ? $commission['should_amount'] : 0;

                    $arr['gain_commission'] += $commission['gain_commission'] + $goods_rate['gain_commission'];
                    $arr['should_amount'] += $commission['should_amount'] + $goods_rate['should_amount'];
                }
            }
        }

        return $arr;
    }

    /**
     * 获取账单金额明细
     *
     * @param int $bill_id
     * @param int $seller_id
     * @param int $proportion
     * @param int $start_time
     * @param int $end_time
     * @param int $chargeoff_status
     * @param int $commission_model
     * @return mixed
     */
    public function getBillAmountDetail($bill_id = 0, $seller_id = 0, $proportion = 100, $start_time = 0, $end_time = 0, $chargeoff_status = 0, $commission_model = 0)
    {
        /**
         * 订单信息
         */
        $order = SellerBillOrder::selectRaw("GROUP_CONCAT(order_id) AS order_list, SUM((" . $this->orderCommissionTotalField() . ")) AS total_fee, SUM((" . $this->orderCommissionField() . ")) AS commission_total_fee, SUM(return_amount) AS return_amount, SUM(shipping_fee) AS shipping_fee, SUM(return_shippingfee) AS return_shippingfee, SUM(return_rate_fee) AS return_rate_fee, SUM(goods_amount) AS goods_amount, SUM(discount) AS discount, SUM(coupons) AS coupons, SUM(integral_money) AS integral_money, SUM(bonus) AS bonus, SUM(value_card) AS value_card, SUM(rate_fee) AS rate_fee")
            ->where('seller_id', $seller_id)
            ->where('bill_id', 0)
            ->where('confirm_take_time', '>=', $start_time)
            ->where('confirm_take_time', '<=', $end_time);

        $order = $this->orderCommonService->orderQuerySelect($order, 'confirm_take');

        if ($chargeoff_status <= 1) {
            $order = $order->whereIn('chargeoff_status', [0, 1]);
        } else {
            $order = $order->where('chargeoff_status', $chargeoff_status);
        }

        $order = $order->whereHas('getOrder', function ($query) {
            $query->where('is_settlement', 0);
        });

        $order = $this->baseRepository->getToArrayFirst($order);

        if ($order) {
            $drp_money = 0;

            if ($order['order_list']) {
                $order['order_list'] = $this->baseRepository->getExplode($order['order_list']);
                $drp_money = SellerBillGoods::selectRaw("SUM(drp_money) AS drp_money")->whereIn('order_id', $order['order_list'])->value('drp_money');
            }

            $order['drp_money'] = $drp_money;

            $order['bill_id'] = $bill_id; //账单ID
            $order['return_amount'] = isset($order['return_amount']) ? $order['return_amount'] : 0;
            $order['return_shippingfee'] = isset($order['return_shippingfee']) ? $order['return_shippingfee'] : 0;
            $order['return_rate_fee'] = isset($order['return_rate_fee']) ? $order['return_rate_fee'] : 0;
            $order['integral_money'] = isset($order['integral_money']) ? $order['integral_money'] : 0;
            $order['order_amount'] = isset($order['total_fee']) ? $order['total_fee'] - $order['discount'] : 0;
            $order['shipping_amount'] = isset($order['shipping_fee']) ? $order['shipping_fee'] : 0;
            $order['drp_money'] = isset($order['drp_money']) ? $order['drp_money'] : 0;
            $order['rate_fee'] = isset($order['rate_fee']) ? $order['rate_fee'] : 0;
            $order['commission_model'] = $commission_model;

            $bill_order = $this->getBillOrderAmount($seller_id, $start_time, $end_time, $commission_model, $proportion);
            $order['gain_commission'] = $bill_order['gain_commission'];
            $order['should_amount'] = $bill_order['should_amount'];

            $order['start_time_format'] = $this->timeRepository->getLocalDate($this->config['time_format'], $start_time);
            $order['end_time_format'] = $this->timeRepository->getLocalDate($this->config['time_format'], $end_time);
        }

        return $order;
    }

    /**
     * 平台分类佣金比例模式
     *
     * @param array $value
     * @return array
     */
    public function getCatGainShouldAmount($value = [])
    {
        if ($value['goods_amount'] <= 0) {
            $value['goods_amount'] = 1;
        }

        $value['bill_return_amount'] = isset($value['bill_return_amount']) ? $value['bill_return_amount'] : 0;
        $value['bill_return_shippingfee'] = isset($value['bill_return_shippingfee']) ? $value['bill_return_shippingfee'] : 0;

        $value['return_amount'] = $value['bill_return_amount'] + $value['bill_return_shippingfee'];

        if ($value['total_fee'] == $value['return_amount']) {
            $gain_commission = 0;
            $should_amount = 0;
        } else {
            $goods = $this->getGoodsCatCommission($value['order_id']);

            if ($goods['commission']) {
                $goods_commission = $goods['commission'] * ($value['commission_total_fee'] - $value['return_amount']) / $goods['goods_amount'];
                $should_amount = $goods_commission + $value['shipping_fee'];

                $gain_commission = $value['commission_total_fee'] - $goods_commission - $value['drp_money'] - $value['return_amount'];
            } else {
                $should_amount = $value['commission_total_fee'] - $value['return_amount'] + $value['shipping_fee'];
                $gain_commission = 0;
            }
        }

        $arr = [
            'gain_commission' => $gain_commission,
            'should_amount' => $should_amount
        ];

        if ($value['return_amount'] > 0) {
            $arr['is_minus_return'] = 1;
        } else {
            $arr['is_minus_return'] = 1;
        }

        return $arr;
    }

    /**
     * 店铺佣金比例模式
     *
     * @param int $proportion
     * @param array $order
     * @return array
     */
    public function getGainShouldAmount($proportion = 0, $order = [])
    {
        /**
         * 店铺佣金
         */
        $proportion = !empty($proportion) ? $proportion : 0;
        $gain_proportion = round(100 - $proportion, 2);   //收取比例

        $arr = [];

        if ($order) {
            $order['bill_return_amount'] = isset($order['bill_return_amount']) ? $order['bill_return_amount'] : $order['return_amount'] ?? 0;
            $order['bill_return_shippingfee'] = isset($order['bill_return_shippingfee']) ? $order['bill_return_shippingfee'] : $order['return_shippingfee'] ?? 0;

            $order['return_amount'] = $order['bill_return_amount'] + $order['bill_return_shippingfee'];

            if ($order['return_amount'] == $order['total_fee']) {
                $arr['gain_commission'] = 0;
                $arr['should_amount'] = 0;
            } else {
                if ($order['commission_total_fee'] >= ($order['drp_money'] + $order['return_amount'])) {
                    $gain_commission = ($order['commission_total_fee'] - $order['drp_money'] - $order['return_amount']) * ($gain_proportion / 100);
                    $gain_commission = number_format($gain_commission, 2, '.', '');
                } else {
                    $gain_commission = 0;
                }

                if (($order['commission_total_fee'] + $order['shipping_fee']) >= ($gain_commission + $order['return_amount'])) {
                    $arr['should_amount'] = $order['commission_total_fee'] - $gain_commission - $order['return_amount'] + $order['shipping_fee'];
                } else {
                    $arr['should_amount'] = 0;
                }

                $arr['gain_commission'] = $gain_commission;
            }

            if ($order['return_amount'] > 0) {
                $arr['is_minus_return'] = 1;
            } else {
                $arr['is_minus_return'] = 1;
            }
        }

        return $arr;
    }

    /*
     * 商品佣金比例金额
     * $order_id 订单ID
     * $ru_id 商家ID
     */
    public function getAloneGoodsRate($order_id = 0, $ru_id = 0, $order = [])
    {
        $res['order_activity'] = 0;
        $res['rate_activity'] = 0;
        if ($order) {
            if ($order['goods_amount'] <= 0) {
                $order['goods_amount'] = 1;
            }

            $total_fee = SellerBillGoods::selectRaw("SUM(goods_price * goods_number - dis_amount) AS total_fee")->where('commission_rate', '>', 0);

            if ($order_id) {
                $total_fee = $total_fee->where('order_id', $order_id);
            } elseif ($ru_id) {
                $total_fee = $total_fee->whereHas('getSellerBillOrder', function ($query) use ($ru_id) {
                    $query->where('seller_id', $ru_id);
                });
            }

            $total_fee = $total_fee->value('total_fee');

            $res['order_percent'] = round(($order['goods_amount'] - $total_fee) / $order['goods_amount'], 2);    //订单占比
            $res['rate_percent'] = round($total_fee / $order['goods_amount'], 2);    //商品占比

            $res['order_activity'] = round($order['activity_fee'] * $res['order_percent'], 2);  //订单占比金额
            $res['rate_activity'] = round($order['activity_fee'] * $res['rate_percent'], 2);    //商品占比金额

            $res = !empty($res) ? array_merge($order, $res) : $order;

            if ($res['rate_activity'] < 0) {
                $res['rate_activity'] = 0;
            }

            if ($res['order_activity'] < 0) {
                $res['order_activity'] = 0;
            }
        }

        $goods_list = SellerBillGoods::selectRaw("rec_id, order_id, commission_rate, (goods_price * goods_number - dis_amount) AS goods_amount")->where('commission_rate', '>', 0);

        if ($order_id) {
            $goods_list = $goods_list->where('order_id', $order_id);
        } elseif ($ru_id) {
            $goods_list = $goods_list->whereHas('getOrderGoods', function ($query) use ($ru_id) {
                $query->where('ru_id', $ru_id);
            });
        }

        $goods_list = $this->baseRepository->getToArrayGet($goods_list);

        $row = [];
        if ($goods_list) {
            $row['rec_id'] = 0;
            $row['total_fee'] = 0;
            foreach ($goods_list as $key => $goods) {
                $row['total_fee'] += $goods['goods_amount'];
                $row['goods'][$goods['rec_id']]['order_id'] = $goods['order_id'];
                $row['goods'][$goods['rec_id']]['rec_id'] = $goods['rec_id'];
                $row['goods'][$goods['rec_id']]['goods_amount'] = $goods['goods_amount'];
                $row['goods'][$goods['rec_id']]['commission_rate'] = $goods['commission_rate'];
            }

            $rec_id = $this->baseRepository->getKeyPluck($goods_list, 'rec_id');

            $row['rec_id'] = $rec_id ? implode(',', $rec_id) : 0;

            $row['format_total_fee'] = $this->dscRepository->changeFloat($row['total_fee']);

            $gain_commission = 0;
            $should_amount = 0;
            foreach ($row['goods'] as $key => $goods) {
                $row[$key]['order_percent'] = round($goods['goods_amount'] / $row['format_total_fee'], 2);
                $row[$key]['rate_activity'] = round($row[$key]['order_percent'] * $res['rate_activity'], 2);
                $row[$key]['goods_amount'] = round($goods['goods_amount'] - $row[$key]['rate_activity'], 2);

                $OrderReturn = OrderReturn::selectRaw("(actual_return - return_shipping_fee - return_rate_price) AS actual_return");
                $OrderReturn = $OrderReturn->whereHas('getReturnGoods', function ($query) use ($key) {
                    $query->where('rec_id', $key);
                });

                $OrderReturn = $OrderReturn->doesntHave('getSellerNegativeOrder');

                $actual_return = $OrderReturn->value('actual_return');
                $row['actual_return'] = $actual_return ? $actual_return : 0;

                $row[$key]['should_amount'] = number_format(($row[$key]['goods_amount'] - $actual_return) * $goods['commission_rate'], 2, '.', ''); //应结佣金
                $row[$key]['should_amount'] = $row[$key]['should_amount'] > 0 ? $row[$key]['should_amount'] : 0;

                $row[$key]['gain_commission'] = ($row[$key]['goods_amount'] - $actual_return) - $row[$key]['should_amount']; //收取佣金
                $row[$key]['gain_commission'] = $row[$key]['gain_commission'] > 0 ? $row[$key]['gain_commission'] : 0;

                $gain_commission += $row[$key]['gain_commission'];
                $should_amount += $row[$key]['should_amount'];
            }

            $row['gain_commission'] = $this->dscRepository->changeFloat($gain_commission);
            $row['should_amount'] = $this->dscRepository->changeFloat($should_amount);

            /* 有效佣金商品金额 */
            $row['total_fee'] = $this->dscRepository->changeFloat($row['format_total_fee'] - $res['rate_activity']);
            $row['format_total_fee'] = $this->dscRepository->getPriceFormat($row['total_fee'], false);

            /* 优惠活动占比金额 */
            $row['order_activity'] = $res['order_activity'];    //订单占比
            $row['rate_activity'] = $res['rate_activity'];  //商品占比
        }

        return $row;
    }

    /**
     * 微分销佣金金额
     *
     * @param int $total_fee
     * @param int $ru_id
     * @param int $order_id
     * @param array $order
     * @return mixed
     */
    public function getOrderDrpMoney($total_fee = 0, $ru_id = 0, $order_id = 0, $order = [])
    {
        $gain_commission = 0;
        $should_amount = 0;
        $order_drp = OrderGoods::selectRaw("SUM(drp_money) AS drp_money")
            ->whereRaw(1);

        if ($order_id) {
            $order_drp = $order_drp->where('order_id', $order_id);
        } else {

            $order_drp = $order_drp->where('ru_id', $ru_id);

            $order_drp = $order_drp->whereHas('getOrder', function ($query) {
                $query = $query->where('main_count', 0);
                $this->orderCommonService->orderQuerySelect($query, 'confirm_take');
            });
        }

        $order_drp = $this->baseRepository->getToArrayFirst($order_drp);

        $res['goods_rate_total'] = 0;
        $res['order_activity'] = 0;
        $res['rate_activity'] = 0;
        if ($order_id) {
            /* 商品佣金比例 start */
            $goods_rate = $this->getAloneGoodsRate($order_id, 0, $order);

            $res['goods_rate_total'] = isset($goods_rate['total_fee']) ? $this->dscRepository->changeFloat($goods_rate['total_fee']) : 0;
            $res['order_activity'] = isset($goods_rate['order_activity']) ? $this->dscRepository->changeFloat($goods_rate['order_activity']) : 0;
            $res['rate_activity'] = isset($goods_rate['rate_activity']) ? $this->dscRepository->changeFloat($goods_rate['rate_activity']) : 0;

            if ($goods_rate) {
                /**
                 * 减去商品单独佣金比例的商品总金额
                 * 剩余有效订单参与店铺佣金的金额
                 */
                $total_fee = $total_fee - $goods_rate['total_fee'];

                /**
                 * 扣除单独设置商品佣金比例的商品总金额
                 */
                if ($goods_rate['total_fee']) {
                    if ($total_fee < 0) {
                        $total_fee = 0;
                    }
                }

                $gain_commission = $goods_rate['gain_commission'];
                $should_amount = $goods_rate['should_amount'];
            } else {
                $gain_commission = 0;
                $should_amount = 0;
            }
            /* 商品佣金比例 end */
        }

        if ($total_fee > 0 && $order_drp) {
            $res['total_fee'] = $total_fee - $order_drp['drp_money'];
        } else {
            $res['total_fee'] = 0;
        }

        $res['drp_money'] = $order_drp ? $order_drp['drp_money'] : 0;
        $res['gain_commission'] = $gain_commission;
        $res['should_amount'] = $should_amount;

        return $res;
    }

    /**
     * 商家有效分成金额
     *
     * @param int $order_id
     * @param int $ru_id
     * @return mixed
     */
    public function getSellerSettlementAmount($order_id = 0, $ru_id = 0)
    {
        $actual_amount = OrderSettlementLog::where('order_id', $order_id)->where('ru_id', $ru_id)->value('actual_amount');
        $actual_amount = $actual_amount > 0 ? $actual_amount : 0;
        $actual_amount = $this->dscRepository->changeFloat($actual_amount);

        return $actual_amount;
    }

    /**
     * 获取订单商品佣金（未考虑实付订单金额）
     *
     * @param int $order_id
     * @param int $type
     * @return array
     */
    public function getOrderGoodsCommission($order_id = 0, $type = 0)
    {
        $order_goods = OrderGoods::selectRaw("goods_id, goods_price, goods_number, commission_rate, (goods_price * goods_number) AS goods_amount")
            ->where('order_id', $order_id);

        $order_goods = $this->baseRepository->getToArrayGet($order_goods);

        $goods_amount = 0;
        $gain_commission = 0;
        $should_amount = 0; //浮点数，保留两位数
        $cat = [];
        if ($order_goods) {
            foreach ($order_goods as $goods) {
                if ($type == 1) {
                    $rate = $this->getCommissionRate($order_id, $goods['goods_id'], $type);

                    $cat[$goods['goods_id']]['commission_rate'] = $rate['commission_rate'];
                    $cat[$goods['goods_id']]['cat_id'] = $rate['cat_id'];

                    $commission_rate = $rate['commission_rate'];
                } else {
                    $commission_rate = $this->getCommissionRate($order_id, $goods['goods_id']);
                }

                /* 商品佣金比例为0时 */
                if ($goods['commission_rate'] == 0) {
                    $gain_commission += $goods['goods_amount'] * (1 - $commission_rate); //运算分类收取佣金比例金额
                    $should_amount += $goods['goods_amount'] * $commission_rate; //运算分类应结佣金比例金额
                    $goods_amount += $goods['goods_amount'];
                }
            }
        }

        if ($type == 1) {
            $arr = [
                'gain_commission' => $this->dscRepository->changeFloat($gain_commission),
                'should_amount' => $this->dscRepository->changeFloat($should_amount),
                'cat' => $cat,
                'goods_amount' => $goods_amount
            ];

            return $arr;
        } else {
            $arr = [
                'gain_commission' => $this->dscRepository->changeFloat($gain_commission),
                'should_amount' => $this->dscRepository->changeFloat($should_amount),
                'goods_amount' => $goods_amount
            ];

            return $arr;
        }
    }

    /**
     * 获取商品分类佣金比率
     *
     * @param int $order_id
     * @param int $goods_id
     * @param int $type
     * @return array|int
     */
    public function getCommissionRate($order_id = 0, $goods_id = 0, $type = 0)
    {
        $bill_goods = SellerBillGoods::where('order_id', $order_id)
            ->where('goods_id', $goods_id);
        $bill_goods = $this->baseRepository->getToArrayFirst($bill_goods);

        if ($bill_goods) {
            $cat_id = $bill_goods['cat_id'];
            $commission_rate = $bill_goods['proportion'];
        } else {
            $cat_id = Goods::where('goods_id', $goods_id)->value('cat_id');

            $commission_rate = 0;
            while ($cat_id > 0) {
                $commission_rate = Category::where('cat_id', $cat_id)->value('commission_rate');
                if ($commission_rate > 0) {
                    break;
                } else {
                    $cat_id = Category::where('cat_id', $cat_id)->value('parent_id');
                }
            }

            if ($commission_rate > 0) {
                $commission_rate /= 100;
            }
        }

        if ($type == 1) {
            $arr = [
                'commission_rate' => $commission_rate,
                'cat_id' => $cat_id,
            ];

            return $arr;
        } else {
            return $commission_rate;
        }
    }

    /**
     * 订单账单记录
     *
     * @param $other
     */
    public function getOrderBillLog($other)
    {
        if ($other) {
            $other['confirm_take_time'] = $other['confirm_take_time'] ? $other['confirm_take_time'] : '';
            $other['bill_id'] = isset($other['bill_id']) ? $other['bill_id'] : 0;
            $other['return_rate_fee'] = $other['return_rate_fee'] ?? 0;

            $count = SellerBillOrder::where('bill_id', $other['bill_id'])
                ->where('order_id', $other['order_id'])
                ->count();

            /* 获取表字段 */
            $BillOrderOther = $this->baseRepository->getArrayfilterTable($other, 'seller_bill_order');

            $bill_id = 0;
            if ($count) {
                SellerBillOrder::where('bill_id', $other['bill_id'])
                    ->where('order_id', $other['order_id'])
                    ->update($BillOrderOther);
            } else {
                $bill_id = SellerBillOrder::insert($BillOrderOther);
            }

            $where = [
                'order_id' => $other['order_id']
            ];
            $goods_list = $this->orderGoodsService->getOrderGoodsList($where);

            if ($goods_list) {
                foreach ($goods_list as $key => $row) {
                    $parent_id = OrderInfo::where('order_id', $row['order_id'])->value('parent_id');

                    //商品金额促销 start
                    $goods_amount = $row['goods_price'] * $row['goods_number'];
                    $goods_con = $this->cartCommonService->getConGoodsAmount($goods_amount, $row['goods_id'], 0, 0, $parent_id);

                    $amount = $goods_con['amount'] ? explode(',', $goods_con['amount']) : [];
                    $amount = $amount ? min($amount) : 0;

                    $row['dis_amount'] = $goods_amount - $amount;
                    //商品金额促销 end

                    $row['cat_id'] = Goods::where('goods_id', $row['goods_id'])->value('cat_id');
                    $row['cat_id'] = $row['cat_id'] ?? 0;

                    $proportion = $this->getOrderGoodsCommission($row['order_id'], 1);

                    if ($proportion['cat']) {
                        foreach ($proportion['cat'] as $gkey => $grow) {
                            if ($row['goods_id'] == $gkey) {
                                $row['proportion'] = $grow['commission_rate'];
                                $row['cat_id'] = $grow['cat_id'] ?? 0;
                                break;
                            }
                        }
                    }

                    $row['commission_rate'] = !empty($row['commission_rate']) ? $row['commission_rate'] / 100 : 0;

                    $count = SellerBillGoods::where('rec_id', $row['rec_id'])
                        ->where('order_id', $row['order_id'])
                        ->count();

                    /* 获取表字段 */
                    $goods = $this->baseRepository->getArrayfilterTable($row, 'seller_bill_goods');

                    if ($count) {
                        SellerBillGoods::where('rec_id', $row['rec_id'])
                            ->where('order_id', $row['order_id'])
                            ->update($goods);
                    } else {
                        SellerBillGoods::insert($goods);
                    }
                }

                if ($bill_id > 0) {
                    $filter = [
                        'order_sn' => $BillOrderOther['order_sn']
                    ];

                    /* 微分销 */
                    if (file_exists(MOBILE_DRP)) {
                        $no_settlement = $this->merchantsIsSettlement($BillOrderOther['seller_id'], 0, $filter);
                    } else {
                        $no_settlement = $this->merchantsIsSettlement($BillOrderOther['seller_id'], 0, $filter);
                    }

                    $gain_amount = $no_settlement['all_gain_commission'] ?? 0;
                    $gain_amount = $this->dscRepository->changeFloat($gain_amount);

                    $actual_amount = $no_settlement['all_price'] ?? 0;
                    $actual_amount = $this->dscRepository->changeFloat($actual_amount);

                    $log = [
                        'order_id' => $BillOrderOther['order_id'],
                        'ru_id' => $BillOrderOther['seller_id'],
                        'gain_amount' => $gain_amount,
                        'actual_amount' => $actual_amount,
                        'add_time' => $this->timeRepository->getGmTime()
                    ];
                    OrderSettlementLog::insert($log);
                }
            }
        }
    }

    /**
     * 确认收货时：录入账单订单退款订单单号
     *
     * @param array $list
     * @param int $order_id
     */
    public function setBillOrderReturn($list = [], $order_id = 0)
    {
        if ($list) {
            foreach ($list as $key => $val) {
                SellerBillOrderReturn::insert([
                    'ret_id' => $val,
                    'order_id' => $order_id
                ]);
            }
        }
    }

    /**
     * 账单订单信息
     *
     * @param array $select
     * @return mixed
     */
    public function getBillOrder($order_id = 0)
    {
        $row = SellerBillOrder::where('order_id', $order_id);
        $row = $this->baseRepository->getToArrayFirst($row);

        return $row;
    }

    /**
     * 获取分类佣金比例金额
     *
     * @param int $order_id
     * @return mixed
     */
    public function getGoodsCatCommission($order_id = 0)
    {
        $row = SellerBillGoods::selectRaw("SUM(goods_price * goods_number * proportion) AS commission, SUM(drp_money) AS drp_money, SUM(goods_price * goods_number) AS goods_amount")
            ->where('order_id', $order_id)
            ->where('commission_rate', 0);

        $row = $this->baseRepository->getToArrayFirst($row);

        /* 微分销 */
        if (file_exists(MOBILE_DRP)) {
            $row['commission'] = $row['commission'] - $row['drp_money'];
        }

        return $row;
    }

    /**
     * 订单明细列表
     */
    public function billGoodsList()
    {
        /* 过滤信息 */
        $filter['order_id'] = empty($_REQUEST['order_id']) ? 0 : intval($_REQUEST['order_id']);
        $filter['type'] = empty($_REQUEST['type']) ? 0 : intval($_REQUEST['type']);
        $filter['commission_model'] = empty($_REQUEST['commission_model']) ? 0 : intval($_REQUEST['commission_model']);
        $filter['seller_id'] = empty($_REQUEST['seller_id']) ? 0 : intval($_REQUEST['seller_id']);
        $filter['proportion'] = empty($_REQUEST['proportion']) ? 0 : intval($_REQUEST['proportion']);

        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'rec_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        /* 分页大小 */
        $filter['page'] = empty($_REQUEST['page']) || (intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        $page_size = request()->cookie('dsccp_page_size');
        if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0) {
            $filter['page_size'] = intval($_REQUEST['page_size']);
        } elseif (intval($page_size) > 0) {
            $filter['page_size'] = intval($page_size);
        } else {
            $filter['page_size'] = 15;
        }

        if ($filter['type'] == 1) {
            $record_count = OrderGoods::whereRaw(1);
        } else {
            $record_count = SellerBillGoods::whereRaw(1);
        }

        if ($filter['order_id']) {
            $record_count = $record_count->where('order_id', $filter['order_id']);
        }

        $filter['record_count'] = $record_count->count();
        $filter['page_count'] = $filter['record_count'] > 0 ? ceil($filter['record_count'] / $filter['page_size']) : 1;

        /* 查询 */
        if ($filter['type'] == 1) {
            $row = OrderGoods::whereRaw(1);
        } else {
            $row = SellerBillGoods::whereRaw(1);
        }

        if ($filter['order_id']) {
            $row = $record_count->where('order_id', $filter['order_id']);
        }

        $row = $row->with([
            'getGoods' => function ($query) use ($filter) {
                $query = $query->select('goods_id', 'goods_name', 'cat_id');
                $query->with([
                    'getGoodsCategory'
                ]);
            }
        ]);

        $row = $row->orderBy($filter['sort_by'], $filter['sort_order']);

        $start = ($filter['page'] - 1) * $filter['page_size'];
        if ($start > 0) {
            $row = $row->skip($start);
        }

        if ($filter['page_size'] > 0) {
            $row = $row->take($filter['page_size']);
        }

        foreach (['order_sn'] as $val) {
            $filter[$val] = isset($filter[$val]) ? stripslashes($filter[$val]) : '';
        }

        $row = $this->baseRepository->getToArrayGet($row);

        /* 格式话数据 */
        if ($row) {
            foreach ($row as $key => $value) {
                $goods = $value['get_goods'] ? $value['get_goods'] : [];
                $row[$key]['goods_name'] = $goods ? $goods['goods_name'] : '';

                $row[$key]['cat_name'] = $goods['get_goods_category']['cat_name'] ?? '';

                $row[$key]['format_goods_price'] = $this->dscRepository->getPriceFormat($value['goods_price'], false);
                $row[$key]['format_drp_money'] = $this->dscRepository->getPriceFormat($value['drp_money'], false);
                $row[$key]['proportion'] = $value['proportion'] * 100;

                $returnGoods = ReturnGoods::where('rec_id', $value['rec_id']);

                $returnGoods = $returnGoods->whereHas('getOrderReturn', function ($query) use ($value) {
                    $query->where('refound_status', 1)
                        ->where('order_id', $value['order_id']);
                });

                $returnGoods = $returnGoods->with([
                    'getOrderReturn',
                    'getSellerNegativeOrder' => function ($query) {
                        $query->with([
                            'getSellerNegativeBill'
                        ]);
                    }
                ]);

                $returnGoods = $this->baseRepository->getToArrayFirst($returnGoods);

                $negativeBill = $returnGoods['get_seller_negative_order']['get_seller_negative_bill'] ?? [];
                $row[$key]['negativeBill'] = $negativeBill;

                $row[$key]['orderReturn'] = $returnGoods['get_order_return'] ?? [];


                if (!empty($returnGoods)) {
                    $row[$key]['is_return'] = 1;
                } else {
                    $row[$key]['is_return'] = 0;
                }

                if ($value['commission_rate'] > 0) {
                    $row[$key]['commission_rate'] = $value['commission_rate'] * 100;
                }
            }
        }

        $arr = ['goods_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']];
        return $arr;
    }

    /**
     * 获取商家已/未结算佣金
     *
     * @param int $ru_id
     * @param string $state
     * @param array $filter
     * @return string
     */
    public function merchantsIsSettlement($ru_id = 0, $state = '', $filter = [])
    {
        /* 查询 */
        $row = OrderInfo::selectRaw("*, (" . $this->orderCommissionField() . ") AS total_fee, (" . $this->orderActivityFieldAdd() . ") AS activity_fee")
            ->where('main_count', 0)
            ->where('ru_id', $ru_id);

        $row = $this->orderCommonService->orderQuerySelect($row, 'confirm_take');

        if ($filter) {
            if (isset($filter['order_sn']) && $filter['order_sn']) {
                $row = $row->where('order_sn', 'like', '%' . $this->dscRepository->mysqlLikeQuote($filter['order_sn']) . '%');
            }

            if (isset($filter['consignee']) && $filter['consignee']) {
                $row = $row->where('consignee', 'like', '%' . $this->dscRepository->mysqlLikeQuote($filter['consignee']) . '%');
            }

            if (isset($filter['order_cat']) && $filter['order_cat']) {
                switch ($filter['order_cat']) {
                    case 'stages':
                        $row = $row->where(function ($query) {
                            $query->baitiaoLogCount();
                        });
                        break;
                    case 'zc':
                        $row = $row->where('is_zc_order', 1);
                        break;
                    case 'store':
                        $row = $row->where(function ($query) {
                            $query->storeOrderCount();
                        });
                        break;
                    case 'other':
                        $row = $row->whereRaw("length(o.extension_code) > 0");
                        break;
                    case 'dbdd':
                        $row = $row->where('extension_code', 'snatch');
                        break;
                    case 'msdd':
                        $row = $row->where('extension_code', 'seckill');
                        break;
                    case 'tgdd':
                        $row = $row->where('extension_code', 'group_buy');
                        break;
                    case 'pmdd':
                        $row = $row->where('extension_code', 'auction');
                        break;
                    case 'jfdd':
                        $row = $row->where('extension_code', 'exchange_goods');
                        break;
                    case 'ysdd':
                        $row = $row->where('extension_code', 'presale');
                        break;
                    default:
                }
            }

            if (isset($filter['state']) && $filter['state'] > -1 && !empty($filter['state'])) {// liu  判断是否有结算状态查询
                $row = $row->where('is_settlement', $filter['state']);
            }

            if (!empty($filter['start_time'])) {
                $row = $row->where('add_time', '>=', $filter['start_time']);
            }

            if (!empty($filter['end_time'])) {
                $row = $row->where('add_time', '<=', $filter['end_time']);
            }
        }

        if (is_numeric($state)) {
            $row = $row->where('is_settlement', $state);
        }

        $row = $row->with([
            'getSellerBillOrder' => function ($query) {
                $query->select('bill_id', 'order_id');
            },
            'getOrderReturn' => function ($query) {
                $query->with([
                    'getSellerNegativeOrder'
                ]);
            }
        ]);

        $row = $this->baseRepository->getToArrayGet($row);

        $gain_commission_amount = 0;
        $all_brokerage_amount = 0;
        $all_drp = 0;

        $commission_info = [];
        if ($row) {
            for ($i = 0; $i < count($row); $i++) {
                $bill_order = $row[$i]['get_seller_bill_order'] ? $row[$i]['get_seller_bill_order'] : [];

                if (isset($bill_order['bill_id']) && !empty($bill_order['bill_id'])) {
                    $bill = SellerCommissionBill::where('id', $bill_order['bill_id']);
                    $bill = $this->baseRepository->getToArrayFirst($bill);
                    if ($bill) {
                        $commission_info = [
                            'commission_model' => $bill['commission_model'],
                            'percent_value' => $bill['proportion']
                        ];
                    }
                } else {
                    $commission_info = $this->getSellerCommissionInfo($ru_id);
                }

                $percent_value = !empty($commission_info) && !empty($commission_info['percent_value']) ? $commission_info['percent_value'] / 100 : 1;

                $row[$i]['formated_order_amount'] = $this->dscRepository->getPriceFormat($row[$i]['order_amount'], true);

                $row[$i]['formated_money_paid'] = $this->dscRepository->getPriceFormat($row[$i]['money_paid'], true);
                if (!isset($row[$i]['total_fee'])) {
                    $row[$i]['total_fee'] = 0;
                }
                $row[$i]['formated_total_fee'] = $this->dscRepository->getPriceFormat($row[$i]['total_fee'], true);

                $effective_amount = isset($row[$i]['return_amount']) ? $row[$i]['total_fee'] - $row[$i]['return_amount'] : $row[$i]['total_fee'];
                $row[$i]['formated_brokerage_amount'] = $this->dscRepository->getPriceFormat($effective_amount * $percent_value, true);
                $row[$i]['formated_effective_amount'] = $this->dscRepository->getPriceFormat($effective_amount, true);

                $row[$i]['short_order_time'] = $this->timeRepository->getLocalDate($this->config['time_format'], $row[$i]['add_time']);

                $return_amount_info = $this->orderRefoundService->orderReturnAmount($row[$i]['order_id']);
                $row[$i]['return_amount'] = $return_amount_info['return_amount'];
                $row[$i]['formated_return_amount'] = $this->dscRepository->getPriceFormat($row[$i]['return_amount'], true);

                $order = [
                    'goods_amount' => isset($row[$i]['goods_amount']) ? $row[$i]['goods_amount'] : 0,
                    'activity_fee' => isset($row[$i]['activity_fee']) ? $row[$i]['activity_fee'] : 0
                ];

                $orderReturn = $row[$i]['get_order_return'] ?? [];
                $orderReturn['return_shipping_fee'] = $orderReturn['return_shipping_fee'] ?? 0;
                $negativeOrder = $orderReturn['get_seller_negative_order'] ?? [];

                $shipping_fee = $row[$i]['shipping_fee'];
                if (empty($negativeOrder) && $row[$i]['shipping_fee'] > 0) {
                    if ($orderReturn['return_shipping_fee'] > 0 && $row[$i]['shipping_fee'] >= $orderReturn['return_shipping_fee']) {
                        $shipping_fee = $row[$i]['shipping_fee'] - $orderReturn['return_shipping_fee'];
                    }
                }

                /* 微分销 */
                if (file_exists(MOBILE_DRP)) {
                    $brokerage_amount = $this->getOrderDrpMoney($row[$i]['total_fee'], $ru_id, $row[$i]['order_id'], $order);

                    $total_return_amount = 0;
                    if ($brokerage_amount['total_fee'] > 0) {
                        if (empty($negativeOrder)) {
                            if ($brokerage_amount['total_fee'] >= $row[$i]['return_amount']) {
                                $total_return_amount = $brokerage_amount['total_fee'] - $row[$i]['return_amount'];
                            }
                        } else {
                            $total_return_amount = $brokerage_amount['total_fee'];
                        }
                    }

                    $row[$i]['formated_brokerage_amount'] = $this->dscRepository->getPriceFormat($total_return_amount * $percent_value, true);
                    $row[$i]['formated_effective_amount'] = $this->dscRepository->getPriceFormat($total_return_amount, true);

                    if ($commission_info && $commission_info['commission_model']) {
                        $order_goods_commission = $this->getOrderGoodsCommission($row[$i]['order_id']);

                        if ($row[$i]['goods_amount'] <= 0) {
                            $row[$i]['goods_amount'] = 1;
                        }

                        if ($order_goods_commission['should_amount'] > 0) {
                            $order_commission = $order_goods_commission['should_amount'] * $total_return_amount / ($order_goods_commission['goods_amount'] - $brokerage_amount['rate_activity']) + $brokerage_amount['should_amount'];
                        } else {
                            $order_commission = $total_return_amount + $brokerage_amount['should_amount'];
                        }

                        $all_brokerage_amount += $order_commission + $shipping_fee;

                        if ($order_goods_commission['gain_commission'] > 0) {
                            $gain_commission_amount = $order_goods_commission['gain_commission'] * $total_return_amount / ($order_goods_commission['goods_amount'] - $brokerage_amount['rate_activity']) + $brokerage_amount['gain_commission'];
                        } else {
                            $gain_commission_amount = $total_return_amount + $brokerage_amount['gain_commission'];
                        }

                    } else {
                        $all_brokerage_amount += $total_return_amount * $percent_value + $shipping_fee + $brokerage_amount['should_amount'];
                        $gain_commission_amount += $total_return_amount * (1 - $percent_value) + $brokerage_amount['gain_commission'];
                    }

                    $all_drp += $brokerage_amount['drp_money'];
                } else {
                    /* 商品佣金比例 start */
                    $goods_rate = $this->getAloneGoodsRate($row[$i]['order_id'], 0, $order);

                    if ($goods_rate) {

                        /**
                         * 减去商品单独佣金比例的商品总金额
                         * 剩余有效订单参与店铺佣金的金额
                         */
                        $row[$i]['total_fee'] = $row[$i]['total_fee'] - $goods_rate['total_fee'];

                        /**
                         * 扣除单独设置商品佣金比例的商品总金额
                         */
                        if ($goods_rate['total_fee']) {
                            if ($row[$i]['total_fee'] < 0) {
                                $row[$i]['total_fee'] = 0;
                            }
                        }
                    }
                    /* 商品佣金比例 end */

                    $total_return_amount = 0;
                    if ($row[$i]['total_fee'] > 0) {

                        $negativeOrder = $row[$i]['get_order_return']['get_seller_negative_order'] ?? [];

                        if (empty($negativeOrder)) {
                            if ($row[$i]['total_fee'] >= $row[$i]['return_amount']) {
                                $total_return_amount = $row[$i]['total_fee'] - $row[$i]['return_amount'];
                            }
                        } else {
                            $total_return_amount = $row[$i]['total_fee'];
                        }
                    }

                    $row[$i]['formated_brokerage_amount'] = $this->dscRepository->getPriceFormat($total_return_amount * $percent_value, true);
                    $row[$i]['formated_effective_amount'] = $this->dscRepository->getPriceFormat($total_return_amount, true);

                    $goods_rate['should_amount'] = isset($goods_rate['should_amount']) ? $goods_rate['should_amount'] : 0;

                    /* 佣金比率 by wu start */
                    if ($commission_info && $commission_info['commission_model']) {
                        $order_goods_commission = $this->getOrderGoodsCommission($row[$i]['order_id']);

                        if ($row[$i]['goods_amount'] <= 0) {
                            $row[$i]['goods_amount'] = 1;
                        }

                        if ($order_goods_commission['should_amount'] > 0) {
                            $order_commission = $order_goods_commission['should_amount'] * $total_return_amount / $order_goods_commission['goods_amount'] + $goods_rate['should_amount'];
                        } else {
                            $order_commission = $total_return_amount + $goods_rate['should_amount'];
                        }

                        $all_brokerage_amount += $order_commission + $shipping_fee;

                        if ($order_goods_commission['gain_commission'] > 0) {
                            $gain_commission_amount = $order_goods_commission['gain_commission'] * $total_return_amount / ($order_goods_commission['goods_amount'] - $goods_rate['rate_activity']) + $goods_rate['gain_commission'];
                        } else {
                            $gain_commission_amount = $total_return_amount + $goods_rate['gain_commission'];
                        }
                    } else {
                        $all_brokerage_amount += $total_return_amount * $percent_value + $shipping_fee + $goods_rate['should_amount'];
                        $gain_commission_amount += $total_return_amount * (1 - $percent_value) + $goods_rate['gain_commission'];
                    }
                    /* 佣金比率 by wu end */
                }
            }

            $row['gain_commission_amount'] = $gain_commission_amount;
            $row['all_brokerage_amount'] = $all_brokerage_amount;
            $row['all_drp'] = $all_drp;
        }

        $row['gain_commission_amount'] = $row['gain_commission_amount'] ?? 0;
        $row['all_brokerage_amount'] = $row['all_brokerage_amount'] ?? 0;

        /* 微分销 */
        if (file_exists(MOBILE_DRP)) {
            if ($row) {

                $row['gain_commission_amount'] = $row['gain_commission_amount'] ?? 0;
                $row['all_brokerage_amount'] = $row['all_brokerage_amount'] ?? 0;
                $row['all_drp'] = $row['all_drp'] ?? 0;

                $row['all_gain_commission'] = $this->dscRepository->changeFloat($row['gain_commission_amount']);
                $row['all_price'] = $this->dscRepository->changeFloat($row['all_brokerage_amount']);
                $row['all_drp_price'] = $this->dscRepository->changeFloat($row['all_drp']);

                $row['gain_all'] = $this->dscRepository->getPriceFormat($row['gain_commission_amount'], true);
                $row['all'] = $this->dscRepository->getPriceFormat($row['all_brokerage_amount'], true);
                $row['all_drp'] = $this->dscRepository->getPriceFormat($row['all_drp'], true);
            }

            return $row;
        } else {
            $row['gain_commission_amount'] = $row['gain_commission_amount'] ?? 0;
            $row['all_brokerage_amount'] = $row['all_brokerage_amount'] ?? 0;

            $row['all_gain_commission'] = $this->dscRepository->changeFloat($row['gain_commission_amount']);
            $row['all_price'] = $this->dscRepository->changeFloat($row['all_brokerage_amount']);

            $row['gain_all'] = $this->dscRepository->getPriceFormat($row['gain_commission_amount'], true);
            $row['all'] = $this->dscRepository->getPriceFormat($row['all_brokerage_amount'], true);
            return $row;
        }
    }

    /**
     * 商家订单有效金额和退款金额
     *
     * @param int $ru_id
     * @return mixed
     */
    public function merchantsOrderValidRefund($ru_id = 0)
    {
        $res = OrderInfo::selectRaw("GROUP_CONCAT(order_id) AS orderid, GROUP_CONCAT(order_sn) AS order_sn, SUM((" . $this->orderCommissionField() . ")) AS total_fee, SUM((" . $this->orderActivityFieldAdd() . ")) AS activity_fee, SUM(goods_amount) AS goods_amount")
            ->where('main_count', 0);

        $res = $this->orderCommonService->orderQuerySelect($res, 'confirm_take');

        $res = $res->where('ru_id', $ru_id);

        $res = $this->baseRepository->getToArrayFirst($res);

        $return_amount_info = $this->orderRefoundService->orderReturnAmount($res['orderid']);

        if ($res) {
            $res['return_amount'] = $return_amount_info['return_amount'];
        }

        if (!isset($res['total_fee'])) {
            $res['total_fee'] = 0;
        }

        if ($res && $res['total_fee'] > 0) {
            $order = [
                'goods_amount' => $res['goods_amount'],
                'activity_fee' => $res['activity_fee']
            ];

            $goods_rate = $this->getAloneGoodsRate(0, $ru_id, $order);

            if ($goods_rate && $goods_rate['total_fee'] > 0) {
                if ($goods_rate['rate_activity']) {
                    $res['total_fee'] = $res['total_fee'] + $goods_rate['rate_activity'];
                }

                $res['order_total_fee'] = $res['total_fee'] - $goods_rate['total_fee'];
                $res['goods_total_fee'] = $goods_rate['total_fee'];
            } else {
                $res['order_total_fee'] = $res['total_fee'];
                $res['goods_total_fee'] = 0;
            }

            $total_fee = $res['order_total_fee'];
        } else {
            $total_fee = $res['total_fee'];
        }

        /* 微分销 */
        if (file_exists(MOBILE_DRP) && $res) {
            $order_drp = $this->getOrderDrpMoney($total_fee, $ru_id);
            $res['total_fee'] = $order_drp['total_fee'];
            $res['drp_money'] = $order_drp['drp_money'];
        }

        if (!isset($res['order_total_fee']) || $res['order_total_fee'] < 0) {
            $res['order_total_fee'] = 0;
        }

        if (!isset($res['goods_total_fee']) || $res['goods_total_fee'] < 0) {
            $res['goods_total_fee'] = 0;
        }

        if ($res['goods_total_fee'] > 0) {
            $res['total_fee'] = $res['order_total_fee'] + $res['goods_total_fee'];
        }

        /* 判断是否存在商品佣金比例 */
        if (isset($goods_rate) && !empty($goods_rate)) {
            $res['is_goods_rate'] = 1;
        } else {
            $res['is_goods_rate'] = 0;
        }

        if (isset($res['orderid'])) {
            $res['order_id'] = $res['orderid'];
            unset($res['orderid']);
        }

        return $res;
    }

    /**
     * 统计账单（全部|已结算|未结算）
     *
     * @param int $ru_id
     * @param int $order_id
     * @return array
     */
    public function sellerOrderSettlementLog($ru_id = 0, $order_id = 0)
    {

        $gain_no_settlement_price = $this->getSettlementPrice($ru_id, $order_id, 0, 'gain_amount');
        $gain_is_settlement_price = $this->getSettlementPrice($ru_id, $order_id, 1, 'gain_amount');
        $no_settlement_price = $this->getSettlementPrice($ru_id, $order_id, 0, 'actual_amount');
        $is_settlement_price = $this->getSettlementPrice($ru_id, $order_id, 1, 'actual_amount');

        $settlement_all = $gain_no_settlement_price + $gain_is_settlement_price + $no_settlement_price + $is_settlement_price;

        $arr = [
            'gain_no_settlement_price' => $gain_no_settlement_price,
            'gain_is_settlement_price' => $gain_is_settlement_price,
            'settlement_all' => $settlement_all,
            'no_settlement' => $no_settlement_price,
            'is_settlement' => $is_settlement_price
        ];

        return $arr;
    }

    /**
     * 统计是否结算金额
     *
     * @param int $ru_id
     * @param int $order_id
     * @param int $type
     * @param string $sumType
     * @return int|string
     */
    public function getSettlementPrice($ru_id = 0, $order_id = 0, $type = -1, $sumType = '')
    {
        $res = OrderSettlementLog::whereRaw(1);

        $ru_id = $this->baseRepository->getExplode($ru_id);

        $res = $res->whereIn('ru_id', $ru_id);

        if ($order_id > 0) {
            $res = $res->where('order_id', $order_id);
        }

        if ($type > -1) {
            $res = $res->where('is_settlement', $type);
        }

        $total = $res->sum($sumType);
        $total = $total > 0 ? $this->dscRepository->changeFloat($total) : 0;

        return $total;
    }

    /**
     * 生成查询佣金总金额的字段
     * @param string $alias order表的别名（包括.例如 o.）
     * @return  string
     *  + {$alias}shipping_fee  不含运费
     */
    public function orderCommissionField($alias = '')
    {
        return "   {$alias}goods_amount + {$alias}tax" .
            " + {$alias}insure_fee + {$alias}pay_fee + {$alias}pack_fee" .
            " + {$alias}card_fee - {$alias}discount - {$alias}coupons - {$alias}integral_money - {$alias}bonus ";
    }

    /**
     * 生成查询订单总金额的字段
     *
     * @return string
     */
    public function orderCommissionTotalField()
    {
        return " goods_amount + tax + shipping_fee + insure_fee + pay_fee + pack_fee + card_fee ";
    }

    /**
     * 生成计算应付款金额的字段
     * @param string $alias order表的别名（包括.例如 o.）
     * @return  string
     */
    public function orderActivityFieldAdd($alias = '')
    {
        return " {$alias}discount + {$alias}coupons + {$alias}integral_money + {$alias}bonus ";
    }

    /**
     * 查询账单内退款负账单总金额
     *
     * @param int $bill_id
     * @param int $seller_id
     * @param int $end_time
     * @return mixed
     */
    public function getNegativeBllTotal($seller_id = 0, $end_time = 0, $bill_id = 0)
    {

        $negative_info = SellerNegativeBill::selectRaw('SUM(return_amount) AS amount, SUM(return_shippingfee) AS shippingfee, SUM(return_amount + return_shippingfee) AS total, GROUP_CONCAT(id) AS negative_id')
            ->where('seller_id', $seller_id);

        if ($bill_id > 0) {
            $negative_info = $negative_info->where('commission_bill_id', $bill_id);
        } else {
            $negative_info = $negative_info->where('chargeoff_status', 0)
                ->where('end_time', '<=', $end_time)
                ->where('commission_bill_id', 0);
        }

        $negative_info = $this->baseRepository->getToArrayFirst($negative_info);

        $negative_info['negative_id'] = isset($negative_info['negative_id']) ? $negative_info['negative_id'] : 0;
        $negative_info['amount'] = isset($negative_info['amount']) ? number_format($negative_info['amount'], 2, '.', '') : 0;
        $negative_info['shippingfee'] = isset($negative_info['shippingfee']) ? number_format($negative_info['shippingfee'], 2, '.', '') : 0;
        $negative_info['total'] = isset($negative_info['total']) ? number_format($negative_info['total'], 2, '.', '') : 0;

        return $negative_info;
    }
}
