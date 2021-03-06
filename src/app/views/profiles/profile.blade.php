@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="page-header">{{ trans('profile.form.profile.title') }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ Form::open(array('url' => 'profile/profile', 'class' => 'form-signin', 'role' => 'form')) }}
            {{ Form::hidden('user_id', $user->id) }}

            @include('layouts.errors')

            <div class="form-group">
                {{ Form::label('fullname', trans('profile.form.profile.fields.fullname')) }}
                {{ Form::text('fullname', $user->fullname, array('class'=>'form-control', 'placeholder' => trans('profile.form.profile.fields.fullname.default'), 'required' => 'required' )) }}
            </div>

            <div class="form-group">
                {{ Form::label('email_dropdown', trans('profile.form.profile.fields.email')) }}
                {{ Form::hidden('email', $user->email, array('id' => 'email')) }}
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="email_dropdown" data-toggle="dropdown" data-hidden-target="#email">
                        {{ trans('profile.form.profile.fields.email.default') }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="email_dropdown">
                        @foreach($emails as $email)
                            <li class="pull-left">
                                <a tabindex="-1" href="#" data-value="{{ $email->username }}">
                                    {{ $email->username }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('phone', trans('profile.form.profile.fields.phone')) }}
                {{ Form::text('phone', $user->phone, array('class'=>'form-control', 'placeholder' => trans('profile.form.profile.fields.phone.default') )) }}
            </div>

            <div class="form-group">
                {{ Form::label('address', trans('profile.form.profile.fields.address')) }}
                {{ Form::text('address', $user->address, array('class'=>'form-control', 'placeholder' => trans('profile.form.profile.fields.address.default') )) }}
            </div>

            <div class="form-group">
                {{ Form::label('created_at', trans('profile.form.profile.fields.created_at')) }}
                {{ Form::text('created_at', $user->created_at, array('class'=>'form-control', 'readonly' => 'readonly' )) }}
            </div>

            <div class="form-group">
                {{ Form::label('last_authentication', trans('profile.form.profile.fields.last_authentication')) }}
                {{ Form::text('last_authentication', $user->last_authentication, array('class'=>'form-control', 'readonly' => 'readonly' )) }}
            </div>

            {{ Form::submit(trans('profile.form.profile.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

            {{ Form::hidden('_token', csrf_token(), array()) }}
            {{ Form::close() }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="page-header">{{ trans('profile.form.password.title') }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {{ Form::open(array('url' => 'profile/password', 'class' => 'form-signin', 'role' => 'form')) }}
            {{ Form::hidden('user_id', $user->id) }}

            <div class="form-group">
                {{ Form::label('password_old', trans('profile.form.password.fields.password_old')) }}
                {{ Form::password('password_old', array('class' => 'form-control', 'placeholder' => trans('profile.form.password.fields.password_old.default'))) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', trans('profile.form.password.fields.password')) }}
                {{ Form::password('password', array('class'=>'form-control', 'placeholder'=> trans('profile.form.password.fields.password.default'))) }}
            </div>

            <div class="form-group">
                {{ Form::label('password_confirmation', trans('profile.form.password.fields.password_confirmation')) }}
                {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>trans('profile.form.password.fields.password_confirmation.default'))) }}
            </div>

            {{ Form::submit(trans('profile.form.password.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

            {{ Form::hidden('_token', csrf_token(), array()) }}
            {{ Form::close() }}
        </div>
    </div>
@stop
