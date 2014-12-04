<div class="page-header">
	<h1>{{ trans('import.form.import.title') }}</h1>
</div>

{{ Form::open(array('url' => 'import/data', 'class' => 'form-signin', 'role' => 'form')) }}
    <div class="form-group">
        {{ Form::label('file', trans('import.form.import.fields.file')) }}
        {{ Form::file('file') }}
        
        {{ HTML::link('template', trans('import.form.import.fields.template')) }}
    </div>

    {{ Form::submit(trans('import.form.import.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

    {{ Form::hidden('_token', csrf_token(), array()) }}
{{ Form::close() }}

<div class="page-header">
	<h1>{{ trans('import.form.result.title') }}</h1>
</div>