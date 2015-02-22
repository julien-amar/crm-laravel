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

$(document).ready(function() {
	var lastSubmitedForm = undefined;
	var resultUrl = "{{ URL::to('mailings/results') }}";

	function loadResult(url, dataString)
	{
		$("#mailing-result").loader();

        $.ajax({
	        type: "GET",
	        url: url,
	        data: dataString
        })
        .done(function(data) {
                $("#mailing-result").html(data);
		})
		.fail(function(request, error) {
                $("#mailing-result").html(data);
		});
	}

	function processSubmitSearch(event, form, url) {
		
		event.preventDefault();

		dataString = $(form).serialize();

		loadResult(url, dataString);
	}

	$('#mailing-result').on('click', '.pagination li a', function (event) {
		processSubmitSearch(event, lastSubmitedForm, this.href);
	});

	loadResult(resultUrl);
});

</script>
@stop
