<style type="text/css">
#footer {display: none;}
</style>
<div class="wrapper-right of">
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/market_list', array('type' => $config['keywords'])) }}" class="s-back">返回</a></li>
            <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab"> {{ $lang['wechat_market'] }} - {{ $config['name'] }}</a></li>
        </ul>
    </div>

    <div class="panel panel-default" style="margin:0;">
        <div class="panel-body text-center">
        	<img src="{{ $config['qrcode_url'] }}" alt="{{ $lang['qrcode'] }}" />
            <br>
            {{--{{ $short_url }}--}}
            <br> 微信扫描二维码，可进入微信墙
        </div>
    </div>

</div>
