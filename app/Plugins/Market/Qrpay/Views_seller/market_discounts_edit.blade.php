
<div class="wrapper-right of">
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a></li>
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" > 收款码</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_log_list')) }}">收款记录</a></li>
            <li role="presentation" class="active"><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts')) }}">收款码优惠</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}">标签管理</a></li>
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>1. 每笔订单金额必须大于每笔立减金额</li>
            <li>2. 每笔订单累计最高优惠必须大于等于立减的额度</li>
            <li>3. 未设置每笔订单累计最高优惠, 则表示优惠金额无上限。</li>
        </ul>
    </div>
	<div class="wrapper-list mt20" >

        <form action="{!! route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts', 'handler' => 'edit', 'id' => $config['market_id'])) !!}" method="post" class="form-horizontal" role="form"  onsubmit="return false;">
        <div class="account-setting ecsc-form-goods">
            <dl>
                <dt class="font14" >优惠条件和优惠金额设置</dt>
            </dl>
            <dl>
                <!-- <dt>&nbsp;</dt> -->
                <dd>
                    <div class="row dis-prex">
                      <div class="col-xs-3 col-sm-3 ">
                        <label for="min_amount " >每满</label>
                        <div class="input-group">
                            <input type="number" min="0" name="data[min_amount]" class="form-control" value="{{ $info['min_amount'] ?? '' }}" id="min_amount" />
                            <span class="input-group-addon">元</span>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-3">
                        <label for="discount_amount" >，立减</label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="data[discount_amount]" class="form-control" value="{{ $info['discount_amount'] ?? '' }}" id="discount_amount" />
                            <span class="input-group-addon">元</span>
                        </div>
                      </div>
                      <div class="col-xs-5 col-sm-5">
                        <label for="max_discount_amount" >，每笔订单累计最高优惠</label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="data[max_discount_amount]" class="form-control" value="{{ $info['max_discount_amount'] ?? '' }}" id="max_discount_amount" />
                            <span class="input-group-addon">元</span>
                        </div>
                        <div style="color:#bebebe" > 未设置表示优惠金额无上限</div>
                      </div>

                    </div>
                </dd>
            </dl>

            <dl>
                <dt>&nbsp;</dt>
                <dd class="button_info"  >
                    <input type="hidden" name="id" value="{{ $info['id'] ?? ''}}">
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

        var min_amount = parseFloat($('input[name="data[min_amount]"]').val());
        var discount_amount = parseFloat($('input[name="data[discount_amount]"]').val());
        var max_discount_amount = parseFloat($('input[name="data[max_discount_amount]"]').val());
        // 每笔订单金额必须大于每笔立减金额
        if (min_amount <= discount_amount ) {
            layer.msg('每笔订单金额必须大于每笔立减金额');
            return false;
        }
        // 每笔订单累计最高优惠必须大于等于立减的额度
        if (max_discount_amount && max_discount_amount < discount_amount) {
            layer.msg('每笔订单累计最高优惠必须大于等于立减的额度');
            return false;
        }

        var ajax_data = $(this).serialize();
        $.post("{!! route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_discounts', 'handler' => 'edit', 'id' => $config['market_id'])) !!}", ajax_data, function(data){
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
    });
})
</script>
