
<div class="wrapper-right of">

    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a></li>
            <li><a href="#home" >{{ $config['name'] }}记录</a></li>
        </ul>
    </div>
    <div class="tabmenu">
        <ul class="tab">
            <li
@if(empty($config['status']))
 class="active"
@endif
><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'messages', 'id' => $config['market_id'], 'status'=>0)) }}">未审核消息</a></li>
            <li
@if($config['status'])
 class="active"
@endif
><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'messages', 'id' => $config['market_id'], 'status'=>'all')) }}">全部消息</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'users', 'id' => $config['market_id'])) }}">参与会员</a></li>
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'prizes', 'id' => $config['market_id'])) }}">获奖名单</a></li>
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>一、未审核消息列表，点击审核成功通过的消息方可显示在大屏幕上。</li>
            <li>二、全部消息列表，可查看所有消息，如果审核有误，可移除到未审核。</li>
            <li>三、删除操作，即永久删除此消息，不可恢复。</li>
            <li>四、未审核消息，不会显示在大屏幕留言列表，仅显示在会员的聊天页面。</li>
        </ul>
    </div>

	<div class="wrapper-list mt20" >

        <div class="list-div" id="listDiv">
            <table id="list-table" class="ecsc-default-table" style="">
                <thead>
                <tr class="text-center">
                    <th class="text-center">昵称</th>
                    <th class="text-center">内容</th>
                    <th class="text-center">留言时间</th>
                    <th class="text-center">审核时间</th>
                    <th class="text-center">状态</th>
                    <th class="text-center">操作</th>
                </tr>
                </thead>

@foreach($list as $val)

                <tr class="text-center wall-list">
                    <td>{{ $val['nickname'] }}</td>
                    <td>{{ $val['content'] }}</td>
                    <td>{{ $val['addtime'] }}</td>
                    <td>{{ $val['checktime'] }}</td>
                    <td>{{ $val['status'] }}</td>
                    <td class="info_btn">
                        {{ $val['handler'] }}

@if($config['status'] == 'all' && $val['status'] == '已审核')

                        <a class="button btn-warning move" data-href="{!!  route('seller/wechat/market_action', array('type' => $config['keywords'], 'function' => 'messages', 'handler' => 'move','market_id' => $config['market_id'], 'msg_id' => $val['id'], 'user_id' => $val['user_id'], 'status' => 'all'))  !!}" href="javascript:;">移除</a>

@endif

                        <a class="button btn-danger bg-red data_delete" data-href="{!! route('seller/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'data_delete', 'market_id' => $config['market_id'], 'msg_id' => $val['id'], 'user_id' => $val['id'])) !!}" href="javascript:;">删除</a>
                    </td>
                </tr>

@endforeach


@if(empty($list))

                <tr class="no-records" ><td colspan="6">没有找到任何记录</td></tr>

@endif

            </table>
        </div>

        @include('seller.base.seller_pageview')

    </div>

</div>
<script type="text/javascript">
$(function(){
    // 审核
    $(".check").click(function(){
        var url = $(this).attr("data-href");
        $.post(url, '', function(data){
            layer.msg(data.msg);
            if(data.error == 0 ){
                if(data.url != ''){
                    // layer.msg(data.url);
                    window.location.href = data.url;
                }else{
                    window.location.reload();
                }
            }
            return false;
        }, 'json');
    });

    // 移除审核
    $(".move").click(function(){
        var url = $(this).attr("data-href");
        $.post(url, '', function(data){
            layer.msg(data.msg);
            if(data.error == 0 ){
                if(data.url != ''){
                    // layer.msg(data.url);
                    window.location.href = data.url;
                }else{
                    window.location.reload();
                }
            }
            return false;
        }, 'json');
    });

    // 删除消息记录
    $(".data_delete").click(function(){
        var url = $(this).attr("data-href");
        //询问框
        layer.confirm('您确定要删除此条记录吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post(url, '', function(data){
                layer.msg(data.msg);
                if(data.error == 0 ){
                    if(data.url != ''){
                        // layer.msg(data.url);
                        window.location.href = data.url;
                    }else{
                        window.location.reload();
                    }
                }
                return false;
            }, 'json');
        });
    });

});
</script>
