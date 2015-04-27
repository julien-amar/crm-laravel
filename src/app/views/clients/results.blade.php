<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-hover table-hover-selection">
            <thead>
            <tr>
                <th width="24">&nbsp;</th>
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
                @if ($result->state == 'Buyer')
                <tr class="info">
                @else
                <tr class="warning">
                @endif
                    <td>
                        {{ Form::checkbox('clients[]', $result->id, FALSE, array('data-click' => 'hidden') ) }}
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
                        <a href="/clients/edit?client_id={{ $result->id }}" class="btn btn-primary" data-toggle="popover" title="{{ trans('clients.grid.actions.edit') }}" data-content="{{ trans('clients.grid.actions.edit.description') }}" data-placement="bottom">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>

                        @if (Auth::user()->admin)
                        <a href="/clients/delete?client_id={{ $result->id }}" class="btn btn-danger" data-toggle="popover" title="{{ trans('clients.grid.actions.delete') }}" data-content="{{ trans('clients.grid.actions.delete.description') }}" data-placement="bottom">
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
 