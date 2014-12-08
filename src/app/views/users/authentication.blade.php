@extends('layouts.modal')

@section('content')
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('users.form.authenticate.title') }}</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'users/impersonate', 'role' => 'form')) }}
                            <fieldset>
                            	<div class="form-group">
									{{ Form::label('authenticate_dropdown', trans('users.form.authenticate.fields.user')) }}
									{{ Form::hidden('authenticate_id', $userId, array('id' => 'authenticate_id')) }}
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="authenticate_dropdown" data-toggle="dropdown" data-hidden-target="#authenticate_id">
											{{ trans('users.form.authenticate.fields.user.default') }}
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="authenticate_dropdown">
											@foreach($users as $user)
											<li class="pull-left">
												<a tabindex="-1" href="#" data-value="{{ $user->id }}">
													{{ $user->fullname }} <i>({{ $user->login }})</i>
												</a>
											</li>
											@endforeach
										</ul>
									</div>
								</div>

								{{ Form::submit(trans('users.form.authenticate.submit'), array('class' => 'btn btn-lg btn-success btn-block')) }}

								{{ Form::hidden('_token', csrf_token(), array()) }}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
@stop
