<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>聊天管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//at.alicdn.com/t/font_hjioz0eqh50fi529.css" rel="stylesheet">
    <link href="{{ asset('vendor/layui/css/layui.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/chat/css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="header">
    <div class="header-left">
        <div class="header-left-img">
            <i class="state leave-state j-state iconfont icon-shijian1 jw-user-status"></i>
            <i class="iconfont icon-kefu"></i>
            <ul class="state-list">
                <li><i class="online"></i>在线</li>
                <!--<li><i class="iconfont icon-shijian1"></i>离开</li>-->
                <li><i class="out"></i>退出</li>
            </ul>
        </div>
        <span class="header-left-name jw-user-name"> </span>
    </div>
    <div class="header-right">
        <ul>
            <li class="wait-show j-wait-show">
                    <i class="paidui-num">
                        @if($total_wait > 0)
                        {{ $total_wait }}+
                        @endif
                    </i>
                <i class="iconfont icon-paidui"></i>
            </li>
        </ul>
    </div>
</div>
<div class="warpper">
    <div class="warpper-left">
        <!--<div class="warp-left-search">-->
        <!--<div class="warp-left-input">-->
        <!--<i class="iconfont icon-iconfontsousuo1"></i>-->
        <!--<input type="text" name="" placeholder="搜索">-->
        <!--</div>-->
        <!--</div>-->
        <div class="warp-left-user">
            <ul id="friend_list">
                @if($message_list)
                    @foreach($message_list as $list)
                        <li uid='{{ $list['customer_id'] }}' sid="{{ $list['store_id'] }}" gid="{{ $list['goods_id'] }}"
                            origin="{{ $list['origin'] }}"
                            status="{{ $list['status'] ?? '' }}">
                            <i class="num"
                               @if((isset($list['num']) && $list['num'] > 0) || (isset($list['message_sum']) && $list['message_sum'] > 0))
                               style='display:block'
                               @else
                               style='display:none'
                                @endif
                            >{{ $list['message_sum'] ?? '' }}</i>
                            <img src="{{ $list['user_picture'] }}" alt="">
                            <div class="warp-left-user-text">
                                <h4>{{ $list['user_name'] }}</h4>
                                <span>
                                    @if(isset($list['message_sum']) && count($list['message_sum']) > 0)
                                        {!! $list['message'][0] !!}
                                    @else
                                        {!! $list['message'] !!}
                                    @endif
                                </span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="warpper-center jw-user-window">
        <section class="no-choice-obj">
            <span style="background:url({{ $mouse_img }});"></span>
            <p>未选择聊天!</p>
        </section>
    </div>
    <div class="warpper-center jw-user-window">
        <div class="warp-center-title" style="position:relative">
            <!-- <button type="button" class="btn btn-warning close-link" id="close_dialog">断开连接</button> -->
            <h4>
                <b id="customer_name"></b>
                <span>来源：<b id="come_from"></b></span>
            </h4>
        </div>
        <div class="warp-con">
            <div class="warp-con-product jw-goods-info">
                <img src="" alt="">
                <a target="_blank">
                    <div class="warp-con-product-text">
                        <h4></h4>
                        <span class="price"></span>
                    </div>
                </a>
            </div>
            <div class="warp-chat">
                <ul id="jw-come-msg">
                    <li>
                        <div class="warp-chat-left">
                            <img alt="">
                            <div class="warp-chat-con">
                                <h5 class="name">
                                    <b></b>
                                    <span></span>
                                </h5>
                                <div class="text">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="warp-chat-right">
                            <img alt="">
                            <div class="warp-chat-con">
                                <h5 class="name">
                                    <b></b>
                                    <span></span>
                                </h5>
                                <div class="text">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="warp-editor">
            <!-- <a href="javascript:void(0)" class="history-list" style="right:45px">
                <i class="iconfont icon-kefu j-msg-list-i" title="切换客服"> </i>
                <ul class="msg-list j-msg-list">
                    @if($service_list)
                        @foreach($service_list as $list)
                            <li sid="{{ $list['id'] }}">{{ $list['name'] }}</li>
                        @endforeach
                    @endif
                </ul>
            </a> -->
            <a href="javascript:void(0)" class="history-list j-history-list" title="历史记录">
                <i class="iconfont icon-shijian"></i>
            </a>
            <textarea class="layui-textarea" id="LAY_demo1" style="display: none"></textarea>
            <button class="confirm jw-send-msg" title="按Ctrl+Enter键发送消息, 按Enter键换行">发送</button>
        </div>
    </div>
    <div class="warpper-right">
        <div class="warpper-right-setting">
            <div class="hd">
                <!-- 下面是前/后按钮代码，如果不需要删除即可 -->
                <ul>
                    <li>快捷回复</li>
                    <li>接入回复</li>
                    <!--<li>离开设置</li>-->
                </ul>
            </div>
            <div class="bd">
                <ul>
                    <li>
                        <ul class="add-reply-con" style="max-height: 680px; overflow-y: auto; display: block;">
                            <li>
                                <i class="iconfont icon-bianji warp-right-reply-icon"></i>
                                <div class="warp-right-reply">
                                    <div class="warp-right-reply-text jw-reply-content">
                                        <span></span>
                                        <div class="warp-right-reply-btn">
                                            <button class="confirm select" type="">选择</button>
                                            <button class="remove" type="">删除</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <a class="add-reply j-add-reply" href="#">
                        添加快捷回复
                    </a>
                </ul>
                <ul id="jw-take-user-ul">
                    <li>
                        <label for="" class="slide-list">
                            接入客户时，是否启用自动回复
                            <span class="slide-button jw-take-user-switch">
                                    <i></i>
                                </span>
                        </label>
                        <i class="iconfont icon-bianji warp-right-reply-icon"></i>
                        <div class="warp-right-reply">
                            <div class="warp-right-reply-text jw-reply-content">
                                <span></span>
                                <div class="warp-right-reply-btn">
                                    <button class="modify">编辑</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!--<ul id="jw-user-leave-ul">-->
                <!--<li>-->
                <!--<label for="" class="slide-list">-->
                <!--离开时，是否启用自动回复-->
                <!--<span class="slide-button jw-user-leave-switch">-->
                <!--<i></i>-->
                <!--</span>-->
                <!--</label>-->
                <!--<i class="iconfont icon-bianji warp-right-reply-icon"></i>-->
                <!--<div class="warp-right-reply">-->
                <!--<div class="warp-right-reply-text jw-reply-content">-->
                <!--<span></span>-->
                <!--<div class="warp-right-reply-btn">-->
                <!--<button class="modify">编辑</button>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</li>-->
                <!--</ul>-->
            </div>
        </div>
        <div class="warpper-right-loca ts-3">
            <div class="locl-list">
                <span class="time">
                </span>
                <ul id="jw-history-list" class="history-list">
                    <li>
                        <div class="warp-chat-con">
                            <h5 class="name user">
                                <b></b>
                                <span></span>
                            </h5>
                            <div class="text">
                            </div>
                            <a class="watchmsg">查看前后消息</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="footer-tool">
                <div class="footer-tool-date j-footer-tool-date">
                    <div class="fl ml20 footer-tool-date j-footer-tool-date flatpickr" data-wrap="true"
                         data-click-opens="false" id="enableNextSeven">
                        <a class="input-btn" data-toggle=""><i class="iconfont icon-iconfontrili icon-iconfontrili"></i></a>
                        <input id="flatpickr-tryme" style="border:none;width:68px" data-input=""
                               class="flatpickr-input active" readonly="readonly">
                    </div>
                </div>
                <div class="footer-tool-search">
                    <i class="iconfont icon-iconfontsousuo1 j-search-message-list"></i>
                    <input type="text">
                </div>
                <div class="footer-tool-page j-user-history">
                    <a class="first">
                        <i class="iconfont icon-daoshouye"></i>
                    </a>
                    <a class="prev">
                        <i class="iconfont icon-jinruyou"></i>
                    </a>
                    <a class="next">
                        <i class="iconfont icon-jinruyou-copy"></i>
                    </a>
                    <a class="last">
                        <i class="iconfont icon-daoshouye-copy"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 等待接入窗口 -->
