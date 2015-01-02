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
							{{ Form::label('birthday', trans('clients.form.edit.fields.birthday')) }}
							<div class='input-group date' data-datepicker="date">
								{{ Form::text('birthday', $client->birthday, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.birthday.default'), 'readonly' => 'readonly')) }}
                			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                			    </span>
                			</div>
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
					<div class="col-md-12">
						<div class="form-group">
							{{ Form::label('address_street', trans('clients.form.edit.fields.address_street')) }}
							{{ Form::text('address_street', $client->address_street, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.address_street.default'))) }}
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
					<div class="col-md-8">
						<div class="form-group">
							{{ Form::label('activity', trans('clients.form.edit.fields.activity')) }}
							{{ Form::text('activity', $client->activity, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.activity.default') )) }}
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
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('prix_dropdown', trans('clients.form.edit.fields.prix')) }}
							{{ Form::hidden('prix_id', $client->prix, array('id' => 'prix_id')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="prix_dropdown" data-toggle="dropdown" data-hidden-target="#prix_id">
									{{ trans('clients.form.edit.fields.prix.default') }}
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
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('loyer_dropdown', trans('clients.form.edit.fields.loyer')) }}
							{{ Form::hidden('loyer_id', $client->loyer, array('id' => 'loyer_id')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="loyer_dropdown" data-toggle="dropdown" data-hidden-target="#loyer_id">
									{{ trans('clients.form.edit.fields.loyer.default') }}
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
					</div>

					<div class="col-md-4">
						<div class="form-group">
							{{ Form::label('surface_dropdown', trans('clients.form.edit.fields.surface')) }}
							{{ Form::hidden('surface_id', $client->surface, array('id' => 'surface_id')) }}
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="surface_dropdown" data-toggle="dropdown" data-hidden-target="#surface_id">
									{{ trans('clients.form.edit.fields.surface.default') }}
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
