@extends('layouts.standard')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('clients.form.create.title') }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

{{ Form::open(array('url' => 'clients/create', 'class' => 'form-create')) }}

@if (!empty($errors->count()))
<div class="row">
	<div class="col-lg-12">
		<ul class="bs-callout bs-callout-danger">
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
</div>
@endif

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<i class="fa fa-phone fa-fw"></i> {{ trans('clients.form.create.category.date') }}
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('lastname', trans('clients.form.create.fields.lastname')) }}
							{{ Form::text('lastname', $client->lastname, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.lastname.default') )) }}
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('firstname', trans('clients.form.create.fields.firstname')) }}
							{{ Form::text('firstname', $client->firstname, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.firstname.default') )) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('email', trans('clients.form.create.fields.email')) }}
							{{ Form::text('email', $client->mail, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.mail.default'))) }}
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('phone', trans('clients.form.create.fields.phone')) }}
							{{ Form::text('phone', $client->phone, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.phone.default'))) }}
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('next_relance', trans('clients.form.create.fields.next_relance')) }}
							<div class='input-group date' data-datepicker="datetime">
								{{ Form::text('next_relance', $client->next_relance, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.next_relance.default'), 'readonly' => 'readonly')) }}
                			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                			    </span>
                			</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Coordonnées -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<i class="fa fa-create fa-fw"></i> {{ trans('clients.form.create.category.address') }}
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{{ Form::label('company', trans('clients.form.create.fields.company')) }}
							{{ Form::text('company', $client->company, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.company.default') )) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1">
						<div class="form-group">
							{{ Form::label('address_number', trans('clients.form.create.fields.address_number')) }}
							{{ Form::text('address_number', $client->address_number, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.address_number.default'))) }}
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							{{ Form::label('address_street', trans('clients.form.create.fields.address_street')) }}
							{{ Form::text('address_street', $client->address_street, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.address_street.default'))) }}
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('mandat', trans('clients.form.create.fields.mandat')) }}
							{{ Form::text('mandat', $client->mandat, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.mandat.default'))) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('address_city', trans('clients.form.create.fields.address_city')) }}
							{{ Form::text('address_city', $client->address_city, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.address_city.default'))) }}
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('address_zipcode', trans('clients.form.create.fields.address_zipcode')) }}
							{{ Form::text('address_zipcode', $client->address_zipcode, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.address_zipcode.default'))) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Client -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<i class="fa fa-users fa-fw"></i> {{ trans('clients.form.create.category.offer') }}
			</div>
			<div class="panel-body">
				<div class="row">


					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('activity_dropdown', trans('clients.form.create.fields.activity')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="activity_dropdown" data-toggle="dropdown">
									{{ trans('clients.form.create.fields.activity.default') }}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="activity_dropdown">
									@foreach ($activities as $activity)
									<li>
										<a tabindex="-1" rel='nofollow'>
											{{ Form::checkbox('activities[]', $activity->id, in_array($activity->id, $selection['activities']  )) }}
											{{ $activity->label }}
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('sector_dropdown', trans('clients.form.create.fields.sector')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="sector_dropdown" data-toggle="dropdown">
									{{ trans('clients.form.create.fields.sector.default') }}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="sector_dropdown">
									@foreach ($sectors as $sector)
									<li>
										<a tabindex="-1" rel='nofollow'>
											{{ Form::checkbox('sectors[]', $sector->id, in_array($sector->id, $selection['sectors']  )) }}
											{{ $sector->label }}
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('state_dropdown', trans('clients.form.create.fields.state')) }}
							{{ Form::hidden('state', $client->state, array('id' => 'state')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#state">
									{{ trans('clients.form.create.fields.state.default') }}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="state_dropdown">
									@foreach($states as $state_label => $state_value)
									<li>
										<a tabindex="-1" data-value="{{ $state_value }}">
											{{ $state_label }}
										</a>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('prix_from', trans('clients.form.create.fields.prix')) }} (min)
							{{ Form::number('prix_from', $client->prix_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.prix.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('prix_to', trans('clients.form.create.fields.prix')) }} (max)
							{{ Form::number('prix_to', $client->prix_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.prix.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('loyer_from', trans('clients.form.create.fields.loyer')) }} (min)
							{{ Form::number('loyer_from', $client->loyer_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.loyer.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('loyer_to', trans('clients.form.create.fields.loyer')) }} (max)
							{{ Form::number('loyer_to', $client->loyer_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.loyer.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('surface_from', trans('clients.form.create.fields.surface')) }} (min)
							{{ Form::number('surface_from', $client->surface_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.surface.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('surface_to', trans('clients.form.create.fields.surface')) }} (max)
							{{ Form::number('surface_to', $client->surface_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.create.fields.surface.default') )) }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Timeline -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-clock-o fa-fw"></i> {{ trans('clients.form.edit.category.timeline') }}
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{{ Form::label('comment', trans('clients.form.edit.fields.comment')) }}
								{{ Form::text('comment', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.comment.default'))) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row pull-right">
	<div class="col-lg-12">
		{{ Form::reset(trans('clients.form.create.reset'), array('class'=>'btn btn-large btn-info'))}}
		{{ Form::submit(trans('clients.form.create.submit'), array('class' => 'btn btn-large btn-primary'))}}
	</div>
</div>

{{ Form::hidden('_token', csrf_token(), array()) }}

{{ Form::close() }}

@stop
