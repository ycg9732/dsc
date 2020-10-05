
<div class="wrapper-right of" >

	<div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a></li>
            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">{{ $config['name'] }} 活动记录</a></li>
        </ul>
    </div>

    <div class="explanation" id="explanation">
        <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4></div>
        <ul>
            <li>当前活动所有参与人员领取红包的记录</li>
        </ul>
    </div>
	<div class="wrapper-list mt20" >

        <div class="list-div" id="listDiv">
            <table id="list-table" class="ecsc-default-table" style="">
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

@foreach($redpacks as $redpack)

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
                            <a class="btn_see fancybox fancybox.iframe" href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'log_list', 'handler' => 'info', 'id' => $config['market_id'], 'log_id' => $redpack['id'])) }}" title="查看详情" ><i class="fa fa-eye"></i>{{ $lang['wechat_see'] }}</a>
                            <a class="btn_trash log_delete" href="javascript:;" data-href="{!!  route('seller/wechat/market_action', array('type' => $config['keywords'], 'handler' => 'log_delete', 'market_id' => $config['market_id'], 'log_id' => $redpack['id']))  !!}"  title="删除" ><i class="fa fa-trash-o"></i>{{ $lang['drop'] }}</a>
                        </div>
                        </td>
                    </tr>

@endforeach


@if(empty($redpacks))

                    <tr class="no-records" ><td colspan="7">没有找到任何记录</td></tr>

@endif

                </tbody>
            </table>
        </div>

        @include('seller.base.seller_pageview')

    </div>

</div>
<script type="text/javascript">
$(function(){
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
})
</script>
