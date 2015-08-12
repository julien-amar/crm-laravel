@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="page-header">
                <h1>{{ trans('mailings.form.delete.title') }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ Form::open(array('url' => 'mailings/delete?mailing_id=' . $mailing->id, 'class' => 'form-delete', 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('file', trans('mailings.form.delete.label')) }}
            </div>

            {{ Form::submit(trans('mailings.form.delete.submit'), array('class'=>'btn btn-large btn-danger btn-block'))}}

            {{ Form::hidden('_token', csrf_token(), array()) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
