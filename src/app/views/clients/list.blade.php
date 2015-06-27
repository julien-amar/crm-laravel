@extends('layouts.main')

@section('content')

    @include('layouts.errors')

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

    <div id="client-result">
    </div>

@stop

@section('modals')

    @include('mailings.create')

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

                        <li>
                            {{ Form::label('with-mandat', trans('clients.form.advanced-search.fields.with-mandat')) }}
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="with-mandat_dropdown" data-toggle="dropdown">
                                    {{ trans('clients.form.advanced-search.fields.with-mandat.default') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="activity_dropdown">
                                    <li>
                                        <a tabindex="-1"  rel='nofollow'>
                                            {{ Form::checkbox('with-mandat[]', '1', FALSE) }}
                                            {{ trans('clients.form.advanced-search.fields.with-mandat.yes') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  rel='nofollow'>
                                            {{ Form::checkbox('with-mandat[]', '0', FALSE) }}
                                            {{ trans('clients.form.advanced-search.fields.with-mandat.no') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
                            {{ Form::label('surface-sell', trans('clients.form.advanced-search.fields.surface-sell')) }}<br />
                            From :
                            {{ Form::number('surface-sell-from', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.surface-sell.default') )) }}
                            To :
                            {{ Form::number('surface-sell-to', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.surface-sell.default') )) }}
                        </li>

                        <li>
                            {{ Form::label('state', trans('clients.form.advanced-search.fields.informations.terrace')) }}<br />
                            {{ Form::hidden('terrace', null, array('id' => 'terrace')) }}

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="terrace_dropdown" data-toggle="dropdown" data-hidden-target="#terrace">
                                    {{ trans('clients.form.advanced-search.fields.informations.terrace') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="terrace_dropdown">
                                    <li>
                                        <a tabindex="-1" data-value="">
                                            {{ trans('clients.form.advanced-search.fields.informations.terrace.all') }}
                                        </a>
                                        <a tabindex="-1" data-value="1">
                                            {{ trans('clients.form.advanced-search.fields.informations.terrace.with') }}
                                        </a>
                                        <a tabindex="-1" data-value="0">
                                            {{ trans('clients.form.advanced-search.fields.informations.terrace.without') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br />


                            {{ Form::label('state', trans('clients.form.advanced-search.fields.informations.extraction')) }}<br />
                            {{ Form::hidden('extraction', null, array('id' => 'extraction')) }}

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="extraction_dropdown" data-toggle="dropdown" data-hidden-target="#extraction">
                                    {{ trans('clients.form.advanced-search.fields.informations.extraction') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="extraction_dropdown">
                                    <li>
                                        <a tabindex="-1" data-value="">
                                            {{ trans('clients.form.advanced-search.fields.informations.extraction.all') }}
                                        </a>
                                        <a tabindex="-1" data-value="1">
                                            {{ trans('clients.form.advanced-search.fields.informations.extraction.with') }}
                                        </a>
                                        <a tabindex="-1" data-value="0">
                                            {{ trans('clients.form.advanced-search.fields.informations.extraction.without') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br />

                            {{ Form::label('state', trans('clients.form.advanced-search.fields.informations.apartment')) }}<br />
                            {{ Form::hidden('apartment', null, array('id' => 'apartment')) }}

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="apartment_dropdown" data-toggle="dropdown" data-hidden-target="#apartment">
                                    {{ trans('clients.form.advanced-search.fields.informations.apartment') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="apartment_dropdown">
                                    <li>
                                        <a tabindex="-1" data-value="">
                                            {{ trans('clients.form.advanced-search.fields.informations.apartment.all') }}
                                        </a>
                                        <a tabindex="-1" data-value="1">
                                            {{ trans('clients.form.advanced-search.fields.informations.apartment.with') }}
                                        </a>
                                        <a tabindex="-1" data-value="0">
                                            {{ trans('clients.form.advanced-search.fields.informations.apartment.without') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <br />
                        </li>

                        <li>
                            {{ Form::label('license', trans('clients.form.advanced-search.fields.license')) }}<br />
                            
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="sector_dropdown" data-toggle="dropdown">
                                    {{ trans('clients.form.advanced-search.fields.license.default') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="sector_dropdown">
                                    <li>
                                        <a tabindex="-1"  rel='nofollow'>
                                            {{ Form::checkbox('licenseII', '1', FALSE) }}
                                            {{ trans('clients.form.advanced-search.fields.license.licenseII') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  rel='nofollow'>
                                            {{ Form::checkbox('licenseIII', '1', FALSE) }}
                                            {{ trans('clients.form.advanced-search.fields.license.licenseIII') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  rel='nofollow'>
                                            {{ Form::checkbox('licenseIV', '1', FALSE) }}
                                            {{ trans('clients.form.advanced-search.fields.license.licenseIV') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('state', trans('clients.form.advanced-search.fields.state')) }}

                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="state_dropdown" data-toggle="dropdown">
                                    {{ trans('clients.form.advanced-search.fields.state.default') }}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="state_dropdown">
                                    @foreach($states as $state_value)
                                        <li>
                                            <a tabindex="-1"  rel='nofollow'>
                                                {{ Form::checkbox('state[]', $state_value, FALSE) }}
                                                {{ trans('clients.form.advanced-search.fields.state.' . $state_value) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-envelope-o fa-fw"></i> {{ trans('clients.form.advanced-search.category.mailing') }}<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            {{ Form::label('subject', trans('clients.form.advanced-search.fields.subject')) }}
                            {{ Form::text('subject', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.subject.default') )) }}
                        </li>

                        <li>
                            {{ Form::label('reference', trans('clients.form.advanced-search.fields.reference')) }}
                            {{ Form::text('reference', null, array('class'=>'form-control', 'placeholder' => trans('clients.form.advanced-search.fields.reference.default') )) }}
                        </li>
                    </ul>
                </li>

                <li class="form-group pull-right margin-10">
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
    {{ HTML::script('js/clients/list.js') }}
    
    <script>
    $(document).ready(function() {
        tinymce.init({
            selector: "#message",
            language: 'fr_FR',
            statusbar: false
        });
    });
    </script>
@stop
