
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_index') }}" class="s-back">返回</a>{{ $config['name'] }} - 标签管理</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}">收款码</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
                <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
                <li class="curr"><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
            </ul>
        </div>
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <!-- <li>标签</li> -->
            </ul>
        </div>
		<div class="flexilist of">
			<div class="common-head">
                <div class="fl">
                	<a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $config['market_id'])) }}"  class="fancybox fancybox.iframe" ><div class="fbutton"><div class="add " title="添加标签"><span><i class="fa fa-plus"></i>添加标签</span></div></div></a>
                </div>
            </div>
            <div class="common-content">
            	<div class="list-div">
    				<table class="table-hover table-striped">
                    <tr class="text-center">
                        <th class="text-center">id</th>
                        <th class="text-center">标签名称</th>
                        <th class="text-center">相关自助收款码数量</th>
                        <th class="text-center">相关指定金额收款码数量</th>
                        <th class="text-center">创建时间</th>
                        <th class="text-center">操作</th>
                    </tr>

@foreach($list as $val)

                    <tr class="text-center wall-list">
                        <td>{{ $val['id'] }}</td>
                        <td>{{ $val['tag_name'] }}</td>
                        <td>{{ $val['self_qrpay_num'] }}</td>
                        <td>{{ $val['fixed_qrpay_num'] }}</td>
                        <td>{{ $val['add_time'] }}</td>
                        <td class="handle">
                            <div class="tDiv a2">

                                <a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $val['id'])) }}" class="btn_edit fancybox fancybox.iframe" ><i class="fa fa-edit"></i>{{ $lang['wechat_editor'] }}</a>
                                <a class="btn_trash tag_delete" data-href="{!!  route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'tag_delete', 'id' => $val['id']))  !!}" href="javascript:;" class="btn_trash" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>

                            </div>
                        </td>
                    </tr>

@endforeach


@if(empty($list))

                    <tbody>
                        <tr><td class="no-records" colspan="6">没有找到任何记录</td></tr>
                    </tbody>

@endif

                        <tfoot>
                        <tr>
                            <td colspan="6">
                            @include('admin.wechat.pageview')
                            </td>
                        </tr>
                        </tfoot>
                    </table>
		        </div>
		    </div>
	    </div>
	</div>
</div>

<script type="text/javascript">
    // 删除标签
    $(".tag_delete").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要删除此条记录吗？', {
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
</script>
