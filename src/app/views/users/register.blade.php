@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('users.form.register.title') }}</h3>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('url' => 'users/create', 'role' => 'form')) }}
                    <fieldset>

                        @include('layouts.errors')

                        <div class="form-group">
                            {{ Form::label('login', trans('users.form.register.fields.login')) }}
                            {{ Form::text('login', null, array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.login.default') )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', trans('users.form.register.fields.password')) }}
                            {{ Form::password('password', array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.password.default') )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password_confirmation', trans('users.form.register.fields.password_confirmation')) }}
                            {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.password_confirmation.default') )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('fullname', trans('users.form.register.fields.fullname')) }}
                            {{ Form::text('fullname', null, array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.fullname.default') )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('phone', trans('users.form.register.fields.phone')) }}
                            {{ Form::text('phone', null, array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.phone.default'))) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('address', trans('users.form.register.fields.address')) }}
                            {{ Form::text('address', null, array('class'=>'form-control', 'placeholder' => trans('users.form.register.fields.address.default') )) }}
                        </div>

                        {{ Form::submit(trans('users.form.register.submit'), array('class'=>'btn btn-lg btn-primary btn-block'))}}

                        {{ Form::hidden('_token', csrf_token(), array()) }}
                    </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
