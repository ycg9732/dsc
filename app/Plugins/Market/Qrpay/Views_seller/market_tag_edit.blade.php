
<div class="wrapper-right of">
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}" class="s-back">返回</a></li>
            <li class="active"><a href="#">
@if(isset($info['id']) && $info['id'])
编辑
@else
添加
@endif
标签</a></li>
        </ul>
    </div>
    <div class="wrapper-list mt20" >

		<form action="{!!  route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $config['market_id']))  !!}" method="post" class="form-horizontal" role="form" onsubmit="return false;">
        <div class="account-setting ecsc-form-goods">
            <dl>
                <dt>{{ $lang['tag_name'] }}：</dt>
                <dd>
                    <div class="col-sm-3">
                        <input type='text' name='data[tag_name]' maxlength="20" value="{{ $info['tag_name'] ?? '' }}" class="text" />
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>&nbsp;</dt>
                <dd class="button_info">
                    <input type="hidden" name="id" value="{{ $info['id'] ?? '' }}">
                    <input type="hidden" name="data[ru_id]" value="{{ $info['ru_id'] ?? '' }}">

                    <input type="submit" name="submit" class="sc-btn sc-blueBg-btn btn35" value="{{ $lang['button_submit'] }}" />
                    <input type="reset" name="reset" class="sc-btn sc-blue-btn btn35" value="{{ $lang['button_revoke'] }}" />
                </dd>
            </dl>
        </div>
		</form>

    </div>
</div>
<script type="text/javascript">
$(function(){
	$(".form-horizontal").submit(function(){
		var ajax_data = $(".form-horizontal").serialize();
		$.post("{!! route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $config['market_id']))  !!}", ajax_data, function(data){
		    layer.msg(data.msg);
            if (data.error == 0) {
                if (data.url) {
                    window.parent.location.href = data.url;
                } else {
                    window.parent.location.reload();
                }
            } else {
                return false;
            }
		}, 'json');
	});
})
</script>
