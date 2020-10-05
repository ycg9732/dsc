
<div class="fancy">
    <div class="title">{{ $config['name'] }} - 标签
@if(isset($info['id']) && $info['id'])
编辑
@else
添加
@endif
</div>
    <div class="flexilist of">
    		<div class="main-info">
				<form action="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $config['market_id'])) }}" method="post" class="form-horizontal" role="form" onsubmit="return false;">
			        <div class="switch_info">
				        <div class="item">
				            <div class="label-t">{{ $lang['tag_name'] }}:</div>
				            <div class="label_value">
				                <input type='text' name='data[tag_name]' maxlength="20" value="{{ $info['tag_name'] ?? '' }}" class="text" />
				            </div>
				        </div>
				        <div class="item">
				            <div class="label-t">&nbsp;</div>
				            <div class="label_value info_btn">
				              	<input type="hidden" name="id" value="{{ $info['id'] ?? '' }}" />

								<input type="submit" value="{{ $lang['button_submit'] }}" class="button btn-danger bg-red" />
				            </div>
				        </div>
			        </div>
				</form>
			</div>
    </div>
</div>
<script type="text/javascript">
$(function(){
	$(".form-horizontal").submit(function(){
		var ajax_data = $(".form-horizontal").serialize();
		$.post("{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list', 'handler' => 'edit', 'id' => $config['market_id'])) !!}", ajax_data, function(data){
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
