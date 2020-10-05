@include('admin.wechat.pageheader')
<div class="container-fluid" style="padding:0">
  <div class="row" style="margin:0">
    <div class="col-md-12 col-sm-12 col-lg-12" style="padding:0;">
    <div class="panel panel-default">
      <div class="panel-heading">多客服设置</div>
      <div class="panel-body bg-info">
            <span class="help-block">   微信端输入kefu进入多客服系统。
            </span>
        </div>

      <div class="panel-body">
        <form action="{{ route('admin/wechat/customer_service') }}" method="post" class="form-horizontal" role="form">
            @csrf
          <div class="form-group">
            <label class="col-sm-1 col-md-1 col-lg-1 control-label">状态</label>
            <div class="col-sm-4 col-md-4 col-lg-4">
              <label class="radio-inline">
                <input type="radio" name="data[enable]" value="1"
@if($customer_service['enable'] == 1)
checked
@endif
 />开启
              </label>
              <label class="radio-inline">
                <input type="radio" name="data[enable]" value="0"
@if($customer_service['enable'] == 0)
checked
@endif
 />关闭
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-1 col-md-1 col-lg-1 control-label">转到客服</label>
            <div class="col-sm-4 col-md-4 col-lg-4"><input type="text" class="form-control" placeholder="请输入客服" name="config[customer]" value="{{ $customer_service['config']['customer'] }}">
            <span class="help-block">只有一个接待客服时可输入客服工号，一般不用填写，当有用户进入多客服时，会自动转接在线客服。</span></div>
          </div>
          <!-- <div class="form-group">
            <label class="col-sm-1 col-md-1 col-lg-1 control-label">会话自动关闭时间</label>
            <div class="col-sm-2 col-md-2 col-lg-2"><input type="text" class="form-control" placeholder="会话有效时间" name="config[valid_time]" value="{{ $customer_service['config']['valid_time'] }}"></div>
            <span class="help-block">单位：分钟。如果会话有效时间内没有交流，会话会自动失效。如果要联系客服请重新进入。</span>
          </div> -->
          <div class="form-group">
            <div class="col-sm-offset-1">
              <input type="submit" value="{{ $lang['button_submit'] }}" class="btn btn-primary" />
              <input type="reset" value="{{ $lang['button_reset'] }}" class="btn btn-default" />
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
@include('admin.wechat.pagefooter')