<div class="modal wait-access j-wait-access">
    <div class="modal-header">
        等待接入
        <div class="modal-close j-modal-close">
            <i class="iconfont icon-close"></i>
        </div>
    </div>
    <div class="modal-body">
        <table class="table-list">
            <thead>
            <tr>
                <th class="text-left">客户信息</th>
                <th class="text-center">消息时间</th>
                <th class="text-center">客户来源</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="jw-wait-for">
            @if($wait_message)
                @foreach($wait_message as $message)
                    <tr>
                        <td class="table-list-title">
                            <input type="checkbox" uid="{{ $message['customer_id'] ?? 0 }}" fid="{{ $message['fid'] ?? 0 }}"
                                   gid="{{ $message['goods_id'] ?? 0 }}"
                                   sid="{{ $message['store_id'] ?? 0 }}">
                            <img src="{{ $message['avatar'] ?? '' }}" alt="">
                            <div class="title-desc">
                                <h4>{{ $message['user_name'] ?? '' }}</h4>
                                <span>{!! $message['message'] ?? '' !!}</span>
                            </div>
                        </td>
                        <td class="text-center" style="width:14%">{{ $message['add_time'] ?? '' }}</td>
                        <td class="text-center" style="width:14%">{{ $message['origin'] ?? '' }}</td>
                        <td class="table-list-end text-right" style="width:14%">
                            <i class="num">{{ $message['num'] ?? '' }}+</i>
                            <a href="#" class="modal-close j-modal-close">接入</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<!-- 等待接入窗口 -->
<div class="mask"></div>
<div class="mask-state"></div>

