@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ trans('clients.form.search.title') }}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
	<div class="col-lg-12">
		{{ Form::open(array('url' => 'clients/search', 'id' => 'client-quick-search', 'class' => 'form-search', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::label('search', trans('clients.form.search.fields.search')) }}

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
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		{{ HTML::link('clients/create', trans('clients.grid.actions.add'), array('class' => 'btn btn-info pull-right')) }}
	</div>
</div>

<div id="client-result">
</div>
@stop

@section('sidebar')
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
		{{ Form::open(array('url' => 'clients/search', 'id' => 'client-search', 'class' => 'form-search', 'role' => 'form')) }}
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-phone fa-fw"></i> {{ trans('clients.form.advanced-search.category.date') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
					<li>
						{{ Form::label('lastname', trans('clients.form.advanced-search.fields.lastname')) }}
						{{ Form::text('lastname', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.lastname.default') )) }}
					</li>

					<li>
						{{ Form::label('firstname', trans('clients.form.advanced-search.fields.firstname')) }}
						{{ Form::text('firstname', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.firstname.default') )) }}
					</li>

					<li>
						{{ Form::label('email', trans('clients.form.advanced-search.fields.email')) }}
						{{ Form::text('email', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.email.default') )) }}
					</li>

					<li>
						{{ Form::label('phone', trans('clients.form.advanced-search.fields.phone')) }}
						{{ Form::text('phone', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.phone.default') )) }}
					</li>

					<li>
						{{ Form::label('last-call', trans('clients.form.advanced-search.fields.last-call')) }}<br />
						From :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('last-call-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.last-call.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
						To :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('last-call-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.last-call.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
					</li>

					<li>
						{{ Form::label('next-call', trans('clients.form.advanced-search.fields.next-call')) }}<br />
						From :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('next-call-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.next-call.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
						To :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('next-call-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.next-call.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
					</li>

					<li>
						{{ Form::label('creation-date', trans('clients.form.advanced-search.fields.creation-date')) }}<br />
						From :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('creation-date-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.creation-date.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
						To :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('creation-date-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.creation-date.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
					</li>

					<li>
						{{ Form::label('update-date', trans('clients.form.advanced-search.fields.update-date')) }}<br />
						From :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('update-date-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.update-date.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
						To :
						<div class='input-group date' data-datepicker="datetime">
							{{ Form::text('update-date-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.update-date.default'), 'readonly' => 'readonly' )) }}
            			    <span class="input-group-addon">
            			    	<span class="glyphicon glyphicon-calendar datepickerbutton"></span>
            			    </span>
            			    <span class="input-group-addon"><span class="glyphicon glyphicon-remove datepickerclear"></span>
							</span>
            			</div>
					</li>

					<li>
						{{ Form::label('comment', trans('clients.form.advanced-search.fields.comment')) }}
						{{ Form::textarea('comment', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.comment.default') )) }}
					</li>
				</ul>
			</li>
			<li>
                <a href="#"><i class="fa fa-edit fa-fw"></i> {{ trans('clients.form.advanced-search.category.address') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
					<li>
						{{ Form::label('company', trans('clients.form.advanced-search.fields.company')) }}
						{{ Form::text('company', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.company.default') )) }}
					</li>

					<li>
						{{ Form::label('number', trans('clients.form.advanced-search.fields.number')) }}
						{{ Form::text('number', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.number.default') )) }}
					</li>

					<li>
						{{ Form::label('street', trans('clients.form.advanced-search.fields.street')) }}
						{{ Form::text('street', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.street.default') )) }}
					</li>

					<li>
						{{ Form::label('city', trans('clients.form.advanced-search.fields.city')) }}
						{{ Form::text('city', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.city.default') )) }}
					</li>

					<li>
						{{ Form::label('zip-code', trans('clients.form.advanced-search.fields.zip-code')) }}
						{{ Form::text('zip-code', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.zip-code.default') )) }}
					</li>

					<li>
						{{ Form::label('mandat', trans('clients.form.advanced-search.fields.mandat')) }}
						{{ Form::text('mandat', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.mandat.default') )) }}
					</li>
				</ul>
			</li>

			<li>
                <a href="#"><i class="fa fa-users fa-fw"></i> {{ trans('clients.form.advanced-search.category.offer') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
					@if(Auth::user()->admin)
					<li>
						{{ Form::label('user_dropdown', trans('clients.form.advanced-search.fields.user')) }}
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="user_dropdown" data-toggle="dropdown">
								{{ trans('clients.form.advanced-search.fields.user.default') }}
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="user_dropdown">
								@foreach($users as $user)
								<li>
									<a tabindex="-1"  rel='nofollow'>
										{{ Form::checkbox('users[]', $user->id, FALSE) }}
										{{ $user->fullname }} <i>({{ $user->login }})</i>
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</li>
					@endif

					<li>
						{{ Form::label('activity_dropdown', trans('clients.form.advanced-search.fields.activity')) }}
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="activity_dropdown" data-toggle="dropdown">
								{{ trans('clients.form.advanced-search.fields.activity.default') }}
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="activity_dropdown">
								@foreach($activities as $activity)
								<li>
									<a tabindex="-1"  rel='nofollow'>
										{{ Form::checkbox('activities[]', $activity->id, FALSE) }}
										{{ $activity->label }}
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</li>

					<li>
						{{ Form::label('sector_dropdown', trans('clients.form.advanced-search.fields.sector')) }}
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="sector_dropdown" data-toggle="dropdown">
								{{ trans('clients.form.advanced-search.fields.sector.default') }}
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="sector_dropdown">
								@foreach($sectors as $sector)
								<li>
									<a tabindex="-1"  rel='nofollow'>
										{{ Form::checkbox('sectors[]', $sector->id, FALSE) }}
										{{ $sector->label }}
									</a>
								</li>
								@endforeach
							</ul>
						</div>
					</li>

					<li>
						{{ Form::label('price', trans('clients.form.advanced-search.fields.price')) }}<br />
						From :
						{{ Form::number('price-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.price.default') )) }}
						To :
						{{ Form::number('price-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.price.default') )) }}
					</li>

					<li>
						{{ Form::label('rent', trans('clients.form.advanced-search.fields.rent')) }}<br />
						From :
						{{ Form::number('rent-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.rent.default') )) }}
						To :
						{{ Form::number('rent-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.rent.default') )) }}
					</li>

					<li>
						{{ Form::label('surface', trans('clients.form.advanced-search.fields.surface')) }}<br />
						From :
						{{ Form::number('surface-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.surface.default') )) }}
						To :
						{{ Form::number('surface-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.surface.default') )) }}
					</li>
							

					<li>
						{{ Form::label('state', trans('clients.form.advanced-search.fields.state')) }}
						{{ Form::hidden('state', null, array('id' => 'state')) }}

						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#state">
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
					</li>
				</ul>
			</li>

			<li class="form-group pull-right">
				{{ Form::reset(trans('clients.form.advanced-search.reset'), array('class'=>'btn btn-large btn-info'))}}
				{{ Form::submit(trans('clients.form.advanced-search.submit'), array('class'=>'btn btn-large btn-primary'))}}
				
				{{ Form::hidden('_token', csrf_token(), array()) }}
			</li>
        </ul>
		{{ Form::close() }}
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
@stop

@section('script')
<script type="text/javascript">

$(document).ready(function() {
	var lastSubmitedForm = undefined;
	var searchUrl = $('#client-search').attr('action');

	function onSubmitSearch(event) {
		processSubmitSearch(event, event.target, searchUrl);

		lastSubmitedForm = event.target;
	}

	function processSubmitSearch(event, form, url) {
		
		event.preventDefault();

		dataString = $(form).serialize();

        $.ajax({
	        type: "GET",
	        url: url,
	        data: dataString
        })
        .done(function(data) {
                $("#client-result").html(data);
		})
		.fail(function(request, error) {
                $("#client-result").html(data);
		});
	}

	$('#client-search').submit(onSubmitSearch);
	$('#client-quick-search').submit(onSubmitSearch);

	$('#client-result').on('click', '.pagination li a', function (event) {
		processSubmitSearch(event, lastSubmitedForm, this.href);
	});
});

</script>
@stop
