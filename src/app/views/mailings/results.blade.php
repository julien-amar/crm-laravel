<div class="row">
	<div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('mailings.grid.columns.client') }}</th>
					<th>{{ trans('mailings.grid.columns.email') }}</th>
					<th>{{ trans('mailings.grid.columns.state') }}</th>
					<th>{{ trans('mailings.grid.columns.date') }}</th>
					<th>{{ trans('mailings.grid.columns.action') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($results as $result)
				<tr>
					<td>
						{{{ $result->firstname }}}
						{{{ $result->lastname }}}
					</td>
					<td>{{{ $result->mail }}}</td>
					<td>{{{ $result->state }}}</td>
					<td>{{{ $result->created_at }}}</td>

					<td>
						@if ($result->state == 'Error')
						<a href="/mailings/retry?mailing_id={{ $result->id }}" class="btn btn-info" data-toggle="popover" title="{{ trans('mailings.grid.actions.retry') }}" data-content="{{ trans('mailings.grid.actions.retry.description') }}" data-placement="bottom">
							<span class="glyphicon glyphicon-refresh"></span>
						</a>

						<a href="/mailings/delete?mailing_id={{ $result->id }}" class="btn btn-danger" data-toggle="popover" title="{{ trans('mailings.grid.actions.delete') }}" data-content="{{ trans('mailings.grid.actions.delete.description') }}" data-placement="bottom">
							<span class="glyphicon glyphicon-close"></span>
						</a>
						@else
							&nbsp;
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
