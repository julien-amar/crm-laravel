<div class="page-header">
    <h1>{{ trans('users.form.register.title') }}</h1>
</div>

{{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}

@if (!empty($errors->count()))
    <ul class="bs-callout bs-callout-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

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

    {{ Form::submit(trans('users.form.register.submit'), array('class'=>'btn btn-large btn-primary btn-block'))}}

    {{ Form::hidden('_token', csrf_token(), array()) }}

{{ Form::close() }}
