<div class="row">
    <div class="col-lg-12">
        <a href="{{ URL::to('clients/create') }}" class="btn btn-info pull-right">
            {{ trans('clients.grid.actions.add') }}
        </a>

        @if ($canExport)
        {{ Form::button(trans('clients.grid.actions.mailing'), array('id' => 'btn-mailing', 'class' => 'btn btn-primary pull-right margin-right-10', 'data-toggle' => 'modal', 'data-target' => '#exampleModal', 'data-check' => URL::to('clients/selection'))) }}

        <button data-toggle="redirect" data-event="click" data-data="#client-search" data-method="POST" data-target="{{ URL::to('clients/export') }}" class="btn btn-default pull-left">
            {{ trans('clients.grid.actions.export') }}
        </button>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-hover table-hover-selection">
            <thead>
            <tr>
                <th width="24">&nbsp;</th>
                <th>{{ trans('clients.grid.columns.state') }}</th>
                <th>{{ trans('clients.grid.columns.lastname') }}</th>
                <th>{{ trans('clients.grid.columns.firstname') }}</th>
                <th>{{ trans('clients.grid.columns.company') }}</th>
                <th>{{ trans('clients.grid.columns.first_comment') }}</th>
                <th>{{ trans('clients.grid.columns.last_comment') }}</th>
                <th>{{ trans('clients.grid.columns.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>
                        {{ Form::checkbox('clients[]', $result->id, FALSE, array('data-click' => 'hidden') ) }}
                    </td>
                    <td class="state-{{{ $result->state }}}">
                        {{{ trans('clients.grid.columns.state.' . $result->state) }}}
                    </td>
                    <td>{{{ $result->lastname }}}</td>
                    <td>{{{ $result->firstname }}}</td>
                    <td>
                        <img src="{{ asset('images/Company.png') }}" alt="{{ trans('clients.grid.columns.company.tooltip') }}" title="{{ trans('clients.grid.columns.company.tooltip') }}" />
                        {{{ $result->company }}}<br />
                        <img src="{{ asset('images/Prix.png') }}" alt="{{ trans('clients.grid.columns.prix.tooltip') }}" title="{{ trans('clients.grid.columns.prix.tooltip') }}" />
                        {{{ $result->prix_from }}} - {{{ $result->prix_to }}}<br />
                        <img src="{{ asset('images/Loyer.png') }}" alt="{{ trans('clients.grid.columns.loyer.tooltip') }}" title="{{ trans('clients.grid.columns.loyer.tooltip') }}" />
                        {{{ $result->loyer_from }}} - {{{ $result->loyer_to }}}<br />
                        <img src="{{ asset('images/Surface.png') }}" alt="{{ trans('clients.grid.columns.surface.tooltip') }}" title="{{ trans('clients.grid.columns.surface.tooltip') }}" />
                        {{{ $result->surface_from }}} - {{{ $result->surface_to }}}
                    </td>
                    <td>{{{ $result->first_comment }}}</td>
                    <td>{{{ $result->last_comment }}}</td>

                    <td>
                        <a href="{{ URL::to('clients/edit') }}?client_id={{ $result->id }}" class="btn btn-primary" data-toggle="popover" title="{{ trans('clients.grid.actions.edit') }}" data-content="{{ trans('clients.grid.actions.edit.description') }}" data-placement="bottom">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>

                        @if (Auth::user()->admin)
                        <a href="{{ URL::to('clients/delete') }}?client_id={{ $result->id }}" class="btn btn-danger" data-toggle="popover" title="{{ trans('clients.grid.actions.delete') }}" data-content="{{ trans('clients.grid.actions.delete.description') }}" data-placement="bottom">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    {{ $results->links() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
 