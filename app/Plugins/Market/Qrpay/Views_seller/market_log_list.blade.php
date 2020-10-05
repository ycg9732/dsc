<style>
/*ul, li {overflow: hidden;}*/
.dates_box_top {height: 32px;}
.dates_bottom {height: auto;}
.dates_hms {width: auto;}
.dates_btn {width: auto;}
.dates_mm_list span {width: auto;}

</style>
<div class="wrapper-right of">
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a></li>
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" > 收款码</a></li>
            <li role="presentation" class="active"><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>1. 搜索功能：支持搜索收款订单号。</li>
            <li>2. 筛选功能：按收款码类型，按标签筛选。</li>
            <li>3. 导出功能：支持按选择时间段导出到Excel表格。</li>
            <li>4. 已结算资金，可以在菜单-> 商家 -> 店铺账户 -> 账户明细和资金明细里 <a href="../seller/merchants_account.php?act=account_manage&act_type=account" >点击查看</a>。</li>
        </ul>
    </div>

    <div class="common-head mt20">
        <div class="fl mb10">
            <div class="label_value">
                <div class="fl" >
                    <select name="data[qrpay_type]" class="form-control select_type">
                        <option value='0' >所有收款码</option>
                        <option value="1"
@if($qr_type == '1')
 selected
@endif
 >指定金额收款码</option>
                        <option value="2"
@if($qr_type == '2')
 selected
@endif
 >自助收款码</option>
                    </select>
                </div>
                <div class="pl10 fl" >
                    <select name="data[tag_id]" class="form-control select_tag">
                        <option value='0' >所有标签</option>

@foreach($tag_list as $tag)

                        <option value="{{ $tag['id'] }}"
@if($qr_tag == $tag['id'])
 selected
@endif
 >{{ $tag['tag_name'] }}</option>

@endforeach

                    </select>
                </div>
            </div>
        </div>

        <div class="search-info">
            <div class="search-form">
            <form action="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}" method="post">
                <div class="search-key">
                    <input type="text" name="keyword" class="text nofocus " placeholder="搜索收款订单号" autocomplete="off">
                    <input type="submit" value="" class="btn submit" name="export">
                </div>
            </form>
            </div>
        </div>
    </div>

	<div class="wrapper-list mt20" >

        <div class="list-div" id="listDiv">
            <table id="list-table" class="ecsc-default-table" style="">
                <thead class="navbar-inner">
                    <tr>
                        <th class="col-sm-2 text-center">收款订单号</th>
                        <th class="col-sm-1 text-center">下单时间</th>
                        <th class="col-sm-1 text-center">收款金额(元)</th>
                        <th class="col-sm-1 text-center">收款码类型</th>
                        <th class="col-sm-1 text-center">用户</th>
                        <th class="col-sm-1 text-center">支付方式</th>
                        <th class="col-sm-1 text-center">交易状态</th>
                        <th class="col-sm-2 text-center">备注</th>
                        <th class="col-sm-3 text-center">操作</th>
                    </tr>
                </thead>
                <tbody>

@foreach($list as $val)

                    <tr class="text-center">
                        <td>{{ $val['pay_order_sn'] }}</td>
                        <td>{{ $val['add_time'] }}</td>
                        <td>{{ $val['pay_amount'] }}</td>
                        <td>{{ $val['qrpay_type'] }}</td>
                        <td>{{ $val['user_name'] }}</td>
                        <td>{{ $val['payment_code'] }}</td>
                        <td>{{ $val['pay_status'] }}，{{ $val['is_settlement'] }}</td>
                        <td>{{ $val['pay_desc'] }}</td>
                        <td class="handle">
                        <div class="tDiv a3">
                            <a class="btn_see trade_info" href="javascript:;" data-item="{{ $val['id'] }}" title="查看详情" ><i class="fa fa-eye"></i>{{ $lang['wechat_see'] }}</a>
                            <!-- <a class="btn_trash is_settlement" href="javascript:;" data-href="{!! route('seller/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'is_settlement', 'log_id' => $val['id'])) !!}"  title="结算" ><i class="fa fa-yen"></i>结算</a> -->
                            <a class="btn_trash log_delete" href="javascript:;" data-href="{!!  route('seller/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'log_delete', 'log_id' => $val['id']))  !!}"  title="删除" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>
                        </div>
                        </td>
                    </tr>

