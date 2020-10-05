<div class="footer">
    <p>{!! lang('admin/common.copyright', ['year' => date('Y')]) !!} </p>
</div>
<script type="text/javascript">
    function showImg(id, title) {
        var _content = $('#' + id).html();
        art.dialog({
            id: 'showImg',
            padding: 0,
            title: title,
            content: _content,
            lock: false
        });
    }
    $(function () {
        //弹出框
        $(".fancybox").fancybox({
            width: '60%',
            height: '60%',
            closeBtn: true,
            title: ''
        });

        // 删除提示
        $(".delete_confirm").click(function () {
            var url = $(this).attr("data-href");
            //询问框
            layer.confirm('{{ $lang['confirm_delete'] }}', {
                btn: ['{{ $lang['ok'] }}', '{{ $lang['cancel'] }}'] //按钮
            }, function () {
                window.location.href = url;
            });
        });

    })
</script>
</body>
</html>
