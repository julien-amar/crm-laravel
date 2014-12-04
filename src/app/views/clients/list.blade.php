<div class="page-header">
	<h1>{{ trans('clients.form.search.title') }}</h1>
</div>

{{ Form::open(array('url' => 'client/search', 'class' => 'form-search', 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('search', trans('clients.form.search.fields.search')) }}

	<span class="pull-right">
		{{ HTML::link('#advanced-search', trans('clients.form.search.fields.advanced-search'), array( 'data-toggle' => 'dropdown' )) }} 
	</span>

	<div class="input-group">
		{{ Form::text('search', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.search.fields.search.default') )) }}
		<span class="input-group-btn">
			<button type="submit" class="btn">
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</button>
		</span>
	</div>
</div>

{{ Form::hidden('_token', csrf_token(), array()) }}
{{ Form::close() }}

<div class="progress">
	<div class="progress-bar progress-bar-success progress-bar-striped" style="width: 70%">
		<span class="sr-only">70% Complete (success)</span>
	</div>
	<div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%">
		<span class="sr-only">20% Complete (warning)</span>
	</div>
	<div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 10%">
		<span class="sr-only">10% Complete (danger)</span>
	</div>
</div>

<div class="row">
	{{ Form::open(array('url' => 'client/search', 'class' => 'form-search', 'role' => 'form')) }}
	<div class="col-lg-3">
		<div class="form-group">
			{{ Form::label('birthday', trans('clients.form.advanced-search.fields.birthday')) }}
			From :
			{{ Form::text('birthday', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.birthday.default'), 'required' => 'required' )) }}
			To :
			{{ Form::text('birthday', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.birthday.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('last-call', trans('clients.form.advanced-search.fields.last-call')) }}
			From :
			{{ Form::text('last-call', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.last-call.default'), 'required' => 'required' )) }}
			To :
			{{ Form::text('last-call', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.last-call.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('next-call', trans('clients.form.advanced-search.fields.next-call')) }}
			From :
			{{ Form::text('next-call', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.next-call.default'), 'required' => 'required' )) }}
			To :
			{{ Form::text('next-call', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.next-call.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('creation-date', trans('clients.form.advanced-search.fields.creation-date')) }}
			From :
			{{ Form::text('creation-date', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.creation-date.default'), 'required' => 'required' )) }}
			To :
			{{ Form::text('creation-date', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.creation-date.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('update-date', trans('clients.form.advanced-search.fields.update-date')) }}
			From :
			{{ Form::text('update-date', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.update-date.default'), 'required' => 'required' )) }}
			To :
			{{ Form::text('update-date', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.update-date.default'), 'required' => 'required' )) }}
		</div>
	</div>
	<div class="col-lg-3">

		<div class="form-group">
			{{ Form::label('street', trans('clients.form.advanced-search.fields.street')) }}
			{{ Form::text('street', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.street.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('firstname', trans('clients.form.advanced-search.fields.firstname')) }}
			{{ Form::text('firstname', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.firstname.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('lastname', trans('clients.form.advanced-search.fields.lastname')) }}
			{{ Form::text('lastname', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.lastname.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('email', trans('clients.form.advanced-search.fields.email')) }}
			{{ Form::text('email', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.email.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('phone', trans('clients.form.advanced-search.fields.phone')) }}
			{{ Form::text('phone', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.phone.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('city', trans('clients.form.advanced-search.fields.city')) }}
			{{ Form::text('city', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.city.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('zip-code', trans('clients.form.advanced-search.fields.zip-code')) }}
			{{ Form::text('zip-code', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.zip-code.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('company', trans('clients.form.advanced-search.fields.company')) }}
			{{ Form::text('company', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.company.default'), 'required' => 'required' )) }}
		</div>
	</div>
	<div class="col-lg-2" >


		<div class="form-group">
			{{ Form::label('state', trans('clients.form.advanced-search.fields.state')) }}
			{{ Form::text('state', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.state.default'), 'required' => 'required' )) }}
		</div>

	</div>
	<div class="col-lg-2" >

		<div class="form-group">
			{{ Form::label('comment', trans('clients.form.advanced-search.fields.comment')) }}
			{{ Form::text('comment', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.comment.default'), 'required' => 'required' )) }}
		</div>
	</div>

	<div class="col-lg-2" >
		<div class="form-group">
			{{ Form::label('user', trans('clients.form.advanced-search.fields.user')) }}
			{{ Form::text('user', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.user.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('activity', trans('clients.form.advanced-search.fields.activity')) }}
			{{ Form::text('activity', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.activity.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('price', trans('clients.form.advanced-search.fields.price')) }}
			{{ Form::text('price', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.price.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('rent', trans('clients.form.advanced-search.fields.rent')) }}
			{{ Form::text('rent', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.rent.default'), 'required' => 'required' )) }}
		</div>

		<div class="form-group">
			{{ Form::label('surface', trans('clients.form.advanced-search.fields.surface')) }}
			{{ Form::text('surface', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.surface.default'), 'required' => 'required' )) }}
		</div>

	</div>

</div>
<div class="row">
	<div class="pull-right">
		{{ Form::reset(trans('clients.form.advanced-search.reset'), array('class'=>'btn btn-large btn-info'))}}
		{{ Form::submit(trans('clients.form.advanced-search.submit'), array('class'=>'btn btn-large btn-primary'))}}
		{{ Form::hidden('_token', csrf_token(), array()) }}
	</div>
</div>

{{ Form::close() }}

<div class="row">
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('clients.grid.columns.lastname') }}</th>
					<th>{{ trans('clients.grid.columns.firstname') }}</th>
					<th>{{ trans('clients.grid.columns.company') }}</th>
					<th>{{ trans('clients.grid.columns.activity') }}</th>
					<th>{{ trans('clients.grid.columns.comment') }}</th>
					<th>{{ trans('clients.grid.columns.action') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($results as $result)
				<tr>
					<td>{{{ $result->lastname }}}</td>
					<td>{{{ $result->firstname }}}</td>
					<td>
						{{{ $result->company }}}
						{{{ $result->prix }}}
						{{{ $result->loyer }}}
						{{{ $result->surface }}}
					</td>
					<td>{{{ $result->activity }}}</td>
					<td>{{{ $result->comment }}}</td>

					<td>
						<a href="/clients/edit?client_id={{ $result->id }}" class="btn btn-primary" data-toggle="popover" title="{{ trans('clients.grid.actions.edit') }}" data-content="{{ trans('clients.grid.actions.edit.description') }}" data-placement="bottom">
							<span class="glyphicon glyphicon-cog"></span>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
