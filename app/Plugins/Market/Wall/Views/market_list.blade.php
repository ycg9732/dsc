
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_index') }}" class="s-back">返回</a>{{ $lang['wechat_menu'] }} - {{ $config['name'] }}</div>
	<div class="content_tips">
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>一、上墙信息，即当前活动所有用户的留言数量。参与人员，即当前活动参与用户的数量。</li>
                <li>二、点击数据：可查看当前活动消息并审核，参与人员，获奖名单。</li>
                <li>三、点击上墙地址，获得微信墙二维码地址，用微信扫描即可进入参与活动，或将相应活动“关键词”添加至微信自定义菜单，用户关注微信公众号后点击进入。</li>
                <li>四、大屏幕：主要是用来展示在幻灯片大屏幕上，显示参与用户，用户留言，进行抽奖。（可单独用一台电脑打开，然后通过幻灯片放大展示）</li>
            </ul>
        </div>
		<div class="flexilist of">
			<div class="common-head">
                <div class="fl">
                	<a href="{{ route('admin/wechat/market_edit', array('type' => $config['keywords'])) }}" ><div class="fbutton"><div class="add " title="添加活动"><span><i class="fa fa-plus"></i>添加活动</span></div></div></a>
                </div>
            </div>
            <div class="common-content">
            	<div class="list-div">
    				<table class="table-hover table-striped">
                    <tr class="text-center">
                        <!-- <th class="text-center">活动ID</th> -->
                        <th class="text-center">活动名称</th>
                        <th class="text-center">关键词</th>
                        <th class="text-center">活动时间</th>
                        <th class="text-center">上墙信息</th>
                        <th class="text-center">参与人数</th>
                        <th class="text-center">状态</th>
                        <th class="text-center" width="45%">操作</th>
                    </tr>

@foreach($list as $val)

                    <tr class="text-center wall-list">
                        <!-- <td>{{ $val['id'] }}</td> -->
                        <td>{{ $val['name'] }}</td>
                        <td>{{ $val['command'] }}</td>
                        <td>{{ $val['starttime'] }} ~ {{ $val['endtime'] }}</td>
                        <td>{{ $val['msg_count'] }}</td>
                        <td>{{ $val['user_count'] }}</td>
                        <td>{{ $val['status'] }}</td>
                        <td>
                        <div class="info_btn">
                            <a class="button btn-info bg-green" href="{{ route('admin/wechat/market_edit', array('type' => $config['keywords'], 'id' => $val['id'])) }}">编辑</a>
                            <a class="button btn-danger bg-red" href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'messages', 'id' => $val['id'], 'status' => 'all')) }}">数据</a>
                            <a class="button btn-primary" href="{{ route('wechat/market_show', array('type' => $config['keywords'], 'function' => 'wall_msg', 'wall_id' => $val['id'])) }}" target="_blank">大屏幕</a>
                            {{--<!-- <a class="button btn-primary" href="{{ route('wechat/market_show', array('type' => $config['keywords'], 'function' => 'wall_prize_new', 'wall_id' => $val['id'])) }}" target="_blank">大屏幕</a> -->--}}
                            <a class="button btn-primary fancybox fancybox.iframe getqr" href="{{ route('admin/wechat/market_qrcode', array('type' => $config['keywords'], 'id' => $val['id'])) }}">上墙地址</a>
                            <a class="button btn-danger bg-red delete" data-href="{!!  route('admin/wechat/market_del', array('type' => $config['keywords'], 'id' => $val['id']))  !!}" href="javascript:;">删除</a>
                        </div>
                        </td>
                    </tr>

@endforeach


@if(empty($list))

                    <tr class="no-records" ><td colspan="7">没有找到任何记录</td></tr>

@endif

                    </table>
		        </div>
		    </div>
	    </div>
        <div class="list-div of">
            <table cellspacing="0" cellpadding="0" border="0">
                <tfoot>
                    <tr>
                        <td colspan="7">
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
        $(".getqr").click(function(){
            var url = $(this).attr("href");
            $.post(url, '', function(data){
                if(data.status <= 0 ){
                    $.fancybox.close();
                    alert(data.msg);
                    return false;
                }
            }, 'json');
        });
    })
</script>
