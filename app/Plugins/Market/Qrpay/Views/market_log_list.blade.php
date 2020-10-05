
<style>
/* 修正导出时间样式 */
ul, li {overflow: hidden;}
.dates_box_top {height: 32px;}
.dates_bottom {height: auto;}
.dates_hms {width: auto;}
.dates_btn {width: auto;}
.dates_mm_list span {width: auto;}

</style>

<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a>{{ $config['name'] }} - 收款记录</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}">收款码</a></li>
                <li class="curr"><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
            </ul>
        </div>
        <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>1. 搜索功能：支持搜索收款订单号。</li>
                <li>2. 筛选功能：按收款码类型，按标签筛选。</li>
                <li>3. 导出功能：支持按选择时间段导出到Excel表格。</li>
            </ul>
        </div>
		<div class="flexilist">
            <div class="common-head">
                <div class="fl">
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
@if(isset($tag_list))
@foreach($tag_list as $tag)

                                <option value="{{ $tag['id'] }}"
@if($qr_tag == $tag['id'])
 selected
@endif
 >{{ $tag['tag_name'] }}</option>

@endforeach
@endif
                            </select>
                        </div>
                    </div>
                </div>

                <div class="search">
                    <form action="{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) !!}" method="post">
                    <div class="input">
                        @csrf
                        <input type="text" name="keyword" class="text nofocus" placeholder="搜索收款订单号" autocomplete="off"><input type="submit" value="" class="btn" name="export">
                    </div>
                    </form>
                </div>

            </div>
            <div class="common-content">
                <div class="list-div">
                    <table class="table-hover table-striped" style="min-width: 300px;">
                        <thead class="navbar-inner">
                            <tr>
                                <th class="col-sm-2 text-center">收款订单号</th>
                                <th class="col-sm-1 text-center">下单时间</th>
                                <th class="col-sm-1 text-center">收款金额(元)</th>
                                <th class="col-sm-1 text-center">收款码类型</th>
                                <th class="col-sm-1 text-center">标签</th>
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
                                <td>{{ $val['tag_name'] }}</td>
                                <td>{{ $val['user_name'] }}</td>
                                <td>{{ $val['payment_code'] }}</td>
                                <td>{{ $val['pay_status'] }}</td>
                                <td>{{ $val['pay_desc'] }}</td>
                                <td class="handle">
                                <div class="tDiv a3">
                                    <a class="btn_see trade_info" href="javascript:;" data-item="{{ $val['id'] }}" title="查看详情" ><i class="fa fa-eye"></i>{{ $lang['wechat_see'] }}</a>
                                    <a class="btn_trash log_delete" href="javascript:;" data-href="{!! route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'log_delete', 'log_id' => $val['id']))  !!}"  title="删除" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>
                                </div>
                                </td>
                            </tr>

@endforeach


@if(empty($list))

                            <tr class="no-records" ><td colspan="10">没有找到任何记录</td></tr>

@endif

                        </tbody>
                    </table>
                </div>
		    </div>
	    </div>
        <div class="list-div of">
            <table cellspacing="0" cellpadding="0" border="0">
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="tDiv of">
                                <div class="fl">
                                    <form action="{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'export_qrpay_log')) !!}" method="post">
                                    <div class="label_value">
                                        <div class="text_time" id="text_time1" style="float:left;">
                                            <input type="text" name="starttime"  class="text" value="{{ date('Y-m-d H:i', mktime(0,0,0,date('m'), date('d')-7, date('Y'))) }}" id="promote_start_date" class="text mr0" readonly>
                                        </div>

                                        <div class="text_time" id="text_time2"  style="float:left;">
                                            <input type="text" name="endtime"  class="text" value="{{ date('Y-m-d H:i') }}" id="promote_end_date" class="text" readonly >
                                        </div>
                                        @csrf
                                        <input type="hidden" name="ru_id" value="{{ $ru_id }}">
                                        <input type="submit" name="export" value="导出" class="button bg-green" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td colspan="10">
                            @include('admin.wechat.pageview')
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
            $.post(url, '', function(data){
                layer.msg(data.msg);
                if(data.error == 0 ){
                    if(data.url != ''){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
                return false;
            }, 'json');
        });
    });

    // 切换收款码类型筛选
    $('.select_type').change(function(){
        var op = $(this).children('option:selected').val(); //是selected的值
        var url = "{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) !!}";
        if (op) {
             window.location.href = url+"&qr_type="+op;
        }
    });

    // 切换标签筛选
    $('.select_tag').change(function(){
        var op = $(this).children('option:selected').val(); //是selected的值
        var url = "{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) !!}";
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
        $.post("{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_info')) !!}", {log_id:log_id}, function(data){
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
