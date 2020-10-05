@include('admin.wechat.pageheader')
<style type="text/css">
    .article {
        border: 1px solid #ddd;
        padding: 5px 5px 0 5px;
    }

    .cover {
        height: 160px;
        position: relative;
        margin-bottom: 5px;
        overflow: hidden;
    }

    .article .cover img {
        width: 100%;
        height: auto;
    }

    .article span {
        height: 40px;
        line-height: 40px;
        display: block;
        z-index: 5;
        position: absolute;
        width: 100%;
        bottom: 0px;
        color: #FFF;
        padding: 0 10px;
        background-color: rgba(0, 0, 0, 0.6)
    }

    .article_list {
        padding: 5px;
        border: 1px solid #ddd;
        border-top: 0;
        overflow: hidden;
    }

    .checkbox label {
        width: 100%;
        position: relative;
        padding: 0;
    }

    .checkbox .news_mask {
        position: absolute;
        left: 0;
        top: 0;
        background-color: #000;
        opacity: 0.5;
        width: 100%;
        height: 100%;
        z-index: 10;
    }

    .checkbox .news_mask img {
        width: 50px;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -25px;
        margin-top: -25px;
    }

    .info_btn .button_reset {
        border-color: #139ff0;
        color: #139ff0;
    }
</style>
<div class="panel panel-default" style="margin:0;">
    <div class="panel-heading">{{ $lang['article_select'] }}</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-md-offset-2 col-sm-offset-2">

                @foreach($article as $k=>$v)

                    @if($k%2 == 0)

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="article[]" value="{{ $v['id'] ?? '' }}"
                                       class="hidden artlist"/>
                                <div class="article">
                                    <h4>{{ $v['title'] ?? '' }}</h4>
                                    <p>{{ date('Y年m月d日', $v['add_time']) }}</p>
                                    <div class="cover"><img src="{{ $v['file'] ?? '' }}"/></div>
                                    <p>{{ $v['content'] }}</p>
                                </div>
                                <div class="news_mask hidden"><img src="{{ asset('img/radio.png') }}"/></div>
                            </label>
                        </div>

                    @endif


                @endforeach

            </div>
            <div class="col-md-4 col-sm-4">

                @foreach($article as $k=>$v)


                    @if(($k+1)%2 == 0)

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="article[]" value="{{ $v['id'] }}" class="hidden artlist"/>
                                <div class="article">
                                    <h4>{{ $v['title'] }}</h4>
                                    <p>{{ date('Y年m月d日', $v['add_time']) }}</p>
                                    <div class="cover"><img src="{{ $v['file'] }}"/></div>
                                    <p>{{ $v['content'] }}</p>
                                </div>
                                <div class="news_mask hidden"><img src="{{ asset('img/radio.png') }}"/></div>
                            </label>
                        </div>

                    @endif


                @endforeach

            </div>
        </div>
    </div>
    <div class="panel-footer">
        @include('admin.wechat.pageview')
        <div class="info_btn of">
            <input type="submit" value="{{ $lang['button_submit'] }}" class="button confrim bg-blue"
                   name="file_submit"/>
            <input type="reset" value="{{ $lang['button_reset'] }}" class="button button_reset" name="reset"/>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        // 全局
        var articleDate = window.sessionStorage ? sessionStorage.getItem("article_ids") : Session.read("article_ids");
        // 本页面
        var article = [];
        // 显示已经选中的
        if (articleDate) {
            articleDate.split(",").each(function (val, index) {
                $("input[value=" + val + "]").attr("checked", 'checked');
                $("input[value=" + val + "]").siblings('.news_mask').removeClass("hidden");
                // 保存已有值
                article.push(val);
            });
        }
        // 点击选择与取消
        $(".artlist").click(function () {
            article = article.unique3(); // 去重
            if ($(this).is(":checked")) {
                $(this).siblings(".news_mask").removeClass("hidden");  // 显示遮罩 选中状态
                // 添加
                if (article.indexOf($(this).val()) == -1) {
                    article.push($(this).val());
                }
            } else {
                // 取消选择
                $(this).attr("checked", false);
                $(this).siblings(".news_mask").addClass("hidden");  // 移除遮罩  取消选中
                // 删除
                article.splice(article.indexOf($(this).val()), 1);
            }
            //article = article.unique3(); // 去重
            sessionStorage.setItem("article_ids", article);  // 存储sessionStorage
        });

        //选择图文提交
        $(".confrim").click(function () {
            var formArticleDate = '';
            formArticleDate = sessionStorage.getItem("article_ids");
            formArticleDate = formArticleDate.split(","); // 字符串转数组
            // 兼容
            var localArticle = [];
            $("input[type=checkbox]:checked").each(function () {
                localArticle.push($(this).val());
            });
            formArticleDate = formArticleDate ? formArticleDate : localArticle;

            if (formArticleDate.length > 8) {
                layer.msg('{{ $lang['article_news_notice'] }}');
                sessionStorage.removeItem("article_ids"); // 清空 sessionStorage article_ids
                window.location.reload();
                return false;
            }
            $.post("{{ route('seller/wechat/get_article') }}", {article: formArticleDate}, function (data) {
                if (data.length > 0) {
                    var str = '';
                    for (i = 0; i < data.length; i++) {
                        if (i == 0 && $(".ajax-data .article").length <= 0) {
                            str += '<div class="article"><input type="hidden" name="article[]" value="' + data[i]['id'] + '" /><p>' + data[i]['add_time'] + '</p><div class="cover"><img src="' + data[i]['file'] + '" /><span>' + data[i]['title'] + '</span></div></div>';
                        }
                        else {
                            str += '<div class="article_list"><input type="hidden" name="article[]" value="' + data[i]['id'] + '" /><span>' + data[i]['title'] + '</span><img src="' + data[i]['file'] + '" width="78" height="78" class="pull-right"></div>';
                        }
                    }
                    if (str != "") {
                        window.parent.$(".ajax-data").html(str);
                        window.parent.$.fancybox.close();
                    }
                }
                sessionStorage.removeItem("article_ids"); // 清空 sessionStorage article_ids
            }, 'json');
        });

        // 重置选择
        $(".button_reset").click(function () {
            sessionStorage.removeItem("article_ids");
            window.location.reload();
        });


        // 去重
        Array.prototype.unique3 = function () {
            var res = [];
            var json = {};
            for (var i = 0; i < this.length; i++) {
                if (!json[this[i]]) {
                    res.push(this[i]);
                    json[this[i]] = 1;
                }
            }
            return res;
        }
        // 查找位置
        Array.prototype.indexOf = function (val) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == val) return i;
            }
            return -1;
        };
        // 移除
        Array.prototype.remove = function (val) {
            var index = this.indexOf(val);
            if (index > -1) {
                this.splice(index, 1);
            }
        };


    })
</script>
@include('admin.wechat.pagefooter')
