@extends('layouts.standard')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('clients.form.edit.title') }}</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

{{ Form::open(array('url' => 'clients/edit', 'class' => 'form-edit')) }}

{{ Form::hidden('id', $client->id, array()) }}

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
				<i class="fa fa-phone fa-fw"></i> {{ trans('clients.form.edit.category.date') }}
			</div>
			<div class="panel-body">

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('lastname', trans('clients.form.edit.fields.lastname')) }}
							{{ Form::text('lastname', $client->lastname, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.lastname.default') )) }}
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('firstname', trans('clients.form.edit.fields.firstname')) }}
							{{ Form::text('firstname', $client->firstname, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.firstname.default') )) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('email', trans('clients.form.edit.fields.email')) }}
							{{ Form::text('email', $client->mail, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.mail.default'))) }}
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('phone', trans('clients.form.edit.fields.phone')) }}
							{{ Form::text('phone', $client->phone, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.phone.default'))) }}
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('last_relance', trans('clients.form.edit.fields.last_relance')) }}
							<div class='input-group date' data-datepicker="datetime">
								{{ Form::text('last_relance', $client->last_relance, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.last_relance.default'), 'readonly' => 'readonly')) }}
                			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                			    </span>
                			</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('next_relance', trans('clients.form.edit.fields.next_relance')) }}
							<div class='input-group date' data-datepicker="datetime">
								{{ Form::text('next_relance', $client->next_relance, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.next_relance.default'), 'readonly' => 'readonly')) }}
                			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                			    </span>
                			</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('creation_date', trans('clients.form.edit.fields.creation_date')) }}
							{{ Form::text('creation_date', $client->created_at, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.creation_date.default'), 'readonly' => 'readonly')) }}
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('update_date', trans('clients.form.edit.fields.update_date')) }}
							{{ Form::text('update_date', $client->updated_at, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.update_date.default'), 'readonly' => 'readonly')) }}
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
				<i class="fa fa-edit fa-fw"></i> {{ trans('clients.form.edit.category.address') }}
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{{ Form::label('company', trans('clients.form.edit.fields.company')) }}
							{{ Form::text('company', $client->company, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.company.default') )) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-1">
						<div class="form-group">
							{{ Form::label('address_number', trans('clients.form.edit.fields.address_number')) }}
							{{ Form::text('address_number', $client->address_number, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_number.default'))) }}
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							{{ Form::label('address_street', trans('clients.form.edit.fields.address_street')) }}
							{{ Form::text('address_street', $client->address_street, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_street.default'))) }}
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('mandat', trans('clients.form.edit.fields.mandat')) }}
							{{ Form::text('mandat', $client->mandat, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.mandat.default'))) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('address_city', trans('clients.form.edit.fields.address_city')) }}
							{{ Form::text('address_city', $client->address_city, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_city.default'))) }}
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{ Form::label('address_zipcode', trans('clients.form.edit.fields.address_zipcode')) }}
							{{ Form::text('address_zipcode', $client->address_zipcode, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_zipcode.default'))) }}
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
				<i class="fa fa-users fa-fw"></i> {{ trans('clients.form.edit.category.offer') }}
			</div>
			<div class="panel-body">
				<div class="row">


					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('activity_dropdown', trans('clients.form.edit.fields.activity')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown">
									{{ trans('clients.form.edit.fields.activity.default') }}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="state_dropdown">
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
							{{ Form::label('activity_dropdown', trans('clients.form.edit.fields.sector')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown">
									{{ trans('clients.form.edit.fields.sector.default') }}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="state_dropdown">
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
							{{ Form::label('state_dropdown', trans('clients.form.edit.fields.state')) }}
							{{ Form::hidden('state_id', $client->state, array('id' => 'state_id')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#state_id">
									{{ trans('clients.form.edit.fields.state.default') }}
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
							{{ Form::label('prix_from', trans('clients.form.edit.fields.prix')) }} (min)
							{{ Form::number('prix_from', $client->prix_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.prix.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('prix_to', trans('clients.form.edit.fields.prix')) }} (max)
							{{ Form::number('prix_to', $client->prix_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.prix.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('loyer_from', trans('clients.form.edit.fields.loyer')) }} (min)
							{{ Form::number('loyer_from', $client->loyer_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.loyer.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('loyer_to', trans('clients.form.edit.fields.loyer')) }} (max)
							{{ Form::number('loyer_to', $client->loyer_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.loyer.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('surface_from', trans('clients.form.edit.fields.surface')) }} (min)
							{{ Form::number('surface_from', $client->surface_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.surface.default') )) }}
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('surface_to', trans('clients.form.edit.fields.surface')) }} (max)
							{{ Form::number('surface_to', $client->surface_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.surface.default') )) }}
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
					<div class="col-md-12">
						<ul class="timeline">
							<li>
								<div class="timeline-badge"><i class="fa fa-check"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
										<p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
										</p>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
									</div>
								</div>
							</li>
							<li class="timeline-inverted">
								<div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge danger"><i class="fa fa-bomb"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
									</div>
								</div>
							</li>
							<li class="timeline-inverted">
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge info"><i class="fa fa-save"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
										<hr>
										<div class="btn-group">
											<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-gear"></i> <span class="caret"></span>
											</button>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Action</a>
												</li>
												<li><a href="#">Another action</a>
												</li>
												<li><a href="#">Something else here</a>
												</li>
												<li class="divider"></li>
												<li><a href="#">Separated link</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
									</div>
								</div>
							</li>
							<li class="timeline-inverted">
								<div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
								</div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
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
		{{ Form::reset(trans('clients.form.edit.reset'), array('class'=>'btn btn-large btn-info'))}}
		{{ Form::submit(trans('clients.form.edit.submit'), array('class' => 'btn btn-large btn-primary'))}}
	</div>
</div>

{{ Form::hidden('_token', csrf_token(), array()) }}

{{ Form::close() }}

@stop
