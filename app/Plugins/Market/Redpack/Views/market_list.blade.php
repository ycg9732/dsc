
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_index') }}" class="s-back">返回</a>{{ $lang['wechat_menu'] }} - {{ $config['name'] }}</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li class="curr"><a href="#">现金红包</a></li>
                <!-- <li><a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'share_setting')) }}">设置分享</a></li> -->
            </ul>
        </div>
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>准备工作：<a href="https://pay.weixin.qq.com/wiki/doc/api/tools/cash_coupon.php?chapter=13_3&index=2" target="_blank">开通现金红包权限</a>, 开通后下载API证书上传到服务器指定目录。并<a href="{{ route('admin/wechat/modify') }}" >配置微信公众号信息</a>、<a href="../payment.php?act=list" >安装微信支付</a>。</li>
                <li>步骤一、添加红包活动，填写活动配置与红包等参数。</li>
                <li>步骤二、给新增的红包活动，添加对应的摇一摇广告，每个红包活动建议至少2、3个广告以上。</li>
                <li>步骤三、活动记录，可查看用户参与红包活动与领取红包情况。</li>
                <li>步骤四、可将对应红包活动的关键词，添加到微信自定义菜单中，触发活动消息，进入活动页面。</li>
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
                        <th class="text-center">红包类型</th>
                        <th class="text-center">活动时间</th>
                        <th class="text-center">状态</th>
                        <th class="text-center">操作</th>
                    </tr>

@foreach($list as $val)

                    <tr class="text-center wall-list">
                        <!-- <td>{{ $val['id'] }}</td> -->
                        <td>{{ $val['name'] }}</td>
                        <td>{{ $val['command'] }}</td>
						<td>{{ $val['hb_type'] }}</td>
                        <td>{{ $val['starttime'] }} ~ {{ $val['endtime'] }}</td>
                        <td>{{ $val['status'] }}</td>
                        <td>
                        <div class="info_btn">
                            <a class="button btn-info bg-green" href="{{ route('admin/wechat/market_edit', array('type' => $config['keywords'], 'id' => $val['id'])) }}">编辑</a>
                            <a class="button btn-primary" href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'id' => $val['id'])) }}">摇一摇广告</a>
                            <a class="button btn-danger bg-red" href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'log_list', 'id' => $val['id'])) }}">活动记录</a>
                            <a class="button btn-primary fancybox fancybox.iframe getqr" href="{{ route('admin/wechat/market_qrcode', array('type' => $config['keywords'], 'id' => $val['id'])) }}">二维码地址</a>
                            <a class="button btn-danger bg-red delete" data-href="{!!  route('admin/wechat/market_del', array('type' => $config['keywords'], 'id' => $val['id']))  !!}" href="javascript:;">删除</a>
                        </div>
                        </td>
                    </tr>

@endforeach


@if(empty($list))

                    <tr class="no-records" ><td colspan="6">没有找到任何记录</td></tr>

@endif

                    </table>
		        </div>
		    </div>
	    </div>
        <div class="list-div of">
            <table cellspacing="0" cellpadding="0" border="0">
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

<script type="text/javascript">
    $(function(){
        $(".getqr").click(function(){
            var url = $(this).attr("href");
            $.get(url, '', function(data){
                if(data.status <= 0 ){
                    $.fancybox.close();
                    alert(data.msg);
                    return false;
                }
            }, 'json');
        });
    })
</script>