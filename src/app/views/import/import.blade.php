@extends('layouts.standard')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="page-header">
			<h1>{{ trans('import.form.import.title') }}</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{{ Form::open(array('url' => 'import/data', 'class' => 'form-signin', 'role' => 'form', 'files' => true)) }}
		<div class="form-group">
			{{ Form::label('file', trans('import.form.import.fields.file')) }}
			{{ Form::file('file') }}
			
			<i class="fa fa-download import"></i> {{ HTML::link('templates/template.xlsx', trans('import.form.import.fields.template')) }}
		</div>

		{{ Form::submit(trans('import.form.import.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

		{{ Form::hidden('_token', csrf_token(), array()) }}
		{{ Form::close() }}
	</div>
</div>
@stop
