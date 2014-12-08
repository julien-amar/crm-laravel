@extends('layouts.standard')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="page-header">{{ trans('clients.form.edit.title') }}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-4 col-md-offset-4">
		{{ Form::open(array('url' => 'clients/edit', 'class' => 'form-edit')) }}

		@if (!empty($errors->count()))
		<ul class="bs-callout bs-callout-danger">
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif

		{{ Form::hidden('id', $client->id, array()) }}

		<div class="form-group">
			{{ Form::label('prix_dropdown', trans('clients.form.prix.fields.user')) }}
			{{ Form::hidden('prix_id', $client->prix, array('id' => 'prix_id')) }}
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="prix_dropdown" data-toggle="dropdown" data-hidden-target="#prix_id">
					{{ trans('clients.form.prix.fields.user.default') }}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="prix_dropdown">
					@foreach($prices as $price)
					<li class="pull-left">
						<a tabindex="-1" href="#" data-value="{{ $price }}">
							{{ $price }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('loyer_dropdown', trans('clients.form.loyer.fields.user')) }}
			{{ Form::hidden('loyer_id', $client->loyer, array('id' => 'loyer_id')) }}
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="loyer_dropdown" data-toggle="dropdown" data-hidden-target="#loyer_id">
					{{ trans('clients.form.loyer.fields.user.default') }}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="loyer_dropdown">
					@foreach($rents as $rent)
					<li class="pull-left">
						<a tabindex="-1" href="#" data-value="{{ $rent }}">
							{{ $rent }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('surface_dropdown', trans('clients.form.surface.fields.user')) }}
			{{ Form::hidden('surface_id', $userId, array('id' => 'surface_id')) }}
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="surface_dropdown" data-toggle="dropdown" data-hidden-target="#surface_id">
					{{ trans('clients.form.surface.fields.user.default') }}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="surface_dropdown">
					@foreach($surfaces as $surface)
					<li class="pull-left">
						<a tabindex="-1" href="#" data-value="{{ $surface }}">
							{{ $surface }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('lastname', trans('clients.form.edit.fields.lastname')) }}
			{{ Form::text('lastname', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.lastname.default') )) }}
		</div>

		<div class="form-group">
			{{ Form::label('firstname', trans('clients.form.edit.fields.firstname')) }}
			{{ Form::text('firstname', array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.firstname.default') )) }}
		</div>

		<div class="form-group">
			{{ Form::label('company', trans('clients.form.edit.fields.company')) }}
			{{ Form::text('company', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.company.default') )) }}
		</div>

		<div class="form-group">
			{{ Form::label('activity', trans('clients.form.edit.fields.activity')) }}
			{{ Form::text('activity', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.activity.default') )) }}
		</div>

		<div class="form-group">
			{{ Form::label('phone', trans('clients.form.edit.fields.phone')) }}
			{{ Form::text('phone', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.phone.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('mail', trans('clients.form.edit.fields.mail')) }}
			{{ Form::text('mail', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.mail.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('birthday', trans('clients.form.edit.fields.birthday')) }}
			{{ Form::text('birthday', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.birthday.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('last_relance', trans('clients.form.edit.fields.last_relance')) }}
			{{ Form::text('last_relance', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.last_relance.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('next_relance', trans('clients.form.edit.fields.next_relance')) }}
			{{ Form::text('next_relance', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.next_relance.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('state_dropdown', trans('clients.form.state.fields.user')) }}
			{{ Form::hidden('state_id', $userId, array('id' => 'state_id')) }}
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#state_id">
					{{ trans('clients.form.state.fields.user.default') }}
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="state_dropdown">
					@foreach($states as $state)
					<li class="pull-left">
						<a tabindex="-1" href="#" data-value="{{ $state }}">
							{{ $state }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('address_number', trans('clients.form.edit.fields.address_number')) }}
			{{ Form::text('address_number', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_number.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('address_street', trans('clients.form.edit.fields.address_street')) }}
			{{ Form::text('address_street', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_street.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('address_zipcode', trans('clients.form.edit.fields.address_zipcode')) }}
			{{ Form::text('address_zipcode', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_zipcode.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('address_city', trans('clients.form.edit.fields.address_city')) }}
			{{ Form::text('address_city', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_city.default'))) }}
		</div>

		<div class="form-group">
			{{ Form::label('comment', trans('clients.form.edit.fields.comment')) }}
			{{ Form::text('comment', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.comment.default'))) }}
		</div>
		{{ Form::submit(trans('clients.form.edit.submit'), array('class' => 'btn btn-large btn-primary btn-block'))}}

		{{ Form::hidden('_token', csrf_token(), array()) }}

		{{ Form::close() }}
	</div>
</div>
@stop
