<?php

namespace App\Http\Controllers;

use App\Models\WholesaleCat;
use App\Services\Article\ArticleCommonService;
use App\Services\Common\CommonService;
use App\Services\Wholesale\CategoryService;
use App\Services\Wholesale\GoodsService;
use App\Services\Wholesale\WholesaleService;

/**
 * 调查程序
 */
class WholesaleSuppliersController extends InitController
{
    protected $categoryService;
    protected $wholesaleService;
    protected $goodsService;
    protected $articleCommonService;
    protected $commonService;

    public function __construct(
        CategoryService $categoryService,
        WholesaleService $wholesaleService,
        GoodsService $goodsService,
        ArticleCommonService $articleCommonService,
        CommonService $commonService
    )
    {
        $this->categoryService = $categoryService;
        $this->wholesaleService = $wholesaleService;
        $this->goodsService = $goodsService;
        $this->articleCommonService = $articleCommonService;
        $this->commonService = $commonService;
    }

    public function index()
    {
        $user_id = session('user_id', 0);

        //访问权限
        $wholesaleUse = $this->commonService->judgeWholesaleUse($user_id);

        if ($wholesaleUse['return']) {
            if ($user_id) {
                return show_message($GLOBALS['_LANG']['not_seller_user']);
            } else {
                return show_message($GLOBALS['_LANG']['not_login_user']);
            }
        }

        $default_sort_order_method = $GLOBALS['_CFG']['sort_order_method'] == '0' ? 'DESC' : 'ASC';
        $default_sort_order_type = $GLOBALS['_CFG']['sort_order_type'] == '0' ? 'goods_id' : ($GLOBALS['_CFG']['sort_order_type'] == '1' ? 'shop_price' : 'last_update');

        $page = (int)request()->input('page', 1);
        $size = !empty($_CFG['page_size']) && intval($_CFG['page_size']) > 0 ? intval($_CFG['page_size']) : 10;
        $sort = request()->input('sort', '');
        $sort = in_array(trim(strtolower($sort)), array('sort_order')) ? trim($sort) : $default_sort_order_type;
        $order = request()->input('order', '');
        $order = in_array(trim(strtoupper($order)), array('ASC', 'DESC')) ? trim($order) : $default_sort_order_method;

        /* ------------------------------------------------------ */
        //-- act 操作项的初始化
        /* ------------------------------------------------------ */
        $act = addslashes(trim(request()->input('act', 'list')));
        $act = $act ? $act : 'list';

        /* ------------------------------------------------------ */
        //-- 分类列表页
        /* ------------------------------------------------------ */
        if ($act == 'list') { //批发分类页
            $suppliers_id = (int)request()->input('suppliers_id', 0);

            $cat_list = $this->categoryService->getCategoryList();
            $this->smarty->assign('cat_list', $cat_list);

            $supplier = $this->goodsService->getSupplierHome($suppliers_id);

            $this->smarty->assign('supplier', $supplier);
            $position = assign_ur_here();

            $goods_list = $this->goodsService->getSuppliersList($suppliers_id, $size, $page, 'goods_id', 'DESC');

            $count = $this->goodsService->getSuppliersCount($suppliers_id);

            $get_wholsale_navigator = $this->wholesaleService->getWholsaleNavigator();
            $this->smarty->assign('get_wholsale_navigator', $get_wholsale_navigator);

            $this->smarty->assign('goods_list', $goods_list);
            $this->smarty->assign('page_title', $position['title']);    // 页面标题
            $this->smarty->assign('ur_here', $position['ur_here']);  // 当前位置
            $this->smarty->assign('helps', $this->articleCommonService->getShopHelp());       // 网店帮助

            $this->wholesaleService->assignCatPager('wholesale_suppliers', $suppliers_id, $count, '', $size, $sort, $order, $page);
            assign_template('wholesale');

            /* 显示模板 */
            return $this->smarty->display('wholesale_suppliers.dwt');
        }
    }
}