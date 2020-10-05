@include('admin.wechat.pageheader')
<div class="panel panel-default" style="margin:0;">
    <div class="panel-heading">{{ $lang['templates'] }}</div>
    <div class="flexilist of">
        <div class="common-content of">
            <div class="main-info">
                <form action="{{ route('admin/wechat/edit_template') }}" method="post" class="form-horizontal"
                      role="form" onsubmit="return false;">
                    @csrf
                    <div id="general-table" class="switch_info ">
                        <div class="item">
                            <div class="label-t">{{ $lang['template_title'] }}:</div>
                            <div class="label_value">
                                <input type="text" class="text" value="{{ $template['title'] }}" disabled readonly/>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label-t">{{ $lang['template_code'] }}:</div>
                            <div class="label_value">
                                <input type="text" class="text" value="{{ $template['code'] }}" disabled readonly/>
                            </div>
                        </div>

                        {{--<div class="item">--}}
                            {{--<div class="label-t">{{ $lang['template_content'] }}:</div>--}}
                            {{--<div class="label_value">--}}
                                {{--<textarea class="textarea" rows="5" disabled>{{ $template['template'] }}</textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="item">
                            <div class="label-t">{{ $lang['template_remark'] }}:</div>
                            <div class="label_value">
                                <textarea class="textarea" name="data[content]"
                                          rows="5">{{ $template['content'] }}</textarea>
                            </div>
                        </div>
                        <div class="item">
                            <div class="label-t">&nbsp;</div>
                            <div class="label_value info_btn">
                                <input type="hidden" name="id" value="{{ $template['id'] }}"/>
                                <input type="submit" value="{{ $lang['button_submit'] }}"
                                       class="button btn-danger bg-red"/>
                                <input type="reset" value="{{ $lang['button_reset'] }}" class="button button_reset"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('input[type="submit"]').click(function () {
            var ajax_data = $(".form-horizontal").serialize();
            $.post("{{ route('admin/wechat/edit_template') }}", ajax_data, function (data) {
                if (data.status > 0) {
                    window.parent.location.reload();
                } else {
                    layer.msg(data.msg);
                    return false;
                }
            }, 'json');
        });
    })
</script>
@include('admin.wechat.pagefooter')
