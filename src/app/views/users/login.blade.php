<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>{{ trans('users.form.login.title') }}</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin', 'role'=>'form')) }}
        <div class="form-group">
            {{ Form::label('login', trans('users.form.login.fields.login')) }}
            {{ Form::text('login', null, array('class'=>'form-control', 'placeholder' => trans('users.form.login.fields.login.default'), 'required' => 'required' )) }}
        </div>

        <div class="form-group">
            {{ Form::label('password', trans('users.form.login.fields.password')) }}
            {{ Form::password('password', array('class'=>'form-control', 'placeholder' => trans('users.form.login.fields.password.default'), 'required' => 'required' )) }}
        </div>

        {{ Form::submit(trans('users.form.login.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

        {{ Form::hidden('_token', csrf_token(), array()) }}
        {{ Form::close() }}
    </div>
</div>
