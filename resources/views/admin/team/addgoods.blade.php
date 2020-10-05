@include('admin.team.admin_pageheader')
<style>
    .checkbox_item-box {
        display: none;
    }

    .checkbox_item-box.active {
        display: block
    }
</style>
<div class="wrapper">
    <div class="title">{{ $lang['team_goods_add'] }}</div>
    <div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li class="curr"><a href="{{ route('admin/team/index') }}">{{ $lang['team_goods'] }}</a></li>
                <li><a href="{{ route('admin/team/category') }}">{{ $lang['team_category'] }}</a></li>
                <li><a href="{{ route('admin/team/teaminfo') }}">{{ $lang['team_info'] }}</a></li>
                <li style="display:none"><a href="{{ route('admin/team/teamrecycle') }}">{{ $lang['team_recycle'] }}</a>
                </li>
            </ul>
        </div>
        <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>{{ $lang['operating_hints'] }}</h4><span id="explanationZoom"
                                                                                                    title="{{ $lang['fold_tips'] }}"></span>
            </div>
            <ul>
                <li>{{ $lang['team_goods_add_tips']['0'] }}</li>
                <li>{{ $lang['team_goods_add_tips']['1'] }}</li>
                <li>{{ $lang['team_goods_add_tips']['2'] }}</li>
            </ul>
        </div>
        <div class="flexilist">
            <div class="main-info">

                <form method="post" action="{{ route('admin/team/addgoods') }}" id="group_buy_form" class="validation" name="theForm">
                    <div class="switch_info">
                        <!--搜索-->
                        <div class="goods_search_div bor_bt_das">
                            <div class="search_select">
                                <div class="categorySelect">
                                    <div class="selection">
                                        <input type="text" name="category_name" id="category_name"
                                               class="text w250 valid" value="{{ $lang['please_category'] }}"
                                               autocomplete="off" readonly="" data-filter="cat_name">
                                        <input type="hidden" name="category_id" id="category_id" value="0"
                                               data-filter="cat_id">
                                    </div>
                                    <div class="select-container" style="display: none;">
                                        <!--分类搜索-->
                                        {{--@include('mobile.base.filter_team_category')--}}
                                        <div class="select-top">
                                            <a href="javascript:;" class="categoryTop" data-cid="0"
                                               data-cname="">{{ $lang['choose_again'] }}</a>

                                            @if(isset($filter_category_navigation) && $filter_category_navigation)

                                                @foreach($filter_category_navigation as $navigation)

                                                    &gt;<a href="javascript:;" class="categoryTop"
                                                           data-cid="{{ $navigation['cat_id'] }}"
                                                           data-cname="{{ $navigation['cat_name'] }}">{{ $navigation['cat_name'] }}</a>

                                                @endforeach

                                            @else

                                                &gt; <span>{{ $lang['please_category'] }}</span>

                                            @endif

                                        </div>
                                        <div class="select-list">
                                            <ul>
                                                @if(isset($filter_category_list) && $filter_category_list)
                                                    @foreach($filter_category_list as $category)

                                                        <li data-cid="{{ $category['cat_id'] }}"
                                                            data-cname="{{ $category['cat_name'] }}">
                                                            <em>
                                                                @if($filter_category_level == 1)
                                                                    Ⅰ
                                                                @elseif($filter_category_level == 2)
                                                                    Ⅱ
                                                                @elseif($filter_category_level == 3)
                                                                    Ⅲ
                                                                @else
                                                                    Ⅰ
                                                                @endif
                                                            </em>{{ $category['cat_name'] }}</li>

                                                    @endforeach
                                                @endif

                                            </ul>
                                        </div>
                                        <!--分类搜索-->
                                    </div>
                                </div>
                            </div>
                            <div class="search_select">
                                <div class="brandSelect">
                                    <div class="selection">
                                        <input type="text" name="brand_name" id="brand_name" class="text w120 valid"
                                               value="{{ $lang['choose_brand'] }}" autocomplete="off" readonly=""
                                               data-filter="brand_name">
                                        <input type="hidden" name="brand_id" id="brand_id" value="0"
                                               data-filter="brand_id">
                                    </div>
                                    <div class="brand-select-container" style="display: none;">
                                        <div class="brand-top">
                                            <div class="letter">
                                                <ul>
                                                    <li><a href="javascript:void(0);"
                                                           data-letter="">{{ $lang['all_brand'] }}</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="A">A</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="B">B</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="C">C</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="D">D</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="E">E</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="F">F</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="G">G</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="H">H</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="I">I</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="J">J</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="K">K</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="M">M</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="N">N</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="O">O</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="P">P</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="Q">Q</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="R">R</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="S">S</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="T">T</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="U">U</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="V">V</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="W">W</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="X">X</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="Y">Y</a></li>
                                                    <li><a href="javascript:void(0);" data-letter="Z">Z</a></li>
                                                    <li><a href="javascript:void(0);"
                                                           data-letter="QT">{{ $lang['other'] }}</a></li>
                                                </ul>
                                            </div>
                                            <div class="b_search">
                                                <input name="search_brand_keyword" id="search_brand_keyword" type="text"
                                                       class="b_text" placeholder="{{ $lang['search_brand'] }}"
                                                       autocomplete="off">
                                                <a href="javascript:void(0);" class="btn-mini"><i
                                                            class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="brand-list ps-container ps-active-y">

                                            <!--品牌搜索-->
                                            {{--@include('mobile.base.team_brand_list')--}}
                                            <ul>
                                                <li data-id="0" data-name="{{ $lang['choose_brand'] }}"
                                                    class="blue">{{ $lang['choose_cancel'] }}</li>
                                                @if(isset($filter_brand_list) && $filter_brand_list)
                                                    @foreach($filter_brand_list as $brand)

                                                        <li data-id="{{ $brand['brand_id'] }}"
                                                            data-name="{{ $brand['brand_name'] }}">
                                                            <em>{{ $brand['letter'] }}</em>{{ $brand['brand_name'] }}
                                                        </li>

                                                    @endforeach
                                                @endif
                                            </ul>
                                            <!--品牌搜索-->

                                            <div class="ps-scrollbar-x-rail"
                                                 style="width: 234px; display: none; left: 0px; bottom: 3px;">
                                                <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                                            </div>
                                            <div class="ps-scrollbar-y-rail"
                                                 style="top: 0px; height: 220px; display: inherit; right: 3px;">
                                                <div class="ps-scrollbar-y" style="top: 0px; height: 13px;"></div>
                                            </div>
                                        </div>
                                        <div class="brand-not"
                                             style="display:none;">{{ $lang['no_brand_records'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="ru_id" value="0">
                            <input type="text" name="keyword" class="text w150"
                                   placeholder="{{ $lang['keyword'] }}"
                                   data-filter="keyword" autocomplete="off">
                            <a href="javascript:void(0);" class="btn btn30" onclick="searchGoods()"><i
                                        class="fa fa-search"></i>{{ $lang['button_search'] }}</a>
                        </div>
                        <div class="item">
                            <div class="label-t"><span class="require-field">*</span>{{ $lang['team_goods'] }}</div>
                            <div class="label_value">
                                <div id="goods_id" class="imitate_select select_w320">
                                    <div class="cite">
                                        @if(isset($info['id']) && $info['id'])
                                            {{ $info['goods_name'] }}
                                        @else
                                            {{ $lang['please_select'] }}
                                        @endif
                                    </div>
                                    <ul>

                                        @if(isset($info['id']) && !$info['id'])
                                            <li class="li_not">{{ $lang['please_search_goods'] }}</li>
                                        @endif

                                    </ul>
                                    <input name="goods_id" type="hidden" datatype="*"
                                           nullmsg="{{ $lang['please_select_team_goods'] }}" value="
@if(isset($info['id']) && $info['id'])
                                    {{ $info['goods_id'] }}
                                    @endif
                                            " id="goods_id_val">
                                </div>
                                <div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label-t"><span class="require-field">*</span>{{ $lang['team_price'] }}</div>
                            <div class="label_value">
                                <input type="text" id='team_price' name="team_price" datatype="*"
                                       nullmsg="{{ $lang['team_price_null'] }}" class="text"
                                       value="{{ $info['team_price'] ?? '' }}">
                                <p class="notic">{{ $lang['team_price_notice'] }}</p>
								<div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label-t"><span class="require-field">*</span>{{ $lang['team_num'] }}</div>
                            <div class="label_value">
                                <input type="text" id="team_num" name="team_num" datatype="*"
                                       nullmsg="{{ $lang['team_num_null'] }}"
                                       class="text" value="{{ $info['team_num'] ?? '' }}">
                                <p class="notic">{{ $lang['team_num_notice'] }}</p>
								<div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            {{--开团有效期--}}
                            <div class="label-t"><span class="require-field">*</span>{{ $lang['team_validity_time'] }}</div>
                            <div class="label_value">
                                <input type="text" id="validity_time" name="validity_time" datatype="*"
                                       nullmsg="{{ $lang['team_validity_time_null'] }}" class="text"
                                       value="{{ $info['validity_time'] ?? 24 }}">
                                <p class="notic">{{ $lang['team_validity_time_notice'] }}</p>
								<div class="form_prompt"></div>
                            </div>
                        </div>

                        @if($virtual_limit_nim == 1)

                            <div class="item">
                                <div class="label-t">{{ $lang['team_limit_num'] }}</div>
                                <div class="label_value">
                                    <input type="text" id="limit_num" name="limit_num" datatype="*"
                                           nullmsg="{{ $lang['team_limit_num_null'] }}" class="text"
                                           value="{{ $info['limit_num'] ?? 0 }}">
                                    <p class="notic">{{ $lang['team_limit_num_notice'] }}</p>
                                    <div class="form_prompt"></div>
                                </div>
                            </div>

                        @endif

                        <div class="item">
                            <div class="label-t"><span class="require-field">*</span>{{ $lang['team_goods_limit'] }}</div>
                            <div class="label_value">
                                <input type="text" id="astrict_num" name="astrict_num" datatype="*"
                                       nullmsg="{{ $lang['team_goods_limit_null'] }}" class="text"
                                       value="{{ $info['astrict_num'] ?? '' }}">
                                <p class="notic">{{ $lang['team_goods_limit_notice'] }}</p>
								<div class="form_prompt"></div>
                            </div>
                        </div>
						<div class="item">
							<div class="label-t"><span class="require-field">*</span>{{ $lang['team_category'] }}</div>
							<div class="label_value">
								<div id="tc_id" class="imitate_select select_w320">
								  <div class="cite">{{ $lang['please_team_category'] }}</div>
								  <ul style="height: 210px;">
									<li><a href="javascript:;" data-value="0" class="ftx-01">{{ $lang['please_team_category'] }}</a></li>
									@foreach($team_list as $cat)
										<li><a href="javascript:;" data-value="{{ $cat['tc_id'] ?? '' }}" class="ftx-01">{{ $cat['name'] ?? '' }}</a></li>
										@if(isset($cat['id']))
											@foreach($cat['id'] as $val)
												<li><a href="javascript:;" data-value="{{ $val['tc_id'] ?? '' }}" class="ftx-01">&nbsp;&nbsp;&nbsp;{{ $val['name'] ?? '' }}</a></li>
											@endforeach
                                        @endif
                                    @endforeach		
								  </ul>
							
								  <input name="tc_id" type="hidden" value="{{ $info['tc_id'] ?? '' }}">
								</div>
								<div class="form_prompt"></div>
							</div>
						</div>						
						
                        @if(isset($info['ru_id']) && $info['ru_id'])
                            <div class="item">
                                <div class="label-t">{{ $lang['audit_status'] }}</div>
                                <div class="label_value">
                                    <div class="type-file-box">
                                        <div class="checkbox_items">
                                            <div class="checkbox_item">
                                                <input type="radio" name="is_audit" class="checkbox_item-1"
                                                       value="0"
                                                       @if(isset($info['is_audit']) && $info['is_audit']==0)
                                                       checked
                                                        @endif
                                                >
                                                <label class="">{{ $lang['no_audit'] }}</label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" name="is_audit" class="j-checkbox_item"
                                                       id="btnRegister" value="1"
                                                       @if(isset($info['is_audit']) && $info['is_audit']==1)
                                                       checked
                                                        @endif
                                                >
                                                <label class="">{{ $lang['refuse_audit'] }}</label>
                                            </div>
                                            <div class="checkbox_item">
                                                <input type="radio" name="is_audit" class="checkbox_item-1"
                                                       value="2"
                                                       @if(isset($info['is_audit']) && $info['is_audit']==2)
                                                       checked
                                                        @endif
                                                >
                                                <label class="">{{ $lang['already_audit'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item checkbox_item-box">
                                {{--审核未通过原因--}}
                                <div class="label-t">{{ $lang['isnot_aduit_reason'] }}</div>
                                <div class="label_value">
                                    <textarea name="isnot_aduit_reason" cols="40" rows="3"
                                              class="textarea">{{ $info['isnot_aduit_reason'] ?? '' }}</textarea>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="is_audit" value="2"/>
                        @endif

                        <div class="item">
                            <div class="label-t">{{ $lang['team_content'] }}</div>
                            <div class="label_value">
                                <textarea name="team_desc" cols="40" rows="3" class="textarea">
									{{ $info['team_desc'] ?? '' }}
								</textarea>
								<div class="form_prompt"></div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label-t">&nbsp;</div>
                            <div class="lable_value info_btn">
                                @csrf
                                <input type="hidden" name="id" value="{{ $info['id'] ?? '' }}">
                                <input type="submit" name="submit" value="{{ $lang['button_submit'] }}" class="button" id="submitBtn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/assets/admin/js/jquery.validation.min.js') }}"></script>

<script>
		//表单验证
        $(function(){
            $("#submitBtn").click(function(){				
                if($("#group_buy_form").valid()){
                    //防止表单重复提交
                    if(checkSubmit() == true){
                        $("#group_buy_form").submit();
                    }
                    return false
                }
            }); 
            
            $('#group_buy_form').validate({				
                errorPlacement: function(error, element){
                    var error_div = element.parents('div.label_value').find('div.form_prompt');
                    element.parents('div.label_value').find(".notic").hide();
                    error_div.append(error);
                },
                ignore:'.ignore',
                rules : {
                    goods_id :{
						required : true
					},
					team_price :{
						required : true
					},
					team_num :{
						required : true,
						min:2
					},
					validity_time :{
						required : true,
						max:24
					},
					astrict_num :{
						required : true
					},
					tc_id :{
						required : true,
                        min:1
					}
                },
                messages : {
					goods_id:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_select_team_goods
					},
					team_price:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_team_price_not_null
					},
					team_num:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_team_num_not_null,
						min : '<i class="icon icon-exclamation-sign"></i>'+jl_team_num_not_null
					},
					validity_time:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_validity_time_not_null,
						max : '<i class="icon icon-exclamation-sign"></i>'+jl_validity_time_not_null
					},
					astrict_num:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_astrict_num_not_null
					},
					tc_id:{
						required : '<i class="icon icon-exclamation-sign"></i>'+jl_select_tc_id,
						min : '<i class="icon icon-exclamation-sign"></i>'+jl_select_tc_id
					}
                }
            });
        });


	//表单验证
    /* var style_text = "border:none; background: rgba(0,0,0,.7); color:#fff; max-width:90%; min-width:1rem; margin:0 auto; border-radius:.8rem;";
    $(function () {
        $.Tipmsg.r = null;
        $(".validation").Validform({
            tiptype: function (msg) {
                layer.open({
                    style: style_text,
                    type: 0,
                    anim: 3,
                    content: msg,
                    shade: false,
                    time: 2
                })
            },
            tipSweep: true,
            ajaxPost: true,

            callback: function (data) {
                if (data.status === 'y') {
                    window.location.href = data.url;
                } else {
                    layer.msg(data.info);
                    return false;

                }
            }
        });
    }) */	
   


    $("#explanationZoom").on("click", function () {
        var explanation = $(this).parents(".explanation");
        var width = $(".content_tips").width();
        if ($(this).hasClass("shopUp")) {
            $(this).removeClass("shopUp");
            $(this).attr("title", "{{ $lang['fold_tips'] }}");
            explanation.find(".ex_tit").css("margin-bottom", 10);
            explanation.animate({
                width: width
            }, 300, function () {
                $(".explanation").find("ul").show();
            });
        } else {
            $(this).addClass("shopUp");
            $(this).attr("title", "提示相关设置操作时应注意的要点");
            explanation.find(".ex_tit").css("margin-bottom", 0);
            explanation.animate({
                width: "118"
            }, 300);
            explanation.find("ul").hide();
        }
    });

    //未通过理由
    $(function () {
        var is_audit = "{{ $info['is_audit'] ?? '' }}";
        if (is_audit == 1) {
            $(".checkbox_item-box").addClass("active")
        } else {
            $(".checkbox_item-box").removeClass("active")
        }
    });

    $(".j-checkbox_item").on("click", function () {
        $(".checkbox_item-box").addClass("active")
    });
    $(".checkbox_item-1").on("click", function () {
        $(".checkbox_item-box").removeClass("active")
    });

    /**
     * 搜索商品
     */
    function searchGoods() {
        var form = $("#group_buy_form");
        var cat_id = form.find("input[name='category_id']").val();
        var brand_id = form.find("input[name='brand_id']").val();
        var keyword = form.find("input[name='keyword']").val();
        var ru_id = form.find("input[name='ru_id']").val();
        $.post("{{ route('admin/team/searchgoods') }}", {
            cat_id: cat_id,
            brand_id: brand_id,
            keyword: keyword
        }, function (data) {
            searchGoodsResponse(data);
        }, 'json');
    }

    function searchGoodsResponse(result) {
        $("#goods_id").children("ul").find("li").remove();

        var goods = result.content;
        if (goods) {
            for (i = 0; i < goods.length; i++) {
                $("#goods_id").children("ul").append("<li><i class='sc_icon sc_icon_no'></i><a href='javascript:;' " +
                        "data-value='" + goods[i].goods_id + "' data-price='" + goods[i].shop_price + "' " +
                        "class='ftx-01' onclick='goodsInfo(" + goods[i].shop_price + ")'>" + goods[i].goods_name + "</a><input type='hidden' name='user_search[]' value='" + goods[i].value + "'></li>")
            }
        }
    }


    // 选择品牌
    $('input[name="brand_name"]').click(function () {
        $(".brand-select-container").hide();
        $(this).parents(".selection").next(".brand-select-container").show();
        //$(".brand-list").perfectScrollbar("destroy");
        //$(".brand-list").perfectScrollbar();
    });

    /* AJAX选择品牌 */
    // 根据首字母查询
    $('.letter').find('a[data-letter]').click(function () {
        var goods_id = $("input[name=goods_id]").val();
        var letter = $(this).attr('data-letter');
        $(".brand-not strong").html(letter);
        $.post("{{ route('admin/team/searchbrand') }}", {goods_id: goods_id, letter: letter}, function (result) {
            if (result.content) {
                $(".brand-list").html(result.content);
                $(".brand-not").hide();
            } else {
                $(".brand-list").html("");
                $(".brand-not").show();
            }
            //$(".brand-list").perfectScrollbar("destroy");
            //$(".brand-list").perfectScrollbar();
        }, 'json')
    });


    // 根据关键字查询品牌
    $('.b_search').find('a').click(function () {
        var goods_id = $("input[name=goods_id]").val();
        var keyword = $(this).prev().val();
        $(".brand-not strong").html(keyword);
        $.post("{{ route('admin/team/searchbrand') }}", {goods_id: goods_id, keyword: keyword}, function (result) {
            if (result.content) {
                $(".brand-list").html(result.content);
                $(".brand-not").hide();
            } else {
                $(".brand-list").html("");
                $(".brand-not").show();
            }
            //$(".brand-list").perfectScrollbar("destroy");
            //$(".brand-list").perfectScrollbar();
        }, 'json')
    });

    // 选择品牌
    $('.brand-list').on('click', 'li', function () {
        $(this).parents('.brand-select-container').prev().find('input[data-filter=brand_id]').val($(this).data('id'));
        $(this).parents('.brand-select-container').prev().find('input[data-filter=brand_name]').val($(this).data('name'));
        $('.brand-select-container').hide();
    });

    jQuery.category = function () {
        $('.selection input[name="category_name"]').click(function () {
            $(this).parents(".selection").next('.select-container').show();
        });

        /*点击分类获取下级分类列表*/
        $(document).on('click', '.select-list li', function () {
            var obj = $(this);
            var cat_id = $(this).data('cid');
            $.post("{{ route('admin/team/filtercategory') }}", {cat_id: cat_id}, function (result) {
                if (result.content) {
                    obj.parents(".categorySelect").find("input[data-filter=cat_name]").val(result.cat_nav); //修改cat_name
                    obj.parents(".select-container").html(result.content);
                }
            }, 'json');
            obj.parents(".categorySelect").find("input[data-filter=cat_id]").val(cat_id); //修改cat_id

            var cat_level = obj.parents(".categorySelect").find(".select-top a").length; //获取分类级别
            if (cat_level >= 3) {
                $('.categorySelect .select-container').hide();
            }
        });

        //点击a标签返回所选分类 by wu
        $(document).on('click', '.select-top a', function () {
            var obj = $(this);
            var cat_id = $(this).data('cid');
            $.post("{{ route('admin/team/filtercategory') }}", {cat_id: cat_id}, function (result) {
                if (result.content) {
                    obj.parents(".categorySelect").find("input[data-filter=cat_name]").val(result.cat_nav); //修改cat_name
                    obj.parents(".select-container").html(result.content);
                    //$(".select-list").perfectScrollbar("destroy");
                    //$(".select-list").perfectScrollbar();
                }
            }, 'json');
            obj.parents(".categorySelect").find("input[data-filter=cat_id]").val(cat_id); //修改cat_id
        });
        /*分类搜索的下拉列表end*/
    }


    //div仿select下拉选框 start
    $(document).on("click", ".imitate_select .cite", function () {
        $(".imitate_select ul").hide();
        $(this).parents(".imitate_select").find("ul").show();
        //$(this).siblings("ul").perfectScrollbar("destroy");
        //$(this).siblings("ul").perfectScrollbar();
    });

    $(document).on("click", ".imitate_select li  a", function () {
        var _this = $(this);
        var val = _this.data('value');
        var text = _this.html();
        _this.parents(".imitate_select").find(".cite").html(text);
        _this.parents(".imitate_select").find("input[type=hidden]").val(val);
        _this.parents(".imitate_select").find("ul").hide();
    });
    //div仿select下拉选框 end

    $(document).click(function (e) {
        /*
         **点击空白处隐藏展开框
         */

        //会员搜索
        if (e.target.id != 'user_name' && !$(e.target).parents("div").is(".select-container")) {
            $('.selection_select .select-container').hide();
        }
        //品牌
        if (e.target.id != 'brand_name' && !$(e.target).parents("div").is(".brand-select-container")) {
            $('.brand-select-container').hide();
            $('.brandSelect .brand-select-container').hide();
        }
        //分类
        if (e.target.id != 'category_name' && !$(e.target).parents("div").is(".select-container")) {
            $('.categorySelect .select-container').hide();
        }
        //仿select
        if (e.target.className != 'cite' && !$(e.target).parents("div").is(".imitate_select")) {
            $('.imitate_select ul').hide();
        }
        //日期选择插件
        if (!$(e.target).parent().hasClass("text_time")) {
            $(".iframe_body").removeClass("relative");
        }
    });

    //select下拉默认值赋值
    $('.imitate_select').each(function () {
        var sel_this = $(this)
        var val = sel_this.children('input[type=hidden]').val();
        sel_this.find('a').each(function () {
            if ($(this).attr('data-value') == val) {
                sel_this.children('.cite').html($(this).html());
            }
        })
    });

    //分类选择
    $.category();

    $(".categorySelect .select-container ul li").click(function () {
        var cate = $(this).attr("data-cname")
        $("#category_name").val(cate)
    })
	
	 /**
     * 赋值商品价格
     */
    function goodsInfo(price) {
		$('#team_price').val(price);
    }

	
	
</script>
@include('admin.base.footer')
