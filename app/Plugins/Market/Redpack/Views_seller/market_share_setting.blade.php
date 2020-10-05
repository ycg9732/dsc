
<div class="wrapper-right of" >
	<div class="title">现金红包 - 设置分享内容</div>
	<div class="content_tips">
        <div class="tabs_info">
            <ul>
                <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'id' => $config['market_id'])) }}">{{ $act_name }} 广告列表</a></li>
                <li class="curr"><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'share_setting', 'id' => $config['market_id'])) }}">设置分享</a></li>
            </ul>
        </div>
	    <div class="explanation" id="explanation">
            <div class="ex_tit"><i class="sc_icon"></i><h4>操作提示</h4><span id="explanationZoom" title="收起提示"></span></div>
            <ul>
                <li>给活动页面，自定义分享内容，让分享出去的页面更加多样。</li>
                <li>普通红包类型的红包活动，由于只能发送一个人，因此分享没有意义。</li>
                <li>裂变红包类型的红包活动分享出去后，其他用户关注微信公众号也可以参与该活动。</li>
            </ul>
        </div>
		<div class="flexilist of">
            <div class="common-content">
            <form action="{{ route('seller/wechat/share_setting') }}" method="post" class="form-horizontal form" id="form" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享标题</label>
                            <div class="col-xs-12 col-sm-5">
                                <input type="text" name="data[title]" class="form-control" value="{{ $info['title'] ?? ''}}" placeholder="分享标题"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享描述</label>
                            <div class="col-xs-12 col-sm-5">
                                <input type="text" name="data[description]" class="form-control" value="{{ $info['description'] ?? ''}}" placeholder="分享描述">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享图标</label>
                            <div class="col-md-2">
                                <div class="type-file-box">
                                    <input type="button"  class="type-file-button">
                                    <input type="file" class="type-file-file" name="icon" data-state="imgfile" hidefocus="true" >
                                    <span class="show">
                                        <a href="#inline_logo" class="nyroModal fancybox" title="预览">
                                            <i class="fa fa-picture-o" ></i>
                                        </a>
                                    </span>
                                    <input type="text" name="icon_path" class="type-file-text" value="{{ $info['icon'] ?? ''}}" style="display:none">
                                </div>
                            </div>
                            <div class="notic">图片建议尺寸：300×300 px，支持格式：jpeg,png</div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 control-label">分享链接</label>
                            <div class="col-sm-5">
                                <input id="comment" name="data[link]" class="form-control" placeholder="http://" value="{{ $info['link'] ?? ''}}"/>
                                <span class="notice">分享链接，空则默认为当前页链接</span>
                                <!-- <span class="help-block bg-danger" style="padding:0 10px;">{{ $url }}</span> -->
                            </div>
                        </div>

                        <div class="form-group info_btn">
                            <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                                <input type="hidden" name="id" value="{{ $info['id'] ?? ''}}" />
                                <input type="submit" name="submit" class="button btn-primary" value="确认" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
		    </div>
	    </div>
	</div>
</div>

<!-- 图片预览 start -->
<div class="panel panel-default" style="display: none;" id="inline_logo">
  <div class="panel-body">
     <img src="{{ $info['icon'] ?? ''}}" class="img-responsive" />
  </div>
</div>
<script type="text/javascript">
    //file移动上去的js
    $(".type-file-box").hover(function(){
        $(this).addClass("hover");
    },function(){
        $(this).removeClass("hover");
    });


$(function(){
    $('#form').submit(function(){
        if($('input[name="data[title]"]').val() == ''){
            layer.msg('分享标题不能为空.');
            return false;
        }
        if($('input[name="data[description]"]').val() == ''){
            layer.msg('分享描述不能为空.');
            return false;
        }

        if($('input[name="data[icon]"]').val() == ''){
            layer.msg('请选择分享图标.');
            return false;
        }

        return true;
    });
});
</script>
