
<div class="wrapper-right of" >
    <div class="tabmenu">
        <ul class="tab">
            <li><a href="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'id' => $config['market_id'])) }}" class="s-back">返回</a></li>
            <li class="active"><a href="#">
@if(isset($info['id']) && $info['id'])
编辑
@else
添加
@endif
摇一摇广告</a></li>
        </ul>
    </div>

	<div class="wrapper-list mt20" >

        <form action="{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'handler' => 'edit', 'id' => $config['market_id'])) }}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data" onsubmit="return false;">
            <div class="account-setting ecsc-form-goods">
                    <dl>
                        <dt>活动名称：</dt>
                        <div class="col-xs-12 col-sm-2">
                            <input type="text" class="form-control" value="{{ $info['act_name'] }}" readonly >
                        </div>
                    </dl>
                    <dl>
                        <dt>广告图标：</dt>
                        <div class="col-xs-12 col-sm-5">
                            <div class="type-file-box">
                                <input type="button"  class="type-file-button" value="上传...">
                                <input type="file" class="type-file-file" name="icon" data-state="imgfile" hidefocus="true" >
                                <span class="show">
                                    <a href="#inline_logo" class="nyroModal fancybox" title="预览">
                                        <i class="fa fa-picture-o" ></i>
                                    </a>
                                </span>
                                <input type="text" name="icon_path" class="type-file-text" value="{{ $info['icon'] ?? ''}}" style="display:none">
                            </div>
                            <div class="notic">logo图片建议尺寸：50×50px，支持格式：jpeg,png</div>
                        </div>
                    </dl>
                    <dl>
                        <dt>广告内容：</dt>
                        <div class="col-xs-12 col-sm-8">
                            <input type="text" name="advertice[content]" class="form-control" value="{{ $info['content'] ?? '' }}" >
                            <div class="notic">广告内容示例：很遗憾没有中奖，请再接再励！</div>
                        </div>

                    </dl>
                    <dl>
                        <dt>广告链接：</dt>
                        <div class="col-xs-12 col-sm-8">
                            <input type="text" name="advertice[url]" class="form-control" value="{{ $info['url'] ?? ''}}" placeholder="http://" >
                            <div class="notic">广告链接示例：可填写商城其他推广页地址，如商品详情页，提高站内转化率</div>
                        </div>
                    </dl>

                    <dl>
                        <dt>&nbsp;</dt>
                        <dd class="button_info">
                            <input type="hidden" name="advertice[market_id]" value="{{ $config['market_id'] ?? '' }}" />
                            <input type="hidden" name="advertice_id" value="{{ $info['id'] ?? ''}}" />
                            <input type="submit" value="{{ $lang['button_submit'] }}" class="sc-btn sc-blueBg-btn btn35" />
                            <input type="reset" name="reset" value="{{ $lang['button_revoke'] }}" class="sc-btn sc-blue-btn btn35" />
                        </dd>
                    </dl>

            </div>
        </form>

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
    // 上传图片预览
    $("input[name=icon]").change(function(event) {
        // 根据这个 <input> 获取文件的 HTML5 js 对象
        var files = event.target.files, file;
        if (files && files.length > 0) {
          // 获取目前上传的文件
          file = files[0];

          // 那么我们可以做一下诸如文件大小校验的动作
          if(file.size > 1024 * 1024 * 5) {
            alert('图片大小不能超过 5MB!');
            return false;
          }

          // 预览图片
          var reader = new FileReader();
          // 将文件以Data URL形式进行读入页面
          reader.readAsDataURL(file);
          reader.onload = function(e){

              $(".img-responsive").attr("src", this.result);
          };
        }
    });

    // 提交
    $('input[type="submit"]').click(function(){

        if($('input[name="advertice[content]"]').val() == ''){
                layer.msg('请填写广告内容.');
                return false;
            }

        if($('input[name="advertice[url]"]').val() == ''){
            layer.msg('请填写广告链接.');
            return false;
        }

        var ajax_data = $(".form-horizontal").serialize();
        $(".form-horizontal").ajaxSubmit({
            type: "POST",
            dataType: "json",
            url: "{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'handler' => 'edit', 'id' => $config['market_id'])) }}",
            data: {
                ajax_data
            },
            contentType: false,
            cache: false,
            processData:false,
            success: function(data, textStatus) {
                layer.msg(data.msg);
                if(data.error == 0){
                    window.parent.location = "{{ route('seller/wechat/data_list', array('type' => $config['keywords'], 'function' => 'shake', 'id' => $config['market_id'])) }}";
                }else{
                    return false;
                }
            },
        });

    });
})


</script>
