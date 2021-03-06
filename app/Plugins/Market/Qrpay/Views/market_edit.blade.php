
<div class="wrapper">
  <div class="title"><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a>{{ $config['name'] }} -
@if(isset($info['id']) && $info['id'])
编辑
@else
添加
@endif
</div>
  <div class="content_tips">
    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
        <ul>
            <li>1、收款码类型一经创建后不可修改。</li>
        </ul>
    </div>
      <div class="flexilist">
        <div class="common-content ">
            <div class="main-info">
            <form action="{{ route('admin/wechat/market_edit', array('type' => $config['keywords'])) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" onsubmit="return false;">
                <div class="switch_info">
                <table class="table table-hover ectouch-table">
                    <tr>
                        <td class="text-align-r" width="200">收款码名称：</td>
                        <td>
                            <div class="col-sm-3">
                                <input type="text" name="data[qrpay_name]" class="form-control" value="{{ $info['qrpay_name'] ?? '' }}" />
                            </div>
                            <div class="notic"> * 必填 收款码名称建议不超过32个字符</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-align-r" width="200">收款码类型：</td>
                        <td class="qrpay-checked">
                            <div class="col-sm-4">
                                <div class="checkbox_items">
                                    <div class="checkbox_item">
                                        <input type="radio" name="data[type]" class="ui-radio evnet_shop_closed clicktype" id="value_116_0" value="0"
@if(isset($info['id']) && $info['id'])
disabled="disabled"
@endif

@if(isset($info['type']) && $info['type'] == '0')
checked
@endif
 >
                                        <label for="value_116_0" class="ui-radio-label
@if(isset($info['id']) && $info['id'])
disabled
@endif

@if(isset($info['type']) && $info['type'] == '0')
active
@endif
">自助收款码</label>
                                    </div>
                                    <div class="checkbox_item">
                                        <input type="radio" name="data[type]" class="ui-radio evnet_shop_closed clicktype" id="value_116_1" value="1"
@if(isset($info['id']) && $info['id'])
disabled="disabled"
@endif

@if(isset($info['type']) && $info['type'] == '1')
checked
@endif
>
                                        <label for="value_116_1" class="ui-radio-label
@if(isset($info['id']) && $info['id'])
disabled
@endif

@if(isset($info['type']) && $info['type'] == '1')
active
@endif
">指定金额收款码</label>
                                    </div>
                                </div>
                            </div>
                            <div class="notic " style="color:red">收款码类型 创建后不可修改</div>
                        </td>
                    </tr>
                    <tr class="
@if(isset($info['type']) && $info['type'] == '0')
hidden
@endif
" id="click">
                        <td class="text-align-r " width="200">收款码金额：</td>
                        <td>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="number" min="0" step="0.01" name="data[amount]" class="form-control" value="{{ $info['amount'] ?? ''  }}" placeholder="输入收款金额" />
                                    <span class="input-group-addon">元</span>
                                </div>
                            </div>
                            <div class="notic">商家设置固定金额创建收款码，消费者扫码后直接支付</div>
                        </td>
                    </tr>
                    <tr class="
@if(isset($info['type']) && $info['type'] == '1')
hidden
@endif
" id="view">
                        <td class="text-align-r " width="200"></td>
                        <td>
                            <div class="notic  pl20">扫描二维码，消费者输入付款金额，支付成功后收入到账</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-align-r" width="200">选择标签：</td>
                        <td>
                            <div class="col-sm-2">
                                <div class="input-group">
                                <select name="data[tag_id]" class="form-control">
                                    <option value='0' >无</option>
@if(isset($tag_list))
@foreach($tag_list as $tag)

                                    <option value="{{ $tag['id'] }}"
@if(isset($info['tag_id']) && $info['tag_id'] == $tag['id'])
 selected
@endif
 >{{ $tag['tag_name'] }}</option>

@endforeach
@endif
                                </select>
                                </div>
                            </div>
                            <div class="notic"> <a href="{{ route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'qrpay_tag_list')) }}" >管理标签</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-align-r" width="200">选择优惠：</td>
                        <td>
                            <div class="col-sm-3">
                                <div class="input-group">
                                <select name="data[discount_id]" class="form-control">
                                    <option value='0' >无</option>
@if(isset($discounts_list))
@foreach($discounts_list as $dis)

                                    <option value="{{ $dis['id'] }}"
@if(isset($info['discount_id']) && $info['discount_id'] == $dis['id'])
 selected
@endif
 >{{ $dis['dis_name'] }}</option>

@endforeach
@endif
                                </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="col-md-4 info_btn">
                                <input type="hidden" name="id" value="{{ $info['id']  ?? ''  }}">
                                <input type="hidden" name="data[ru_id]" value="{{ $info['ru_id']  ?? ''  }}">

                                <input type="submit" name="submit" class="button btn-danger bg-red" value="确认" />
                                <input type="reset" name="reset" class="button button_reset" value="重置" />
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </form>
            </div>
        </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$(function(){
    $(".clicktype").click(function(){
        // var val = $(this).find("input[type=radio]").val();
        var val = $(this).val();

        if('0' == val && !$("#click").hasClass("hidden")){
            $("#click").hide().addClass("hidden");
            $("#view").show().removeClass("hidden");
        }
        if('1' == val && $("#click").hasClass("hidden")){
            $("#click").show().removeClass("hidden");
            $("#view").hide().addClass("hidden");
        }
    });

    $(".form-horizontal").submit(function(){
        var ajax_data = $(this).serialize();
        $.post("{!!  route('admin/wechat/market_edit', array('type' => $config['keywords']))  !!}", ajax_data, function(data){
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
