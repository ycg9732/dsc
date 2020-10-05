<script type="text/javascript">
    $(function () {
        // 操作提示
        $("#explanationZoom").on("click", function () {
            var explanation = $(this).parents(".explanation");
            var width = $(".content_tips").width();
            if ($(this).hasClass("shopUp")) {
                $(this).removeClass("shopUp");
                $(this).attr("title", "{{ lang('admin/common.fold_tips') }}");
                explanation.find(".ex_tit").css("margin-bottom", 10);
                explanation.animate({
                    width: width - 0
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


        //弹出框
        $(".fancybox").fancybox({
            width: '60%',
            height: '60%',
            closeBtn: true,
            title: ''
        });

        // 删除
        $(".delete").click(function () {
            var url = $(this).attr("data-href");
            //询问框
            layer.confirm('{{ $lang['confirm_delete'] }}', {
                btn: ['{{ $lang['ok'] }}', '{{ $lang['cancel'] }}'] //按钮
            }, function () {
                window.location.href = url;
            });
        });


    });

    // 修改分页数量
    function changePageSize(e) {
        var keynum = window.event ? e.keyCode : e.which;
        if (keynum == 13) {
            var page_num = $("#pageSize").val();
            $.post("{{ route('admin/app/index') }}", {page_num: page_num}, function (data) {
                if (data.status > 0) {
                    window.location.reload();
                }
            }, 'json');
            return false;
        }
    }
</script>
</body>
</html>