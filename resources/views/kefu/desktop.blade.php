<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('themes/'. config('shop.template') .'/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/'. config('shop.template') .'/css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/chat/css/chat_list.css') }}">
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('vendor/layui/layui.js') }}"></script>
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('assets/chat/js/kefu.js') }}"></script>
    <style>
        body {
            min-height: 500px;
            background: #d8d8d8;
            color: #333;
            font-size: 12px;
        }

        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>

<div class="wrapper" id='chat_list' v-cloak>
    <div class="wrapper__left">
        <div class="header">
            <div class="user-info">
                <section>
                    <img :src=" user_avatar " alt="">
                    <dl>
                        <dt>@{{ user_name }}</dt>
                        <!--<dd><span>会员等级</span></dd>-->
                    </dl>
                </section>
                <div class="search"><i class="layui-icon"> &#xe615;</i><input type="text" placeholder="搜索最近联系人"
                                                                              :value="search_contact"
                                                                              v-model="search_contact"></div>
            </div>
        </div>
        <div class="user-list">
            <ul>
                <li :class="{'active': k.service_id == current_target}" v-for=" (k, v) in service_list_computer"
                    @click="change_service( k.service_id, $event )" v-if="k != undefined && k.isShow != 0"
                    :data-ruid="k.ru_id">
                    <div class="user-info" :data-index="k.service_id" :data-ruid="k.ru_id">
                        <em class="store-info zy">
                            @{{ k.shop_name | filter_shop_name }}
                        </em>
                        <em class="tips" v-if="k.count > 0">
                            @{{ k.count }}
                        </em>
                        <img :src="k.thumb" alt="">
                        <dl>
                            <dt>@{{ k.shop_name }}</dt>
                            <dd><span class="new-message" v-html="k.message"></span><span class="date">@{{ k.add_time | filter_time }}</span>
                            </dd>
                        </dl>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="wrapper__center">
        <div class="im-content">
            <div class="main w1200 user_home user_tran">
                <div class="user-right dis-box" id="c-tab-box3">
                    <div class="im-header im-chat-t">
                        <div class="im-shop">
                            <a href="#" class="enter"></a>
                            <h1 v-if="service_list[current_target] != undefined">
                                <em class="em"
                                    :class="{
                                        em_1: service_list[current_target].shop_name.indexOf('自营') < 0,
                                        em_2: service_list[current_target].shop_name.indexOf('自营') > 0
                                    }">&nbsp;</em>

                                <span class="im-chat-object" id="logoTitle">@{{ service_list[current_target].shop_name }}</span>
                                <i class="shop-on"></i>
                            </h1>
                        </div>
                    </div>
                    <div>
                        <div class="warp-con">
                            <div class="warp-chat" id='tank'>
                                <!--<p @click="get_more_msg()" v-show="(chat_data_page_list[current_target] == undefined || chat_data_page_list[current_target] > 0) && current_target > 0" class="get-more-msg" title="点击获取更多">点击获取更多</p>-->
                                <p @click="get_more_msg()" class="get-more-msg" title="点击获取更多">点击获取更多</p>
                                <ul>
                                    <li class="send-order">
                                        <section
                                            v-if="service_list_chat_data[current_target] != undefined && service_list_chat_data[current_target].goods != undefined && service_list_chat_data[current_target].goods.goods_id != undefined">
                                            <a :href="service_list_chat_data[current_target].goods.goods_url"
                                               target="_blank">
                                                <img :src="service_list_chat_data[current_target].goods.goods_thumb"
                                                     alt="">
                                                <dl>
                                                    <dd class="number">商品编号：@{{
                                                        service_list_chat_data[current_target].goods.goods_sn }}
                                                    </dd>
                                                    <dd class="name">商品名称：@{{
                                                        service_list_chat_data[current_target].goods.goods_name }}
                                                    </dd>
                                                </dl>
                                            </a>
                                        </section>
                                    </li>
                                    <li v-for="( list , k) in evenNumbers">
                                        <div :class="list.warp_chat" v-if="list.warp_chat === 'success'">
                                            @{{ list.message }}
                                        </div>
                                        <div :class="list.warp_chat" v-else>
                                            <img :src="list.user_picture" alt="">
                                            <div class="warp-chat-con">
                                                <h5 class="name">
                                                    @{{ list.user_name }}
                                                    <span>@{{ list.add_time }}</span>
                                                </h5>
                                                <div class="text" v-html='list.message'>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="warp-chat-left">-->
                                        <!--<img src="https://img6.bdstatic.com/img/image/smallpic/weijuchiluntu.jpg" alt="">-->
                                        <!--<div class="warp-chat-con">-->
                                        <!--<h5 class="name">-->
                                        <!--Sawyer-->
                                        <!--<span>2017-08-06 11:12:10</span>-->
                                        <!--</h5>-->
                                        <!--<div class="text">-->
                                        <!--附近可拉伸的-->
                                        <!--</div>-->
                                        <!--</div>-->
                                        <!--</div>-->
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <!-- 聊天窗口end -->
                        <div class="warp-editor">
                            <a class="history-list"><i class="iconfont icon-shijian"></i></a>
                            <textarea class="layui-textarea" id="LAY_demo1" style="display: none"
                                      v-model="cont"></textarea>
                            <button class="confirm j-send-msg" title="按Ctrl+Enter键发送消息, 按Enter键换行">发送</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper__right">
        <div class="header"></div>
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
                <li class="layui-this">店铺信息</li>
                <li>我的订单</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <ul class="store-info">
                        <li>
                            <em>店铺简介：</em> {{ $shop_info['shop_name'] }}
                        </li>
                        <li>
                            <em>公司名称：</em> {{ $shop_info['shop_desc'] }}
                        </li>
                        @if($shop_info['shop_start'] != '')
                            <li>
                                <em>开店时间：</em> {{ $shop_info['shop_start'] }}
                            </li>
                        @endif
                        <li>
                            <em>所在地区：</em> {{ $shop_info['shop_address'] }}
                        </li>
                        <li>
                            <em>商家电话：</em> {{ $shop_info['shop_tel'] ?? '该商家什么也没留下' }}
                        </li>
                    </ul>
                </div>
                <div class="layui-tab-item j-order-list">
                    <ul class="order-list">
                        <li class="order-list-li">
                            <p><label>订单号：</label><span></span></p>
                            <a class="img" target="_blank">
                                <img>
                            </a>
                            <dl>
                                <dt>
                                    <a target="_blank"></a>
                                </dt>
                                <dd class="price">

                                </dd>
                            </dl>
                        </li>
                    </ul>
                    <p class="no-order-list">暂无订单</p>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    dscmallKefu.user.user_id = {{ $user['user_id'] ?? 0 }};
    dscmallKefu.user.user_name = "{{ $user['user_name'] }}";
    dscmallKefu.user.avatar = "{{ $user['avatar'] }}";
    dscmallKefu.user.user_type = "customer";
    dscmallKefu.listen_route = "{{ $listen_route }}";
    dscmallKefu.port = {{ $port ?? 2347 }};
    dscmallKefu.user.goods_id = {{ $goods['goods_id'] ?? 0 }};
    dscmallKefu.user.store_id = {{ $shopinfo['ru_id'] ?? 0 }};
    dscmallKefu.user.store_logo = "{{ $shopinfo['logo_thumb'] }}";
    dscmallKefu.user.store_name = "{{ $shopinfo['shop_name'] }}";
    var audio_path = "{{ asset('assets/chat/media/ling.mp3') }}",
        chat_list_rul = "{{ route('kefu.index.chat_list') }}",
        service_list_chat_data_url = "{{ route('kefu.index.service_chat_data') }}?user_type=2",
        send_image_url = "{{ route('kefu.index.send_image') }}",
        get_more_msg_url = "{{ route('kefu.index.single_chat_list') }}?user_type=2",
        order_list_url = "{{ route('kefu.index.order_list') }}";

    var transMessage_api = "{{ route('kefu.admin.trans_message') }}";

    $(function () {
        dscmallEvent.target_service.uid = {{ $services_id ?? 'null' }};
        dscmallEvent.target_service.uname = null;

        dscmallEvent.target_service.store_id = dscmallKefu.user.store_id;

        layui.use('layer', function () {
            var layer = layui.layer;

            let json = {
                "data": [
                    {
                        "alt": "",
                        "src": "",
                        "thumb": ""
                    }
                ]
            };
            $('#tank ul').on('click', '.text img', function () {
                let image = $(this).attr('src');
                json.data[0].src = image;
                layer.photos({
                    photos: json
                });
            });

        });
        //
    })

</script>
<script src="{{ asset('assets/chat/js/pc.index.js') }}"></script>
</body>
</html>