@endforeach


@if(empty($list))

                    <tr class="no-records" ><td colspan="9">没有找到任何记录</td></tr>

@endif

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9" class="td_border">
                            <div class="tDiv of">
                                <div class="fl">
                                    <form action="{!! route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'export_qrpay_log'))  !!}" method="post">
                                    <div class="label_value">
                                        <div class="text_time" id="text_time1" style="float:left;">
                                            <input type="text" name="starttime"  class="text" value="{{ date('Y-m-d H:i', mktime(0,0,0,date('m'), date('d')-7, date('Y'))) }}" id="promote_start_date" class="text mr0" readonly>
                                        </div>

                                        <div class="text_time ml10" id="text_time2"  style="float:left;">
                                            <input type="text" name="endtime"  class="text" value="{{ date('Y-m-d H:i') }}" id="promote_end_date" class="text" readonly >
                                        </div>
                                        @csrf
                                        <input type="hidden" name="ru_id" value="{{ $ru_id }}">
                                        <input type="submit" name="export" value="导出" class="sc-btn button bg-green ml10" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @include('seller.base.seller_pageview')

    </div>

</div>
<script type="text/javascript">
$(function(){
    // 删除日志记录
    $(".log_delete").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要删除此条记录吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
                layer.msg(data.msg);
                if(data.error == 0 ){
                    if(data.url){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
                return false;
            }, 'json');
        });
    });

    // 删除日志记录
    $(".is_settlement").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要结算吗？结算后收款金额充值进入商家账户', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
                layer.msg(data.msg);
                if(data.error == 0 ){
                    if(data.url){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
                return false;
            }, 'json');

            layer.closeAll();// 关闭弹窗
        });
    });

    // 切换收款码类型筛选
    $('.select_type').change(function(){
        var op = $(this).children('option:selected').val(); //是selected的值
        var url = "{!! route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) !!}";
        if (op) {
             window.location.href = url+"&qr_type="+op;
        }
    });

    // 切换标签筛选
    $('.select_tag').change(function(){
        var op = $(this).children('option:selected').val(); //是selected的值
        var url = "{!!  route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list'))  !!}";
        if (op) {
             window.location.href = url+"&qr_tag="+op;
        }
    });

    var opts1 = {
        'targetId':'promote_start_date',
        'triggerId':['promote_start_date'],
        'alignId':'text_time1',
        'format':'-',
        'hms':'off'
    },opts2 = {
        'targetId':'promote_end_date',
        'triggerId':['promote_end_date'],
        'alignId':'text_time2',
        'format':'-',
        'hms':'off'
    }

    xvDate(opts1);
    xvDate(opts2);

    // 查看交易详情
    $('.trade_info').click(function(){
        var log_id = $(this).attr("data-item");
        $.get("{!!  route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_info'))  !!}", {log_id:log_id}, function(data){
            if (data.erro > 0) {
                layer.msg(data.msg);
            } else {
                //页面层-自定义
                layer.open({
                  type: 1,
                  closeBtn: 1,
                  shift: 7,
                  shadeClose: true,
                  title: "交易详情",
                  content: '<div class="form-group trade-info" style="width:350px;padding:10px;"  >'+'<div class="panel-body"><dl><dt class="" >交易单号：'+data.data.trade_no+'</dt><dt class="" >交易金额：'+data.data.amount+'</dt><dt class="" >支付时间：'+data.data.pay_time+'</dt><dt class="" >买家账号：'+data.data.buyer_account+'</dt></dl></div>'+'</div>'
                });
            }
            return false;
        }, 'json');
    });

})
</script>