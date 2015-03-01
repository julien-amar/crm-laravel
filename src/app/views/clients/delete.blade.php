@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="page-header">
                <h1>{{ trans('clients.form.delete.title') }}</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ Form::open(array('url' => 'clients/delete?client_id=' . $client->id, 'class' => 'form-delete', 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('file', trans('clients.form.delete.label')) }}
            </div>

            {{ Form::submit(trans('clients.form.delete.submit'), array('class'=>'btn btn-large btn-danger btn-block'))}}

            {{ Form::hidden('_token', csrf_token(), array()) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
