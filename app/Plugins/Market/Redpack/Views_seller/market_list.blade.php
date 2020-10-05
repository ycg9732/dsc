
<div class="wrapper-right of">
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_index') }}" class="s-back">返回</a></li>
            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab"> {{ $config['name'] }}</a></li>
            <!-- <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'share_setting', 'id' => $config['market_id'])) }}">设置分享</a></li> -->
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>步骤一、添加红包活动，填写活动配置与红包等参数。</li>
            <li>步骤二、给新增的红包活动，配置添加摇一摇广告，每个红包活动建议至少2、3个广告以上。</li>
            <li>步骤三、活动记录，可查看用户参与红包活动与领取红包情况。</li>
            <li>步骤四、可将对应红包活动的关键词，添加到微信自定义菜单中，触发活动消息，进入活动页面。</li>
        </ul>
    </div>
	<div class="wrapper-list mt20" >
		<div class="common-head">
            <div class="fl mb20">
            	<a href="{{ route('seller/wechat/market_edit', array('type' => $config['keywords'])) }}" class="sc-btn sc-blue-btn" ><div class="fbutton"><div class="add " title="添加活动"><span><i class="fa fa-plus"></i>添加活动</span></div></div></a>
            </div>
        </div>

        <div class="list-div" id="listDiv">
        <table id="list-table" class="ecsc-default-table" style="">
            <thead>
            <tr class="text-center">
                <!-- <th class="text-center">活动ID</th> -->
                <th class="text-center">活动名称</th>
                <th class="text-center">关键词</th>
                <th class="text-center">红包类型</th>
                <th class="text-center">活动时间</th>
                <th class="text-center">状态</th>
                <th class="text-center">操作</th>
            </tr>
            </thead>
            <tbody>

@foreach($list as $val)

            <tr class="text-center wall-list">
                <!-- <td>{{ $val['id'] }}</td> -->
                <td>{{ $val['name'] }}</td>
                <td>{{ $val['command'] }}</td>
				<td>{{ $val['hb_type'] }}</td>
                <td>{{ $val['starttime'] }} ~ {{ $val['endtime'] }}</td>
                <td>{{ $val['status'] }}</td>
                <td class="handle">
                    <div class="tDiv">
                        <a class="btn_edit" href="{{ route('seller/wechat/market_edit', array('type' => $config['keywords'], 'id' => $val['id'])) }}"><i class="fa fa-edit"></i>编辑</a>
                        <a class="btn_see" href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'id' => $val['id'])) }}"><i class="fa fa-eye"></i>摇一摇广告</a>
                        <a class="btn_see" href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'log_list', 'id' => $val['id'])) }}"><i class="fa fa-eye"></i>活动记录</a>
                        <a class="btn_see fancybox-img fancybox-img.iframe getqr" href="{{ route('seller/wechat/market_qrcode', array('type' => $config['keywords'], 'id' => $val['id'])) }}"><i class="fa fa-qrcode"></i>二维码</a>
                        <a class="btn_trash delete_confirm" data-href="{!!  route('seller/wechat/market_del', array('type' => $config['keywords'], 'id' => $val['id']))  !!}" href="javascript:;"><i class="fa fa-trash-o"></i>删除</a>
                    </div>
                </td>
            </tr>

@endforeach

            <tbody>

@if(empty($list))

            <tr class="no-records" ><td colspan="6">没有找到任何记录</td></tr>

@endif

            </table>
        </div>

        @include('seller.base.seller_pageview')

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
