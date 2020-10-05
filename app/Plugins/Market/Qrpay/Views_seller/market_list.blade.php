
<div class="wrapper-right of">
	<div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_index') }}" class="s-back">返回</a></li>
            <li role="presentation" class="active"><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" > 收款码</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>1. 收款二维码分为指定金额、自助金额两种类型。</li>
            <li>2. 更换域名或更换LOGO需要重新生成二维码，可以点击重置二维码。</li>
            <li>3. 收款码目前支持支付宝和微信支付两种支付方式，简单快捷。</li>
            <li>4. 下载收款对应二维码可适用于线下场景使用。</li>
        </ul>
    </div>
	<div class="wrapper-list mt20" >
		<div class="common-head">
            <div class="fl mb20">
            	<a href="{{ route('seller/wechat/market_edit', array('type' => $config['keywords'])) }}" class="sc-btn sc-blue-btn" ><div class="fbutton"><div class="add " title="添加收款码"><span><i class="fa fa-plus"></i>添加收款码</span></div></div></a>
            </div>
        </div>

        <div class="list-div" id="listDiv">
        <table id="list-table" class="ecsc-default-table" style="">
            <thead>
            <tr class="text-center">
                <th class="text-center">收款码</th>
                <th class="text-center">收款码名称</th>
                <th class="text-center">收款码类型</th>
                <th class="text-center">优惠</th>
                <th class="text-center">标签</th>
                <th class="text-center">生成时间</th>
                <!-- <th class="text-center">收款情况</th> -->
                <th class="text-center" width="30%">操作</th>
            </tr>
            </thead>
            <tbody>

@foreach($list as $val)

            <tr class="text-center wall-list">
                <td><a href="{{ $val['qrpay_code'] }}" class="btn_region fancybox-img fancybox-img.iframe getqr"><img src="{{ $val['qrpay_code'] }}" width="100" height="100" class="img-thumbnail" /></a></td>
                <td>{{ $val['qrpay_name'] }}</td>
                <td>{{ $val['type'] }}</td>
                <td>{{ $val['discounts_name'] }}</td>
				<td>{{ $val['tag_name'] }}</td>
                <td>{{ $val['add_time'] }}</td>
                <!-- <td>{{ $val['qrpay_status'] }}</td> -->
                <td>
                <div class="info_btn ">
                    <a class="button btn-info bg-green" href="{{ route('seller/wechat/market_edit', array('type' => $config['keywords'], 'id' => $val['id'])) }}">编辑</a>
                    <a class="button btn-info" href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list', 'id' => $val['id'])) }}">记录</a>

                    <a class="button btn-primary " href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'download_qrpay', 'id' => $val['id'])) }}">下载</a>
                    <a class="button btn-danger bg-red reset-qrpay" data-href="{!!  route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'reset_qrpay', 'id' => $val['id']))  !!}" href="javascript:;">重置</a>
                    <!-- <a class="button btn-danger bg-red delete" data-href="{!!  route('seller/wechat/market_del', array('type' => $config['keywords'], 'id' => $val['id']))  !!}" href="javascript:;">删除</a> -->
                </div>
                </td>
            </tr>

@endforeach

            </tbody>

@if(empty($list))

            <tbody>
                <tr><td class="no-records" colspan="7">没有找到任何记录</td></tr>
            </tbody>

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

    // 点击图片居中显示
    $(".fancybox-img").fancybox({
        helpers: {
            title : {
                type : 'outside'
            },
            overlay : {
                speedOut : 0
            }
        }
    });

    // 重置二维码
    $(".reset-qrpay").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要重置二维码吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
                layer.msg(data.msg);
                if (data.error == 0) {
                    if (data.url) {
                        window.location.href = data.url;
                    } else {
                        window.location.reload();
                    }
                } else {
                    return false;
                }
            }, 'json');
            // 关闭弹窗
            layer.closeAll();
        });
    });

    // 删除二维码
    $(".qr-delete").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要删除二维码吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
                layer.msg(data.msg);
                if (data.error == 0) {
                    if (data.url) {
                        window.location.href = data.url;
                    } else {
                        window.location.reload();
                    }
                } else {
                    return false;
                }
            }, 'json');
            // 关闭弹窗
            layer.closeAll();
        });
    });

});
</script>
