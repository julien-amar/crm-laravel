@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('users.form.login.title') }}</h3>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('url' => 'users/signin', 'role' => 'form')) }}
                    <fieldset>
                        <div class="form-group">
                            {{ Form::label('login', trans('users.form.login.fields.login')) }}
                            {{ Form::text('login', null, array('class' => 'form-control', 'placeholder' => trans('users.form.login.fields.login.default'), 'required' => 'required', 'autofocus' => 'autofocus' )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', trans('users.form.login.fields.password')) }}
                            {{ Form::password('password', array('class'=>'form-control', 'placeholder' => trans('users.form.login.fields.password.default'), 'required' => 'required' )) }}
                        </div>

                        {{ Form::submit(trans('users.form.login.submit'), array('class'=>'btn btn-lg btn-success btn-block'))}}

                        {{ Form::hidden('_token', csrf_token(), array()) }}
                    </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
