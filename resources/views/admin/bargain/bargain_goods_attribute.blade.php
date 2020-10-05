@if($attribute_list)

    <div class="step_item_row step_item_spec_row step_item_bg">
        <div class="step_item_left">
            <h5>{{ $lang['bargain_goods_attr'] }}：</h5>
        </div>
        <div class="step_item_right">

            @foreach($attribute_list as $val)

                <div class="item_right_li">
                    <div class="label label_title">{{ $val['attr_name'] ?? '' }}：</div>
                    <div class="value">

                        <div class="checkbox_items attr_input_type_{{ $val['attr_id'] ?? '' }}">

                            @foreach($val['attr_values_arr'] as $v)

                                <div class="checkbox_item">
                                    <input type="checkbox" data-type="attr_id" name="attr_id_list1[]"
                                           class="ui-checkbox"
                                           @if(isset($v['is_selected']) && $v['is_selected'])
                                           checked
                                           @endif
                                           value="{{ $val['attr_id'] }}">

                                    @if(isset($v['goods_attr_id']) && $v['goods_attr_id'])

                                        <input type="checkbox" data-type="attr_value" name="attr_value_list1[]"
                                               class="ui-checkbox"
                                               @if(isset($v['is_selected']) && $v['is_selected'])
                                               checked
                                               @endif
                                               value="{{ $v['attr_value'] }}"
                                               id="goods_attr_checkbox{{ $v['goods_attr_id'] ?? '' }}"/>
                                        <label for="" class="ui-label">{{ $v['attr_value'] }}</label>

                                    @else

                                        <input type="checkbox" data-type="attr_value" name="attr_value_list1[]"
                                               class="ui-checkbox"
                                               @if(isset($v['is_selected']) && $v['is_selected'])
                                               checked
                                               @endif
                                               value="{{ $v['attr_value'] ?? '' }}"
                                               id="goods_attr_checkbox{{ $key ?? '' }}{{ $k ?? '' }}"/>
                                        <label for="" class="ui-label">{{ $v['attr_value'] }}</label>

                                    @endif

                                    <i class="iconfont icon-cha" data-goodsid="{{ $goods_id }}"
                                       data-attrid="{{ $val['attr_id'] }}" data-goodsattrid="{{ $v['goods_attr_id'] }}"
                                       data-attrvalue="{{ $v['attr_value'] }}" ectype="attrClose"></i>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endif
