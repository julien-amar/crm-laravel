@extends('layouts.standard')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>{{ trans('import.form.result.title') }}</h1>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-lg-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('import.grid.columns.firstname') }}</th>
					<th>{{ trans('import.grid.columns.lastname') }}</th>
					<th>{{ trans('import.grid.columns.company') }}</th>
					<th>{{ trans('import.grid.columns.errors') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($results as $result)
				<tr>
					<td>{{{ $result['client']->lastname }}}</td>
					<td>{{{ $result['client']->firstname }}}</td>
					<td>
						{{{ $result['client']->company }}}
						{{{ $result['client']->prix_from }}}
						{{{ $result['client']->prix_to }}}
						{{{ $result['client']->loyer_from }}}
						{{{ $result['client']->loyer_to }}}
						{{{ $result['client']->surface_from }}}
						{{{ $result['client']->surface_to }}}
					</td>
					<td>
						@if (count($result['errors']) > 0)
						<ul class="bs-callout bs-callout-danger">
						@foreach ($result['errors'] as $error)
							<li>{{{ $error }}}</li>
						@endforeach
						</ul>
						@endif
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop
