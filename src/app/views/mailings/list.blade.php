@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('mailings.form.mailing.title') }}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div id="mailing-result">
</div>
@stop

@section('script')
<script type="text/javascript">
	var resultUrl = "{{ URL::to('mailings/results') }}";
</script>

	{{ HTML::script('js/mailings/list.js') }}
@stop
