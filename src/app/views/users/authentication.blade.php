<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>{{ trans('users.form.authenticate.title') }}</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('url' => 'users/impersonate', 'class' => 'form-signin', 'role' => 'form')) }}

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

		{{ Form::submit(trans('users.form.authenticate.submit'), array('class' => 'btn btn-large btn-primary btn-block')) }}

		{{ Form::hidden('_token', csrf_token(), array()) }}
		{{ Form::close() }}
	</div>
</div>
