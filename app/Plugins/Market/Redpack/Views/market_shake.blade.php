
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a>{{ $lang['wechat_menu'] }} - {{ $config['name'] }} 摇一摇广告管理</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li class="curr"><a href="#">{{ $act_name }} 广告列表</a></li>
                <!-- <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'share_setting', 'id' => $config['market_id'])) }}">设置分享</a></li> -->
            </ul>
        </div>
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>1、每个活动建议至少添加两则以上的摇一摇广告</li>
                <li>2、用户参与活动，会按随机抽取获得领取红包资格，如果没有抽到资格的，则会随机推送一则广告展示给用户。</li>
                <li>3、摇一摇广告可以用作商城推广的一个引流入口，比如推荐商品链接，推荐文章链接等等引导用户进入商城购买商品，提高购买转化率。</li>
            </ul>
        </div>
		<div class="flexilist of">
			<div class="common-head">
                <div class="fl">
                	<a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'handler' => 'edit', 'id' => $config['market_id'])) }}" class="fancybox fancybox.iframe" ><div class="fbutton"><div class="add " title="添加广告"><span><i class="fa fa-plus"></i>添加广告</span></div></div></a>
                </div>
            </div>
            <div class="common-content">
                <div class="col-md-12 col-sm-12 col-lg-12" style="padding:0;">
                    <div class="list-div">
                        <table class="table-hover table-striped" style="min-width: 300px;">
                            <thead class="navbar-inner">
                                <tr>
                                    <th class="col-sm-1 text-center">id</th>
                                    <th class="col-sm-2 text-center">广告图标</th>
                                    <th class="col-sm-4 text-center">广告内容</th>
                                    <th class="col-sm-3 text-center">广告链接</th>
                                    <th class="col-sm-2 text-center">操作</th>
                                </tr>
                            </thead>
                            <tbody>

@foreach($list as $advertice)

                                <tr class="text-center adv-list">
                                    <td>{{ $advertice['id'] }}</td>
                                    <td><img src="{{ $advertice['icon'] }}" style="width:20%;height:auto;"/></td>
                                    <td>{{ $advertice['content'] }}</td>
                                    <td>{{ $advertice['url'] }}</td>
                                    <td class="handle">
                                    <div class="tDiv a2">
                                        <a class="btn_edit fancybox fancybox.iframe" href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'handler' => 'edit', 'id' => $config['market_id'], 'advertice_id' => $advertice['id'])) }}"  title="编辑" ><i class="fa fa-edit"></i>{{ $lang['wechat_editor'] }}</a>
                                        <a class="btn_trash shake_delete" href="javascript:;" data-href="{!!  route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'shake_delete', 'market_id' => $config['market_id'], 'advertice_id' => $advertice['id']))  !!}"  title="删除" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>
                                    </div>
                                    </td>
                                </tr>

@endforeach


@if(empty($list))

                                <tr class="no-records" ><td colspan="5">没有找到任何记录</td></tr>

@endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>

        <div class="list-div of">
            <table cellspacing="0" cellpadding="0" border="0">
                <tfoot>
                    <tr>
                        <td colspan="5">
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

    // 删除广告记录
    $(".shake_delete").click(function(){
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

});
</script>
