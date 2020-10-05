
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a>{{ $config['name'] }} - 收款码优惠</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}">收款码</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
                <li class="curr"><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
            </ul>
        </div>
        <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>1. 收款码优惠是一种针对扫描二维码支付的营销活动，通过设置一定额度的优惠，鼓励消费者使用二维码支付。</li>
                <li>2. 添加新的优惠活动需要先将不需要的优惠活动设置失效。</li>
                <li>3. 失效后的优惠活动不可再编辑与使用，只做记录查询使用。</li>
            </ul>
        </div>
		<div class="flexilist of">
            <div class="common-head">
                <div class="fl">

@if($disabled_num == '1')

                    <a href="javascript:;" ><div class="fbutton"><div class="add disabled" title="添加优惠"><span><i class="fa fa-plus"></i>添加优惠</span></div></div></a>

@else

                    <a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts', 'handler' => 'edit', 'id' => $config['market_id'])) }}"  ><div class="fbutton"><div class="add " title="添加优惠"><span><i class="fa fa-plus"></i>添加优惠</span></div></div></a>

@endif

                </div>
            </div>
            <div class="common-content">
                <div class="list-div">
                    <table class="table-hover table-striped" style="min-width: 300px;">
                        <thead class="navbar-inner">
                            <tr>
                                <th class="col-sm-2 text-center">收款码优惠</th>
                                <th class="col-sm-1 text-center">当前状态</th>
                                <th class="col-sm-3 text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>

@foreach($list as $val)

                            <tr class="text-center">
                                <td>{{ $val['dis_name'] }}</td>
                                <td>{{ $val['status_fromat'] }}</td>
                                <td class="handle">
                                <div class="tDiv a2">

@if($val['status'] == '1')

                                    <a class="btn_edit" href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts', 'handler' => 'edit', 'id' => $val['id'])) }}"><i class="fa fa-edit"></i>编辑</a>
                                    <a class="btn_trash disabled_dis" href="javascript:;" data-href="{!!  route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'disabled', 'id' => $val['id']))  !!}"  title="使失效" ><i class="fa fa-ban"></i>使失效</a>

@endif

                                </div>
                                </td>
                            </tr>

@endforeach


@if(empty($list))

                            <tr class="no-records" ><td colspan="3">没有找到任何记录</td></tr>

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
                        <td colspan="3">
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
    // 使优惠活动失效
    $(".disabled_dis").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要将优惠活动设置为失效吗？失效后无法再编辑和使用', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
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
})
</script>
