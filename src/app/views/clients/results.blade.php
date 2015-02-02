<div class="row">
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('clients.grid.columns.lastname') }}</th>
					<th>{{ trans('clients.grid.columns.firstname') }}</th>
					<th>{{ trans('clients.grid.columns.company') }}</th>
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
						{{{ $result->prix_from }}}
						{{{ $result->prix_to }}}
						{{{ $result->loyer_from }}}
						{{{ $result->loyer_to }}}
						{{{ $result->surface_from }}}
						{{{ $result->surface_to }}}
					</td>

					<td>
						<a href="/clients/edit?client_id={{ $result->id }}" class="btn btn-primary" data-toggle="popover" title="{{ trans('clients.grid.actions.edit') }}" data-content="{{ trans('clients.grid.actions.edit.description') }}" data-placement="bottom">
							<span class="glyphicon glyphicon-cog"></span>
						</a>
						<a href="/clients/delete?client_id={{ $result->id }}" class="btn btn-danger" data-toggle="popover" title="{{ trans('clients.grid.actions.delete') }}" data-content="{{ trans('clients.grid.actions.delete.description') }}" data-placement="bottom">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
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
