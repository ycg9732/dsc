<style>
    .market-admin-search{margin-top:0;width:100%}
    .move_div{overflow: hidden}
    .btn,.sc-btn{ height:18px; line-height:18px; border:1px solid #dcdcdc; padding:0 20px; color:#666; display:inline-block; border-radius:3px; cursor:pointer; font-size:12px;}
    .btn25{ height:23px; line-height:23px; padding:0 10px;}
    .red_btn{ background-color:#ec5151; color:#fff;border-color:#ec5151;}
    .move_handle{margin:6px 0 20px 0;}
    .search .market-admin-input{width:200px;float: initial;}
    .market-list-box select{margin-top:10px;width:200px;}

    /* 修正导出时间样式 */
    ul, li {overflow: hidden;}
    .dates_box_top {height: 32px;}
    .dates_bottom {height: auto;}
    .dates_hms {width: auto;}
    .dates_btn {width: auto;}
    .dates_mm_list span {width: auto;}

</style>
<div class="wrapper">
	<div class="title"><a href="{{ route('admin/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a>{{ $lang['wechat_menu'] }} - {{ $config['name'] }} 活动记录</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li class="curr"><a href="#">{{ $act_name }}  活动记录</a></li>
                <!-- <li><a href="{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'share_setting', 'id' => $config['market_id'])) !!}">设置分享</a></li> -->
            </ul>
        </div>
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>当前活动所有参与人员领取红包的记录</li>
                <li>搜索指定微信用户，发送现金红包。(需要关注微信公众号)</li>
            </ul>
        </div>
		<div class="flexilist of move_div">
                <div class="search  market-admin-search">
                    <h4>搜索指定微信用户，发送现金红包</h4>
                    <div class="input market-admin-input">
                        <input type="text" name="keywords" class="text nofocus" placeholder="搜索微信用户昵称" autocomplete="off">
                        <input type="submit" value="" class="btn search_button">
                    </div>
                    <div class="label_value">
                        <div class="market-list-box" >
                            <select name="select_user" class="form-control select_user">
                            </select>
                        </div>
                    </div>
                    <div class="move_handle">
                        <a href="javascript:void(0);"  class="btn btn25 red_btn" ectype="sub">发送</a>
                    </div>
                </div>


            <div class="common-content">
                <div class="list-div">
<!--                     <div class="panel panel-default">
                        <div class="panel-heading">删除所有数据</div>
                        <div class="panel-body">
                            确认删除本公众号红包表所有信息？
                            <a onclick="if(!confirm('删除后将不可恢复,确定删除吗?')) return false;" href="" class="btn btn-default btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="删除所有">删除所有</a>

                        </div>
                    </div> -->
                    <table class="table-hover table-striped" style="min-width: 300px;">
                        <thead class="navbar-inner">
                            <tr>
                                <th class="col-sm-1 text-center">id</th>
                                <th class="col-sm-2 text-center">微信昵称</th>
                                <th class="col-sm-1 text-center">红包类型</th>
                                <th class="col-sm-1 text-center">是否领取</th>
                                <th class="col-sm-2 text-center">领取金额(元)</th>
                                <th class="col-sm-2 text-center">领取时间</th>
                                <th class="col-sm-3 text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>

@if($list)

@foreach($list as $redpack)

                            <tr class="text-center">
                                <td>{{ $redpack['id'] }}</td>
                                <td>{{ $redpack['nickname'] }}</td>
                                <td>
@if($redpack['hb_type'] == 1)
裂变红包
@else
普通红包
@endif
</td>
                                <td>
@if($redpack['hassub'] == 1)
已领取
@else
未领取
@endif
</td>
                                <td>{{ $redpack['money'] }}</td>
                                <td>{{ $redpack['time'] }}</td>
                                <td class="handle">
                                <div class="tDiv a2">
                                    <a class="btn_see fancybox fancybox.iframe" href="{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'log_list', 'handler' => 'info', 'id' => $config['market_id'], 'log_id' => $redpack['id'])) !!}" title="查看详情" ><i class="fa fa-eye"></i>{{ $lang['wechat_see'] }}</a>
                                    <a class="btn_trash log_delete" href="javascript:;" data-href="{!! route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'log_delete', 'market_id' => $config['market_id'], 'log_id' => $redpack['id'])) !!}"  title="删除" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>
                                </div>
                                </td>
                            </tr>

@endforeach


@else

                            <tr class="no-records" ><td colspan="7">没有找到任何记录</td></tr>

@endif

                        </tbody>
                    </table>
                </div>
		    </div>
	    </div>
        <div class="list-div of">
            <table cellspacing="0" cellpadding="0" border="0">
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="tDiv of">
                                <div class="fl">
                                    <form action="{!! route('admin/wechat/data_list', array('type' => $config['keywords'], 'function' => 'export_redpack_log', 'id' => $config['market_id'])) !!}" method="post">
                                    <div class="label_value">
                                        <div class="text_time" id="text_time1" style="float:left;">
                                            <input type="text" name="starttime"  class="text" value="{{ date('Y-m-d H:i', mktime(0,0,0,date('m'), date('d')-7, date('Y'))) }}" id="promote_start_date" class="text mr0" readonly>
                                        </div>

                                        <div class="text_time" id="text_time2"  style="float:left;">
                                            <input type="text" name="endtime"  class="text" value="{{ date('Y-m-d H:i') }}" id="promote_end_date" class="text" readonly >
                                        </div>
                                        @csrf
                                        <input type="submit" name="export" value="导出" class="button bg-green" />
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td colspan="4">
                            @include('admin.wechat.pageview')
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
	</div>
</div>
<script type="text/javascript">
$(function(){
    // 搜索
    $('.search_button').click(function(){
        var nickname = $('input[name=keywords]').val();
        if (nickname) {
            $.post("{!! route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'search_nickname', 'market_id' => $config['market_id'])) !!}", {nickname: nickname }, function(data){

                if (data.status == 0) {
                    // console.log(data.result);
                    // console.log(data.result.length);
                    for (var i = 0; i < data.result.length; i++) {
                        $(".select_user").append("<option value="+data.result[i].openid+">"+data.result[i].nickname+"</option>");
                    }
                } else {
                    layer.msg(data.msg);
                }
                return false;
            }, 'json');

        } else {
            layer.msg('搜索关键词不能为空');
            return false;
        }
    });

    // 发送
    $('.red_btn').click(function(){
        var openid = $(".select_user").children('option:selected').val(); //是selected的值
        // console.log(openid);
        if (openid) {
            $.post("{!! route('admin/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'appoint_send_redpack', 'market_id' => $config['market_id'])) !!}", {openid: openid }, function(data){

                if (data.status == 0) {
                    layer.msg(data.content);
                    window.location.reload();
                } else {
                    layer.msg(data.content);
                }
                return false;
            }, 'json');

        } else {
            layer.msg('请选择微信用户');
            return false;
        }
    });


    // 删除日志记录
    $(".log_delete").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要删除此条记录吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.get(url, '', function(data){
                layer.msg(data.msg);
                if(data.error == 0 ){
                    if(data.url != ''){
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
                return false;
            }, 'json');
        });
    });


    var opts1 = {
        'targetId':'promote_start_date',
        'triggerId':['promote_start_date'],
        'alignId':'text_time1',
        'format':'-',
        'hms':'off'
    },opts2 = {
        'targetId':'promote_end_date',
        'triggerId':['promote_end_date'],
        'alignId':'text_time2',
        'format':'-',
        'hms':'off'
    }

    xvDate(opts1);
    xvDate(opts2);
})
</script>
