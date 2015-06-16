@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('clients.form.edit.title') }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    {{ Form::open(array('url' => 'clients/edit?client_id=' . $client->id, 'class' => 'form-edit')) }}

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

    @if(Session::get('user.original')->admin)
    <!-- Administration -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o fa-fw"></i> {{ trans('clients.form.edit.category.admin') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('user_dropdown', trans('clients.form.edit.fields.user')) }}
                                {{ Form::hidden('user_id', $client->user_id, array('id' => 'user_id')) }}
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="user_dropdown" data-toggle="dropdown" data-hidden-target="#user_id">
                                        {{ trans('clients.form.edit.fields.user.default') }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="user_dropdown">
                                        @foreach($users as $user)
                                            <li>
                                                <a tabindex="-1" data-value="{{ $user->id }}">
                                                    {{ $user->fullname }} <i>({{ $user->login }})</i>
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
                                    <button class="btn btn-default dropdown-toggle" type="button" id="activity_dropdown" data-toggle="dropdown">
                                        {{ trans('clients.form.edit.fields.activity.default') }}
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
                                {{ Form::label('sector_dropdown', trans('clients.form.edit.fields.sector')) }}
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="sector_dropdown" data-toggle="dropdown">
                                        {{ trans('clients.form.edit.fields.sector.default') }}
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
                                {{ Form::label('state_dropdown', trans('clients.form.edit.fields.state')) }}
                                {{ Form::hidden('state', $client->state, array('id' => 'state')) }}
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown" data-hidden-target="#state" data-colorize="true">
                                        {{ trans('clients.form.edit.fields.state.default') }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="state_dropdown">
                                        @foreach($states as $state_value)
                                            <li>
                                                <a tabindex="-1" data-value="{{ $state_value }}">
                                                    {{ trans('clients.form.edit.fields.state.' . $state_value) }}
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

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('informations', trans('clients.form.edit.fields.informations')) }}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::checkbox('terrace', '1', $client->terrace) }}
                                {{ trans('clients.form.edit.fields.informations.terrace') }}
                                <br/>
                                {{ Form::checkbox('extraction', '1', $client->extraction) }}
                                {{ trans('clients.form.edit.fields.informations.extraction') }}
                                <br/>
                                {{ Form::checkbox('apartment', '1', $client->apartment) }}
                                {{ trans('clients.form.edit.fields.informations.apartment') }}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('license', trans('clients.form.edit.fields.license')) }}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::checkbox('licenseII', '1', $client->licenseII) }}
                                {{ trans('clients.form.edit.fields.license.licenseII') }}
                                <br/>
                                {{ Form::checkbox('licenseIII', '1', $client->licenseIII) }}
                                {{ trans('clients.form.edit.fields.license.licenseIII') }}
                                <br/>
                                {{ Form::checkbox('licenseIV', '1', $client->licenseIV) }}
                                {{ trans('clients.form.edit.fields.license.licenseIV') }}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('surface_sell_from', trans('clients.form.edit.fields.surface_sell')) }} (min)
                                {{ Form::number('surface_sell_from', $client->surface_sell_from, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.surface_sell.default') )) }}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('surface_sell_to', trans('clients.form.edit.fields.surface_sell')) }} (max)
                                {{ Form::number('surface_sell_to', $client->surface_sell_to, array('class'=>'form-control', 'placeholder' => trans('clients.form.edit.fields.surface_sell.default') )) }}
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
                                @foreach($comments as $index => $comment)

                                    @if ($index % 2 == 0)
                                        <li>
                                    @else
                                        <li class="timeline-inverted">
                                            @endif


                                            @if ($comment['type'] == 'History')
                                                <div class="timeline-badge info"><i class="fa fa-save"></i>
                                                </div>
                                            @elseif ($comment['state'] == 'Todo')
                                                <div class="timeline-badge"><i class="fa fa-pause"></i>
                                                </div>
                                            @elseif ($comment['state'] == 'InProgress')
                                                <div class="timeline-badge warning"><i class="fa fa-gear"></i>
                                                </div>
                                            @elseif ($comment['state'] == 'Success')
                                                <div class="timeline-badge success"><i class="fa fa-check"></i>
                                                </div>
                                            @elseif ($comment['state'] == 'Error')
                                                <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                                </div>
                                            @endif

                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">{{ trans('clients.form.edit.fields.comment') }}</h4>
                                                    <p>
                                                        <small class="text-muted">
                                                            <i class="fa fa-clock-o"></i>
                                                            <i class="relative-time">{{ $comment['created_at'] }}</i>
                                                            <i> by </i>
                                                            <i>{{ $comment['user_fullname'] }}</i>
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>{{ $comment['message'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
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

    <div class="row row-footer">
        <div class="col-lg-4">
            {{ HTML::link('clients/delete?client_id=' . $client->id, trans('clients.form.edit.delete'), array('class' => 'btn btn-large btn-danger'))}}
        </div>
        <div class="col-lg-8 text-right">
            {{ Form::reset(trans('clients.form.edit.reset'), array('class'=>'btn btn-large btn-info'))}}
            {{ Form::submit(trans('clients.form.edit.submit'), array('class' => 'btn btn-large btn-primary'))}}
        </div>
    </div>

    {{ Form::hidden('_token', csrf_token(), array()) }}

    {{ Form::close() }}

@stop

@section('script')
    {{ HTML::script('js/clients/edit.js') }}
@stop