<script src="{{ asset('vendor/layui/layui.js') }}"></script>
<script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/chat/js/jquery.SuperSlide.2.1.1.js') }}"></script>
<link rel="stylesheet" id="cal_style" type="text/css" href="{{ asset('assets/chat/css/flatpickr.min.css') }}">
<script src='{{ asset('assets/chat/js/flatpickr.js') }}'></script>
<script src="{{ asset('assets/chat/js/kefu.js') }}"></script>
<script src="{{ asset('assets/chat/js/service.js') }}"></script>
<script type="text/javascript">

    dscmallKefu.user.user_id = {{ $user_id ?? 0 }};
    dscmallKefu.user.user_name = "{{ $user_name }}";
    dscmallKefu.user.avatar = "{{ $avatar }}";
    dscmallKefu.user.user_type = "service";
    dscmallKefu.listen_route = "{{ $listen_route }}";
    dscmallKefu.user.store_id = {{ $store_id ?? 0 }};
    dscmallKefu.port = {{ $port ?? 2347 }};

    var transMessage_api = "{{ route('kefu.admin.trans_message') }}";

    //点击退出
    $('.state-list li:eq(1)').click(function () {
        window.location.href = "{{ route('kefu.login.logout') }}";
    });

    layui.use('layedit', function () {
        var layedit = layui.layedit, $ = layui.jquery;

        //构建一个默认的编辑器
        var index = layedit.build('LAY_demo1', {
            height: 150,
            tool: ['face', 'image'],
            uploadImage: {
                url: "{{ route('kefu.admin.upload_image') }}",
                type: 'post'
            }
        });

        //编辑器外部操作
        var active = {
            content: function () {
                layer.msg(layedit.getContent(index)); //获取编辑器内容
            }
            , text: function () {
                layer.msg(layedit.getText(index)); //获取编辑器纯文本内容
            }
            , selection: function () {
                layer.msg(layedit.getSelection(index));
            }
        };
        $('.jw-send-msg').click(function () {
            // dscmallKefu.message.msg = layedit.getContent(index).replace(/(<p>)*(<\/p>)*(<br>)*(<\/br>)*/g, '');
            var content = layedit.getContent(index);
            dscmallKefu.message.msg = content;
            sendEnterMsg();
        });
        $('#LAY_layedit_1').contents().keydown(function (event) {
            switch (event.keyCode) {
                case 13 :
                    // ctr+Enter 快捷发送
                    if (event.ctrlKey && event.keyCode == 13) {
                        event.preventDefault();
                        // dscmallKefu.message.msg = layedit.getContent(index).replace(/(<p>)*(<\/p>)*(<br>)*(<\/br>)*/g, '');
                        var content = layedit.getContent(index);
                        dscmallKefu.message.msg = content;
                        sendEnterMsg();
                    }
                    break;
            }
        });

        $('.site-demo-layedit').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
        // 弹出图片显示
        let json = {
            "data": [
                {
                    "alt": "",
                    "src": "",
                    "thumb": ""
                }
            ]
        };
        $('ul#jw-come-msg').on('click', '.text img', function () {

            let image = $(this).attr('src');
            json.data[0].src = image;
            layer.photos({
                photos: json
            });
        });
    });

    function sendEnterMsg() {
        dscmallKefu.message.type = 'sendmsg';
        dscmallKefu.message.to_id = dscmallEvent.target_service.uid;
        dscmallKefu.message.avatar = dscmallKefu.user.avatar;
        dscmallKefu.message.store_id = dscmallEvent.target_service.store_id;
        dscmallKefu.message.goods_id = dscmallEvent.target_service.goods_id;
        dscmallKefu.message.origin = dscmallKefu.come_form;
        if (dscmallKefu.message.to_id == '' || dscmallKefu.message.to_id == undefined || dscmallEvent.target_service.status == '结束') return;
        // 处理消息接口
        if (dscmallKefu.message.msg == '' || dscmallKefu.message.msg == null) {
            return false;
        }
        var regex = /<(?!img|p|\/p).*?>/ig; // 去除所有html标签 且保留img p标签
        dscmallKefu.message.msg = dscmallKefu.message.msg.replace(regex, "");
        $.ajax({
            url: transMessage_api,
            data: {message: dscmallKefu.message.msg},
            async: false,
            type: 'post',
            success: function (res) {
                dscmallKefu.message.msg = res;
            }
        });
        dscmallKefu.sendmsg();
        $('#LAY_layedit_1').contents().find('body').html("");
        $('#LAY_layedit_1').contents().find('body').focus();
    }

    /**操作页面*/
    chathistory.config = {
        url: "{{ route('kefu.admin.history') }}",
        searchurl: "{{ route('kefu.admin.searchhistory') }}"
    };
    var dscmallEvent = {
        target_service: {uid: null, uname: null},
        friend_list: '',
        goods_info: [],
        store_info: [],
        users_data: [],
        history_is_open: false,
        history_total_page: 1,
        wait_message_list_data: [],
        audio: null,
        element: {
            friend_list_ele: null,
            message_ele_self: null,
            message_ele_others: null
        },
        init: function () {
            dscmallEvent.element.friend_list_ele = $('#friend_list li:eq(0)').clone();
            dscmallEvent.element.message_ele_self = $('#jw-come-msg li:eq(1)').clone();
            dscmallEvent.element.message_ele_others = $('#jw-come-msg li:eq(0)').clone();
            dscmallEvent.element.message_ele_wait_for = $('#jw-wait-for tr:eq(0)').clone();
            dscmallEvent.element.history_ele = $('#jw-history-list li:eq(0)').clone();

            $('#jw-come-msg').empty();

            var uid = Number($('#jw-wait-for tr:eq(0)').find('input').attr('uid'));
            if (uid == 0) {
                $('#jw-wait-for').empty();
            }
            /** 用户名 */
            $('.jw-user-name').text("{{ $nick_name }}");
            this.friendList();//聊天记录
            this.get_user();
            this.change_user();
            this.init_user_window_data();
            chathistory.init();
            this.close_window();
            this.close_dialog();
            this.total_wait_num();
            this.send_image();
            this.flatpickr();
            this.change_service();
            if (window.parent != window) {
                window.parent.location.href = window.parent.location.href + '/services.php?act=list';
            }
            //将待接入消息列表存入
            dscmallEvent.wait_message_list_data = {!! $wait_message_list !!};

            //声音
            dscmallEvent.audio = new Audio("{{ asset('assets/chat/media/ling.mp3') }}");
        },
        friendList: function () {
            var uid = Number($('#friend_list li:eq(0)').attr('uid'));
            if (isNaN(uid)) {
                $('#friend_list').empty();
            }

            $('#friend_list li').each(function () {
                var left_message = $(this).find('span').html();
                if (left_message.indexOf('new_message_list') !== -1) {
                    var regex = /<a\b[^>]+\bhref="([^"]*)"[^>]*>/gi; // a标签正则
                    // console.log(left_message);
                    // console.log(regex.exec(left_message));
                    left_message = regex.exec(left_message)[1]; // 图文仅显示链接
                } else {
                    left_message = left_message.replace(/<img.*?(?:>|\/>)/gi, '[图片]');
                }
                // console.log(left_message);
                $(this).find('span').html(left_message);
            });
        },
        //添加消息列表
        add_recode: function (data) {
            var is_same = false;
            $('#friend_list li').each(function () {
                var uid = Number($(this).attr('uid'));
                if (uid == data.id) {
                    $(this).attr('uid', data.id);
                    $(this).attr('gid', data.goods_id);
                    if (data.num == 0) {
                        $(this).children('.num').hide();
                    } else {
                        $(this).children('.num').text(data.num);
                    }
                    $(this).children('div').children('h4').text(data.name);
                    $(this).find('img').attr('src', data.pic);
                    $(this).children('div').children('span').html(data.message[data.message.length - 1]).text();
                    is_same = true;
                    return;
                }
            });
            if (!is_same) {
                $(dscmallEvent.element.friend_list_ele).attr('uid', data.id);
                if (data.num == 0) {
                    $(dscmallEvent.element.friend_list_ele).children('.num').hide();
                } else {
                    $(dscmallEvent.element.friend_list_ele).children('.num').text(data.num);
                }
                $(dscmallEvent.element.friend_list_ele).children('div').children('h4').text(data.name);
                $(dscmallEvent.element.friend_list_ele).find('img').attr('src', data.pic);
                $(dscmallEvent.element.friend_list_ele).children('div').children('span').html(data.message[data.message.length - 1]).text();
                $('#friend_list').prepend($(dscmallEvent.element.friend_list_ele).clone());
            }
        },
        come_message: function (data) {
            dscmallEvent.audio.play();
            this.notice('您有新的消息，请注意查看。', data.avatar);
            if (data.from_id == dscmallEvent.target_service.uid && data.message_type == 'come_msg') {
                //当前客户发来消息
                $('.jw-user-window').find('#come_from').text(data.origin);
                dscmallEvent.add_message(data, 2);
                dscmallEvent.add_message_list(data);
            } else if (data.to_id == dscmallKefu.user.user_id && data.message_type == 'come_msg') {
                //有客户发消息过来
                dscmallEvent.add_message_list(data);
            } else {
                //有客户等待接入
                this.notice('您有客户等待接入。', data.avatar);
                var content = dscmallEvent.element.message_ele_wait_for;
                var is_same = false;
                $('#jw-wait-for tr').each(function () {
                    var uid = Number($(this).find('input').attr('uid'));
                    if (uid == data.from_id) {
                        $(this).find('input').attr('uid', data.from_id);
                        $(this).find('input').attr('fid', data.from_id);
                        $(this).find('input').attr('gid', data.goods_id);
                        $(this).find('input').attr('sid', data.store_id);
                        $(this).find('img').attr('src', data.avatar);
                        var cur_num = parseInt($(this).find('.num').text());
                        if (isNaN(cur_num)) cur_num = 0;
                        $(this).find('.num').text((cur_num + 1).toString() + '+');
                        $(this).find('.title-desc h4').text(data.name);
                        $(this).find('.title-desc span').html(data.message).text();
                        $(this).children('td:eq(1)').text(data.time);
                        $(this).children('td:eq(2)').text(data.origin);
                        is_same = true;
                        dscmallEvent.wait_message_list_data[data.from_id].push(data.message);
                        return;
                    }
                });

                if (!is_same) {
                    $(content).find('input').attr('uid', data.from_id);
                    $(content).find('input').attr('fid', data.from_id);
                    $(content).find('input').attr('gid', data.goods_id);
                    $(content).find('input').attr('sid', data.store_id);
                    $(content).find('img').attr('src', data.avatar);
                    $(content).find('.num').text('1+');
                    $(content).find('.title-desc h4').text(data.name);
                    $(content).find('.title-desc span').html(data.message).text();
                    $(content).children('td:eq(1)').text(data.time || dscmallKefu.SystemDate());
                    $(content).children('td:eq(2)').text(data.origin);
                    dscmallEvent.wait_message_list_data[data.from_id] = new Array(data.message);
                    $('#jw-wait-for').append($(content).clone());
                }
                dscmallEvent.total_wait_num();//同步总的待接入数量
            }
        },
        total_wait_num: function () {
            //同步总的待接入数量
            var total_num = 0;
            $('#jw-wait-for tr').each(function () {
                var cur_num = parseInt($(this).find('.num').text());
                total_num += cur_num;
            });
            if (total_num > 0) {
                $('.paidui-num').css('display', 'block');
            } else {
                $('.paidui-num').css('display', 'none');
            }

            $('.paidui-num').text(total_num + '+');
        },
        add_message_list: function (data) {
            //将客户消息同步到历史记录
            $('ul#friend_list li').each(function () {
                var uid = Number($(this).attr('uid'));
                if (uid == data.from_id) {
                    $(this).find('img').attr('src', data.avatar);
                    $(this).find('h4').text(data.name);

                    if (data.message.indexOf('new_message_list') !== -1) {
                        var regex = /<a\b[^>]+\bhref="([^"]*)"[^>]*>/gi; // a标签正则
                        data.message = regex.exec(data.message)[1]; // 图文仅显示链接
                    }

                    $(this).find('span').html(data.message).text();
                    $(this).attr('gid', data.goods_id);
                    /**
                     * 同步聊天记录（界面）
                     * 如果不是当前聊天对象则将消息记录
                     * 如果不是当前聊天对象则显示未读数量
                     */
                    if (data.from_id != dscmallEvent.target_service.uid) {
                        var cur_num = parseInt($(this).find('.num').text()) || 0;
                        $(this).find('.num').css('display', 'block');
                        $(this).find('.num').text((cur_num + 1).toString() + '+');
                        dscmallEvent.sync_chat_data({
                            id: data.from_id,
                            name: data.name,
                            message: data.message,
                            time: data.time,
                            avatar: data.avatar,
                            belongs: 2,
                            is_sync: 1
                        });
                    }
                }
            });
        },
        add_message: function (data, belongs) {
            // belongs 1为自己消息  2为别人消息
            var content;
            var avatar = 'images/no_picture.jpg';
            if (belongs == 1) {
                content = dscmallEvent.element.message_ele_self;
                avatar = dscmallKefu.user.avatar;
            } else if (belongs == 2) {
                content = dscmallEvent.element.message_ele_others;
                avatar = data.avatar;
            } else {
                layer.msg('add_message_error');
                return;
            }

            //添加消息
            if (typeof data.message == 'object') {
                for (var i in data.message) {
                    $(content).find('img').attr('src', avatar);
                    $(content).find('b').text(data.name);
                    $(content).find('.text').html(data.message[i]).text();
                    $(content).find('.name span').text(data.time);

                    $('#jw-come-msg').prepend($(content).clone());
                    $('.warp-chat').scrollTop($('#jw-come-msg').height() - $('.warp-chat').height() + 25);

                    //同步聊天记录
                    dscmallEvent.sync_chat_data({
                        id: dscmallEvent.target_service.uid,
                        name: data.name,
                        message: data.message,
                        time: data.time,
                        avatar: avatar,
                        belongs: belongs,
                        is_sync: data.is_sync || 1
                    });
                }
            } else if (typeof data.message == 'string') {
                $(content).find('img').attr('src', avatar);
                $(content).find('b').text(data.name);
                $(content).find('.text').html(data.message).text();
                $(content).find('.name span').text(data.time);

                $('#jw-come-msg').append($(content).clone());
                $('.warp-chat').scrollTop($('#jw-come-msg').height() - $('.warp-chat').height() + 25);

                //同步聊天记录
                dscmallEvent.sync_chat_data({
                    id: dscmallEvent.target_service.uid,
                    name: data.name,
                    message: data.message,
                    time: data.time,
                    avatar: avatar,
                    belongs: belongs,
                    is_sync: data.is_sync || 1
                });
            }
        },
        //接入用户操作
        get_user: function () {
            $('#jw-wait-for').on('click', 'a', function () {
                var wait = $(this).parents('tr');
                var uid = Number($(wait).find('input').attr('uid'));
                if (dscmallEvent.target_service.uid != uid) {
                    $('#jw-come-msg').empty();
                }
                dscmallEvent.target_service = {
                    uid: uid,
                    uname: $(wait).find('h4').text()
                };
                $('#jw-history-list').empty();
                $(wait).remove();
                $(".j-wait-access").removeClass("show");

                var data = {
                    id: dscmallEvent.target_service.uid,
                    name: dscmallEvent.target_service.uname,
                    message: dscmallEvent.wait_message_list_data[dscmallEvent.target_service.uid],
                    num: $(wait).find('.num').text(),
                    time: $(wait).find('td:eq(1)').text(),
                    origin: $(wait).find('td:eq(2)').text(),
                    pic: $(wait).find('img').attr('src'),
                    goods: {}
                };

                var goods_id = Number($(wait).find('input').attr('gid'));
                if (goods_id != '' || goods_id != undefined) {
                    $.ajax({
                        url: "{{ route('kefu.admin.get_goods') }}",
                        data: {gid: goods_id},
                        async: false,
                        type: 'post',
                        success: function (d) {
                            dscmallEvent.goods_info[data.id] = {
                                goods_id: goods_id,
                                goods_name: d.goods_name,
                                goods_thumb: d.goods_thumb,
                                shop_price: d.shop_price
                            }
                        }
                    });
                }

                var store_id = Number($(wait).find('input').attr('sid'));
                if (store_id != '' || store_id != undefined) {
                    $.ajax({
                        url: "{{ route('kefu.admin.get_store') }}",
                        data: {sid: store_id},
                        async: false,
                        type: 'post',
                        success: function (d) {
                            dscmallEvent.store_info[data.id] = {
                                store_id: store_id,
                                shop_name: d.shop_name,
                                shop_thumb: d.logo_thumb
                            }
                        }
                    });
                }
                //添加到消息列表
                data.goods_id = goods_id;
                dscmallEvent.add_recode(data);
                //通知其他客服已被抢
                dscmallKefu.message.type = 'info';
                dscmallKefu.message.msg = Number($(wait).find('input').attr('fid')); // customer id
                dscmallKefu.message.from_id = dscmallKefu.user.user_id;
                dscmallKefu.message.goods_id = goods_id;
                dscmallKefu.message.store_id = store_id;
                dscmallKefu.sendinfomation();

                dscmallEvent.target_service.goods_id = goods_id;
                dscmallEvent.target_service.store_id = store_id;
                dscmallEvent.target_service.status = '未结束';

                //显示聊天窗口
                $('#close_dialog').css('display', 'block');
                dscmallEvent.show_dialog(dscmallEvent.target_service.uid);
                //同步消息
                var temp = {
                    id: dscmallEvent.target_service.uid,
                    name: data.name,
                    message: data.message,
                    time: data.time,
                    origin: data.origin,
                    avatar: data.pic,
                    belongs: 2,
                    is_sync: data.is_sync || 1
                };
                dscmallEvent.get_users_data(temp);  //检查用户数据是否存在
                dscmallEvent.sync_chat_data(temp);
                dscmallEvent.user_window(dscmallEvent.target_service.uid, 2);
                dscmallEvent.total_wait_num();//同步总的待接入数量
                delete dscmallEvent.wait_message_list_data[dscmallEvent.target_service.uid];//删除
            });
        },
        //清除被抢用户
        get_robbed: function (data) {
            var wait = $('#jw-wait-for').find('input[uid=' + data.cus_id + ']').parents('tr');
            $(wait).remove();
            dscmallEvent.total_wait_num();//同步总的待接入数量
        },
        init_user_window_data: function () {
            //初始化聊天数据
            var message_list = {!! $message_list_json !!};
            var goods;
            for (var i in message_list) {
                goods = {
                    goods_id: (message_list[i].goods == undefined) ? '' : message_list[i].goods.goods_id,
                    goods_name: (message_list[i].goods == undefined) ? '' : message_list[i].goods.goods_name,
                    pic: (message_list[i].goods == undefined) ? '' : message_list[i].goods.goods_thumb,
                    url: (message_list[i].goods == undefined) ? '' : message_list[i].goods.url,
                    price: (message_list[i].goods == undefined) ? '' : message_list[i].goods.shop_price
                };
                dscmallEvent.users_data[message_list[i].customer_id] = {
                    name: message_list[i].user_name,
                    origin: message_list[i].origin,
                    goods: goods,
                    content: [
                        {
                            avatar: (message_list[i].user_type == 1) ? dscmallKefu.user.avatar : message_list[i].user_picture,
                            name: (message_list[i].user_type == 1) ? dscmallKefu.user.user_name : message_list[i].user_name,
                            message: message_list[i].message,
                            time: message_list[i].add_time,
                            belongs: message_list[i].user_type
                        }
                    ]
                };
            }
            //初始化待接入列表
            var get_wait_data = "";
        },
        //切换用户
        change_user: function () {
            $('#friend_list').bind('click', 'li', function (e) {
                var target_customer;
                var uid = Number($(e.target).attr('uid'));
                if (isNaN(uid)) {
                    target_customer = $(e.target).parents('li');
                } else {
                    target_customer = $(e.target);
                }
                //检查是否存在消息
                var uid = Number($(target_customer).attr('uid'));
                var boo = dscmallEvent.has_message(uid);

                if (boo && confirm('确认接入用户？')) {
                    $('#jw-wait-for input[uid=' + uid + ']').parents('#jw-wait-for').find('a').click();   //自动接入用户
                    return;
                } else {
                    if ($(target_customer).attr('status') == '结束') {
                        $('#close_dialog').css('display', 'none');
                    } else {
                        $('#close_dialog').css('display', 'block');
                    }
                }
                //显示聊天窗口
                dscmallEvent.show_dialog();

                dscmallEvent.target_service.uid = Number($(target_customer).attr('uid'));
                dscmallEvent.target_service.uname = $(target_customer).find('h4').text();
                dscmallEvent.target_service.goods_id = Number($(target_customer).attr('gid'));
                dscmallEvent.target_service.store_id = Number($(target_customer).attr('sid'));
                dscmallEvent.target_service.status = $(target_customer).attr('status');

                //
                dscmallEvent.user_window(dscmallEvent.target_service.uid, 2);
                //将未读消息改为已读
                if (parseInt($(target_customer).find('.num').text()) > 0) {
                    $.ajax({
                        url: "{{ route('kefu.admin.change_message_status') }}",
                        data: {id: dscmallEvent.target_service.uid}
                    });
                }
                //去除未读数量
                $(target_customer).find('.num').text('');
                $(target_customer).find('.num').css('display', 'none');

                //关闭历史记录
                $(".warpper-right-loca").removeClass("active");
                dscmallEvent.history_is_open = false;
            });
        },
        has_message: function (id) {
            //检查用户是否存在待接入消息
            var boo = false;
            if (id == '' || id == undefined) return;
            $('#jw-wait-for input').each(function () {
                var uid = Number($(this).attr('uid'));
                if (uid == id) {
                    boo = true;
                }
            });
            return boo;
        },
        user_window: function (id, is_sync) {
            is_sync = is_sync || 1;
            //用户窗口
            $('#jw-come-msg').empty();
            var current_user = dscmallEvent.users_data[id];
            //商品信息
            if (current_user.goods.goods_name == '' || current_user.goods.goods_name == undefined) {
                $('.jw-goods-info').css('display', 'none');
            } else {
                $('.jw-goods-info').css('display', 'block');
            }
            //获取商品信息
            if (current_user.goods.goods_id != dscmallEvent.target_service.goods_id && dscmallEvent.target_service.goods_id > 0) {
                $.ajax({
                    url: "{{ route('kefu.admin.get_goods') }}",
                    data: {gid: dscmallEvent.target_service.goods_id},
                    async: false,
                    type: 'post',
                    success: function (d) {
                        current_user.goods.goods_id = dscmallEvent.target_service.goods_id;
                        current_user.goods.goods_name = d.goods_name;
                        current_user.goods.pic = d.goods_thumb;
                        current_user.goods.price = d.shop_price;
                        current_user.goods.url = "{$root_path}/goods.php?id=" + dscmallEvent.target_service.goods_id;
                        dscmallEvent.users_data[id] = current_user;
                    }
                });
            }

            //显示
            var goods_url = current_user.goods.url || "{$root_path}/goods.php?id=" + dscmallEvent.target_service.goods_id;
            $('.jw-user-window').find('#customer_name').text(current_user.name);
            $('.jw-user-window').find('#come_from').text(current_user.origin);
            if (current_user.goods.goods_id != undefined) {
                $('.jw-user-window').find('.jw-goods-info img').attr('src', current_user.goods.pic);
                $('.jw-user-window').find('.jw-goods-info h4').text(current_user.goods.goods_name);
                $('.jw-user-window').find('.jw-goods-info .price').text(current_user.goods.price);
                $('.jw-user-window').find('.jw-goods-info a').attr('href', goods_url);
            }

            for (var i in current_user.content) {
                current_user.content[i].is_sync = is_sync;
                dscmallEvent.add_message(current_user.content[i], current_user.content[i].belongs);
            }
        },
        get_users_data: function (data) {
            //获取用户聊天资料、用来操作用户列表、检查是否存在用户的  变量
            //如果该用户数据不在  则初始化数据
            var id = dscmallEvent.target_service.uid;
            if (dscmallEvent.users_data[id] == undefined) {
                //如果没有则初始化变量
                dscmallEvent.users_data[id] = {
                    name: dscmallEvent.target_service.uname,
                    origin: data.origin,
                    goods: dscmallEvent.goods_info[id],
                    content: []
                };
            }
        },
        sync_chat_data: function (data) {
            //保持聊天数据同步
            if (data.is_sync == 1) {
                dscmallEvent.get_users_data(data.id, data);
                if (typeof data.message == 'string') {
                    dscmallEvent.users_data[data.id].content.push({
                        avatar: data.avatar,
                        name: data.name,
                        message: data.message,
                        time: data.time,
                        belongs: data.belongs
                    });
                } else {
                    for (var i in data.message) {
                        dscmallEvent.users_data[data.id].content.push({
                            avatar: data.avatar,
                            name: data.name,
                            message: data.message[i],
                            time: data.time,
                            belongs: data.belongs
                        });
                    }
                }
            }
        },
        close_link: function (d) {
            //服务器自动断开会话
            $('#friend_list li[uid = ' + d.cid + ']').attr('status', '结束');
            $('#close_dialog').css('display', 'none');
            dscmallEvent.target_service.uid = '';
            //关闭历史记录
            $(".warpper-right-loca").removeClass("active");

        },
        change_service: function () {
            //切换客服
            $(document).bind('click', function (e) {
                if (e.target.className.indexOf('j-msg-list-i') > 0) {
                    if ($('.j-msg-list').css('display') == 'block') {
                        $('.j-msg-list').css('display', 'none');
                    } else {
                        $('.j-msg-list').css('display', 'block');
                    }
                } else {
                    $('.j-msg-list').css('display', 'none');
                }
            });

            //将客户转给其他客服
            $('.j-msg-list li').click(function () {
                dscmallKefu.message.type = 'change_service';
                dscmallKefu.message.to_id = Number($(this).attr('sid'));
                dscmallKefu.message.from_id = dscmallKefu.user.user_id;
                dscmallKefu.message.cus_id = dscmallEvent.target_service.uid;
                dscmallKefu.message.store_id = dscmallKefu.user.store_id;
                dscmallKefu.message.goods_id = dscmallKefu.user.goods_id;
                dscmallKefu.message.origin = dscmallKefu.come_form;
                //console.log(dscmallKefu.message)
                dscmallKefu.sendinfomation();
            });

        },
        switch_service: function (data) {
            //切换客服

            if (dscmallKefu.user.user_id == data.fid) {
                //关闭会话
                console.log('当前客服')
                console.log(data)
                console.log(dscmallKefu.user)
                // console.log(dscmallEvent.target_service)
                $.post("{{ route('kefu.admin.change_new_msg_info') }}", {cus_id: data.cus_id, ser_id: data.sid});
                // $.post("{{ route('kefu.admin.close_dialog') }}", {uid: dscmallKefu.user.user_id, tid: dscmallEvent.target_service.uid});
                //本人
                dscmallEvent.target_service = {uid: null, uname: null};

                $('#jw-come-msg').empty();
                $('.jw-goods-info img').removeAttr('src');
                $('.jw-goods-info h4').text('');
                $('.jw-goods-info .price').text('');
                $('#customer_name').text('');
                $('#come_from').text('');
                //关闭历史记录
                $(".warpper-right-loca").removeClass("active");

                //断开链接
                $('#friend_list li[uid = ' + data.cus_id + ']').attr('status', '结束');
                $('#close_dialog').css('display', 'none');

            } else if (dscmallKefu.user.user_id == data.sid) {
                //其他客服，接收转接客户
                console.log('切换后的客服')
                console.log(data)
                console.log(dscmallKefu.user)

                // $.post("{{ route('kefu.admin.createdialog') }}", {uid: dscmallKefu.user.user_id, cid: data.cus_id, fid: data.fid});

                $.post("{{ route('kefu.admin.dialog_info') }}", {
                    uid: dscmallKefu.user.user_id,
                    cid: data.cus_id
                }, function (d) {

                    console.log(d)

                    if ($('#friend_list li[uid = ' + data.cus_id + ']').length > 0) {
                        $('#friend_list li[uid = ' + data.cus_id + ']').attr('status', '未结束');
                    } else {
                        if (d.goods == '' || d.goods == null) {
                            d.goods.goods_id = 0;
                        }
                        $(dscmallEvent.element.friend_list_ele).attr('uid', data.cus_id);
                        $(dscmallEvent.element.friend_list_ele).attr('sid', data.store_id);
                        $(dscmallEvent.element.friend_list_ele).attr('gid', d.goods.goods_id);
                        $(dscmallEvent.element.friend_list_ele).attr('origin', d.origin);
                        $(dscmallEvent.element.friend_list_ele).attr('status', '未结束');
                        $(dscmallEvent.element.friend_list_ele).children('div').children('h4').text(d.name);
                        $(dscmallEvent.element.friend_list_ele).find('img').attr('src', d.avatar);

                        $('#friend_list').prepend($(dscmallEvent.element.friend_list_ele).clone());

                        dscmallEvent.users_data[data.cus_id] = {
                            goods: {
                                goods_id: d.goods.goods_id,
                                goods_name: d.goods.goods_name,
                                pic: d.goods.goods_thumb,
                                price: d.goods.shop_price,
                                url: "{{ $root_path }}/goods.php?id=" + d.goods.goods_id
                            },
                            name: d.name,
                            origin: d.origin,
                            content: [
                                {
                                    avatar: d.avatar,
                                    name: d.name,
                                    // message: d.message.message,
                                    time: d.message.add_time,
                                    // belongs: d.message.user_type
                                }
                            ]
                        };

                    }

                });

            }
        },
        flatpickr: function () {
            //初始化日历
            var d = new Date();
            var datetime = (d.getFullYear().toString()) + '-' + (dscmallKefu.p((d.getMonth() + 1).toString())) + '-' + (dscmallKefu.p(d.getDate().toString()));

            //Regular flatpickr
            document.getElementById("flatpickr-tryme").setAttribute("placeholder", datetime);
            document.getElementsByClassName("calendar").flatpickr();
            document.getElementsByClassName("flatpickr").flatpickr();
        },
        close_window: function () {
            //关闭对话框
            $('#close_dialog').css('cursor', 'pointer');
            $('#close_dialog').click(function () {
                if ((typeof dscmallEvent.target_service.uid == 'string') && parseInt(dscmallEvent.target_service.uid) > 0) {
                    if (confirm('确认关闭此次会话？')) {
                        $.ajax({
                            url: "{{ route('kefu.admin.close_dialog') }}",
                            type: 'post',
                            data: {
                                uid: dscmallKefu.user.user_id, tid: dscmallEvent.target_service.uid
                            },
                            success: function (d) {
                                //通知用户已断开
                                dscmallKefu.message.type = 'close_link';
                                dscmallKefu.message.to_id = dscmallEvent.target_service.uid;
                                if (dscmallKefu.message.to_id == '' || dscmallKefu.message.to_id == undefined) return;
                                dscmallKefu.sendinfomation();

                                $('#jw-come-msg').empty();
                                $('.jw-goods-info img').removeAttr('src');
                                $('.jw-goods-info h4').text('');
                                $('.jw-goods-info .price').text('');
                                $('#customer_name').text('');
                                $('#come_from').text('');
                                dscmallEvent.target_service.uid = '';
                                dscmallEvent.close_dialog(dscmallKefu.message.to_id);
                                //关闭历史记录
                                $(".warpper-right-loca").removeClass("active");
                            }
                        });
                    }
                }
            });
        },
        uoffline: function (m) {
            $('#jw-come-msg>li:last').remove();
        },
        show_dialog: function (id) {
            //显示聊天窗口
            $('.jw-user-window:eq(0)').css('display', 'none');
            $('.jw-user-window:eq(1)').css('display', 'block');
            $('#friend_list li[uid = ' + id + ']').attr('status', '未结束');
        },
        close_dialog: function (id) {
            //关闭聊天窗口
            $('.jw-user-window:eq(0)').css('display', 'block');
            $('.jw-user-window:eq(1)').css('display', 'none');
            $('#friend_list li[uid = ' + id + ']').attr('status', '结束');
        },
        send_image: function () {
            //发送图片
            $('.j-send-image').click(function () {
            });
        },
        notice: function (m, icon) {
            Notification.requestPermission(function (perm) {
                if (perm === 'granted') {
                    new Notification('消息通知', {
                        dir: 'auto',
                        lang: 'zh-CN',
                        tag: 'message',
                        icon: icon,
                        body: '通知内容：' + m
                    })
                }
            })
        }
    };

    /**  快捷回复 */
    var reply_data = {!! $reply !!};
    $('.add-reply-con').on('click', '.confirm:not(.select)', function () {
        var reply = $(this).parents('ul.add-reply-con').find('li').eq($(this).parents('li').index());
        var content = $(reply).find('textarea').val();
        if (content == '' || content == undefined) {
            alert('请填写内容');
            return;
        }

        $.ajax({
            url: "{{ route('kefu.admin.add_reply') }}",
            type: 'post',
            data: {content: content},
            success: function (d) {
                if (d.error == 0) {
                    reply_data.push({id: d.id, content: $(reply).find('textarea').val()});
                    show_reply();
                }
            }
        });

    });
    /** 删除快捷回复 */
    $('.add-reply-con').on('click', '.remove', function () {
        var id = $(this).parents('li').attr('id');
        if (!isNaN(id)) {
            if (!confirm('确认删除此快捷回复？')) return;
            $.ajax({
                url: "{{ route('kefu.admin.remove_reply') }}",
                type: 'post',
                data: {id: reply_data[id].id}
            });
            //
            reply_data.splice(id, 1);
        }
        show_reply();
    });
    /** 选择快捷回复 */
    $('.add-reply-con').on('click', '.select', function () {
        var text = $(this).parent().siblings('span').text();
        $('#LAY_layedit_1').contents().find('body').html(text);
    });

    /** 更新快捷回复 */
    var reply = $('.add-reply-con li').eq(0).clone();
    $('.add-reply-con li').eq(0).remove();
    show_reply();

    function show_reply() {
        $('ul.add-reply-con').empty();
        for (var i in reply_data) {
            $(reply).attr('id', i);
            $(reply).find('.jw-reply-content span').text(reply_data[i].content);
            $('.add-reply-con').append($(reply).clone());
        }
    }

    /** 切换在线状态 */
    $(".header-left-img .state.leave-state").css("color", "#20e91b");
    $(".state-list li").click(function () {
        var num = $(this).index();
        if (num == 0) {
            $(".header-left-img .state.leave-state").css("color", "#20e91b");
        } else if (num == 1) {
            $(".header-left-img .state.leave-state").css("color", "#d6d7d8");
        } else if (num == 2) {
            $(".header-left-img .state.leave-state").css("color", "#f93d5d");
        }
        $(".state-list").toggle();
        $.ajax({
            url: "{{ route('kefu.admin.change_status') }}",
            type: 'post',
            data: {status: num}
        });
    });

    /** 是否启动接入回复 */
    $('.jw-take-user-switch').click(function () {
        var mid = $('#jw-take-user-ul').attr('mid');
        var status = ($(this).hasClass('active') == true) ? 1 : 0;

        $.post("{{ route('kefu.admin.take_user_reply') }}", {
            id: mid,
            status: status
        }, function (d) {
            if (d.error == 1) {
                alert(d.msg);
                $('.jw-take-user-switch').removeClass('active');
            }
        }, 'json');
    });
    /** 接入回复控制 */
    var text;
    var leave_text;
    var take_reply = {!! $take_reply !!} || '';
    if (take_reply != '') {
        $('#jw-take-user-ul .jw-reply-content>span').text(take_reply.content);
        $('#jw-take-user-ul').attr('mid', take_reply.id);
        if (take_reply.is_on == 1) {
            $('#jw-take-user-ul .jw-take-user-switch').addClass('active');
        } else {
            $('#jw-take-user-ul .jw-take-user-switch').removeClass('active');
        }
    }

    $('#jw-take-user-ul, #jw-user-leave-ul').on('click', '.modify', function () {
        if ($(this).parents('ul').attr('id') == 'jw-take-user-ul') {
            text = $(this).parent().parent().find('span').text();
            $(this).parent().parent().prepend("<textarea>" + text + "</textarea>");
        } else {
            leave_text = $(this).parent().parent().find('span').text();
            $(this).parent().parent().prepend("<textarea>" + leave_text + "</textarea>");
        }
        $(this).parent().parent().find('span').remove();

        var modify = $(this).clone();

        $(modify).text('取消');
        $(modify).removeClass();
        $(modify).addClass('remove');
        $(this).parent().prepend($(modify).clone());
        $(modify).text('确定');
        $(modify).removeClass();
        $(modify).addClass('confirm');
        $(this).parent().prepend($(modify).clone());

        $(this).remove();
    });
    $('#jw-take-user-ul, #jw-user-leave-ul').on('click', '.remove', function () {
        var remove = $(this).clone();
        $(remove).text('编辑');
        $(remove).removeClass();
        $(remove).addClass('modify');
        $(this).parent().prepend($(remove).clone());

        $(this).parent().parent().find('textarea').remove();
        if ($(this).parents('ul').attr('id') == 'jw-take-user-ul') {
            $(this).parent().parent().prepend("<span>" + text + "</span>");
        } else {
            $(this).parent().parent().prepend("<span>" + leave_text + "</span>");
        }
        $(this).parent().parent().find('.confirm').remove();
        $(this).remove();
    });
    $('#jw-take-user-ul, #jw-user-leave-ul').on('click', '.confirm', function () {
        var confirm = $(this).clone();
        var temp_text;
        var temp_url;
        var temp;
        $(confirm).text('编辑');
        $(confirm).removeClass();
        $(confirm).addClass('modify');
        $(this).parent().prepend($(confirm).clone());

        if ($(this).parents('ul').attr('id') == 'jw-take-user-ul') {
            temp_text = text = $(this).parent().parent().find('textarea').val();
            $(this).parent().parent().prepend("<span>" + text + "</span>");
            temp_url = "{{ route('kefu.admin.insert_user_reply') }}";
            temp = 1;
        } else {
            temp_text = leave_text = $(this).parent().parent().find('textarea').val();
            $(this).parent().parent().prepend("<span>" + leave_text + "</span>");
            temp_url = "{{ route('kefu.admin.insert_user_leave_reply') }}";
            temp = 2;
        }
        $(this).parent().parent().find('textarea').remove();
        $(this).parent().parent().find('.remove').remove();

        var mid = $(this).parents('ul').attr('mid');
        $.post(temp_url, {
            content: temp_text,
            mid: mid
        }, function (d) {
            if (d.error == 0) {
                if (temp == 1) {
                    $('#jw-take-user-ul').attr('mid', d.mid);
                } else if (temp == 2) {
                    $('#jw-user-leave-ul').attr('mid', d.mid);
                }
            }
        }, 'json');
        $(this).remove();
    });

    //接入操作结束
    /** 离开设置 */
    var leave_reply = {{ $leave_reply }} || '';
    if (leave_reply != '') {
        $('#jw-user-leave-ul .jw-reply-content>span').text(leave_reply.content);
        $('#jw-user-leave-ul').attr('mid', leave_reply.id);
        if (leave_reply.is_on == 1) {
            $('#jw-user-leave-ul .jw-user-leave-switch').addClass('active');
        } else {
            $('#jw-user-leave-ul .jw-user-leave-switch').removeClass('active');
        }
    }

    $('.jw-user-leave-switch').click(function () {
        var mid = $('#jw-user-leave-ul').attr('mid');
        var status = ($(this).hasClass('active') == true) ? 1 : 0;

        $.post("{{ route('kefu.admin.user_leave_reply') }}", {
            id: mid,
            status: status
        }, function (d) {
            if (d.error == 1) {
                alert(d.msg);
                $('.jw-user-leave-switch').removeClass('active');
            }
        }, 'json');
    });

    //选择日历回调函数
    function getData(date) {
        chathistory.gethistory_data(1, '', date);
    }

    /** 离开设置end */
</script>
</body>
</html>
