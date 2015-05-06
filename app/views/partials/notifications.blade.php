@if ($errors->any())
<div class="alert alert-dismissable alert-danger backend-hud">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>错误！</strong> 请修正表单內容
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-dismissable alert-success backend-hud">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>成功！</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-dismissable alert-danger backend-hud">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>错误！</strong> {{ $message }}
</div>
@endif
