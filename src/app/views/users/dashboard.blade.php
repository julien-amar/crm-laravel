@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('users.dashboard.title') }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($clientWithoutComments) }}</div>
                            <div>{{ trans('users.dashboard.alerts.client-without-comments') }}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            <a href="#" data-toggle="modal" data-target="#client-without-comments-modal">
                                {{ trans('users.dashboard.alerts.view-more') }}
                            </a>
                        </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($clientWithoutMailings) }}</div>
                            <div>{{ trans('users.dashboard.alerts.client-without-mailing') }}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            <a href="#" data-toggle="modal" data-target="#client-without-mailing-modal">
                                {{ trans('users.dashboard.alerts.view-more') }}
                            </a>
                        </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($activeBuyers) }}</div>
                            <div>{{ trans('users.dashboard.alerts.active-buyers') }}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            <a href="#" data-toggle="modal" data-target="#active-buyers-modal">
                                {{ trans('users.dashboard.alerts.view-more') }}
                            </a>
                        </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($activeSellers) }}</div>
                            <div>{{ trans('users.dashboard.alerts.active-sellers') }}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            <a href="#" data-toggle="modal" data-target="#active-sellers-modal">
                                {{ trans('users.dashboard.alerts.view-more') }}
                            </a>
                        </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

@stop

@section('modals')

<div class="modal fade" id="client-without-comments-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('users.dashboard.modal.client-without-comments.title') }}</h4>
      </div>
      <div class="modal-body">
        @if (count($clientWithoutComments) == 0)
            {{ trans('users.dashboard.modal.no-result') }}
        @else
         <ul>
           @foreach($clientWithoutComments as $result)
            <li>
                <a href="{{ URL::to('clients/edit') }}?client_id={{ $result->id }}" target="_blank">
                    <span class="glyphicon glyphicon-user"></span>
                    {{ $result->firstname }}, {{ $result->lastname }} ({{ $result->last_comment }})
                </a>
            </li>
           @endforeach
        </ul>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="client-without-mailing-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('users.dashboard.modal.client-without-mailing.title') }}</h4>
      </div>
      <div class="modal-body">
        @if (count($clientWithoutMailings) == 0)
            {{ trans('users.dashboard.modal.no-result') }}
        @else
         <ul>
           @foreach($clientWithoutMailings as $result)
            <li>
                <a href="{{ URL::to('clients/edit') }}?client_id={{ $result->id }}" target="_blank">
                    <span class="glyphicon glyphicon-user"></span>
                    {{ $result->firstname }}, {{ $result->lastname }} ({{ $result->last_comment }})
                </a>
            </li>
           @endforeach
        </ul>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="active-buyers-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('users.dashboard.modal.active-buyers.title') }}</h4>
      </div>
      <div class="modal-body">
        @if (count($activeBuyers) == 0)
            {{ trans('users.dashboard.modal.no-result') }}
        @else
         <ul>
           @foreach($activeBuyers as $result)
            <li>
                <a href="{{ URL::to('clients/edit') }}?client_id={{ $result->id }}" target="_blank">
                    <span class="glyphicon glyphicon-user"></span>
                    {{ $result->firstname }}, {{ $result->lastname }} 
                </a>
            </li>
           @endforeach
        </ul>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="active-sellers-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('users.dashboard.modal.active-sellers.title') }}</h4>
      </div>
      <div class="modal-body">
        @if (count($activeSellers) == 0)
            {{ trans('users.dashboard.modal.no-result') }}
        @else
         <ul>
           @foreach($activeSellers as $result)
            <li>
                <a href="{{ URL::to('clients/edit') }}?client_id={{ $result->id }}" target="_blank">
                    <span class="glyphicon glyphicon-user"></span>
                    {{ $result->firstname }}, {{ $result->lastname }} 
                </a>
            </li>
           @endforeach
        </ul>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop
