@extends('layouts.standard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ trans('profile.grid.profile.title') }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{ trans('profile.grid.columns.login') }}</th>
                    <th>{{ trans('profile.grid.columns.fullname') }}</th>
                    <th>{{ trans('profile.grid.columns.email') }}</th>
                    <th>{{ trans('profile.grid.columns.admin') }}</th>
                    <th>{{ trans('profile.grid.columns.lock') }}</th>
                    <th>{{ trans('profile.grid.columns.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{{ $user->login }}}</td>
                        <td>{{{ $user->fullname }}}</td>
                        <td>{{{ $user->email }}}</td>

                        <td>
                            @if($user->admin)
                                <a href="/profile/admin?user_id={{ $user->id }}&value=False" class="btn btn-success btn-xs">
                                    True
                                </a>
                            @else
                                <a href="/profile/admin?user_id={{ $user->id }}&value=True" class="btn btn-danger btn-xs">
                                    False
                                </a>
                            @endif
                        </td>

                        <td>
                            @if($user->lock)
                                <a href="/profile/lock?user_id={{ $user->id }}&value=False" class="btn btn-success btn-xs">
                                    True
                                </a>
                            @else
                                <a href="/profile/lock?user_id={{ $user->id }}&value=True" class="btn btn-danger btn-xs">
                                    False
                                </a>
                            @endif
                        </td>

                        <td>
                            <a href="/profile/profile?user_id={{ $user->id }}" class="btn btn-primary" data-toggle="popover" title="{{ trans('profile.grid.actions.edit') }}" data-content="{{ trans('profile.grid.actions.edit.description') }}" data-placement="bottom">
                                <span class="glyphicon glyphicon-cog"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

