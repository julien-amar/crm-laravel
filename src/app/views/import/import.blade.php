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
		{{ Form::open(array('url' => 'import/data', 'class' => 'form-signin', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::label('file', trans('import.form.import.fields.file')) }}
			{{ Form::file('file') }}
			
			{{ HTML::link('template', trans('import.form.import.fields.template')) }}
		</div>

		{{ Form::submit(trans('import.form.import.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

		{{ Form::hidden('_token', csrf_token(), array()) }}
		{{ Form::close() }}
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>{{ trans('import.form.result.title') }}</h1>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('import.grid.columns.login') }}</th>
					<th>{{ trans('import.grid.columns.fullname') }}</th>
					<th>{{ trans('import.grid.columns.email') }}</th>
					<th>{{ trans('import.grid.columns.admin') }}</th>
					<th>{{ trans('import.grid.columns.lock') }}</th>
					<th>{{ trans('import.grid.columns.action') }}</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
@stop
