@extends('template')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
	{{ $message }}
</div>

@endif

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>RSS Feed Urls</b></div>
			<div class="col col-md-6">
				<a href="{{ route('rss_urls.create') }}" class="btn btn-outline-dark float-end">Add</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
				<th>Feed URL</th>
				<th>Action</th>
			</tr>
			@if(count($data) > 0)

				@foreach($data as $row)

					<tr>
						<td>{{ $row->url }}</td>
						<td>
							<form method="post" action="{{ route('rss_urls.destroy', $row->id) }}">
								@csrf
								@method('DELETE')
								<a href="{{ route('rss_urls.show', $row->id) }}" class="btn btn-outline-secondary">View</a>
								<a href="{{ route('rss_urls.edit', $row->id) }}" class="btn  btn-outline-secondary">Edit</a>
								<input type="submit" class="btn btn-danger btn-sm" value="Delete" />
							</form>
							
						</td>
					</tr>

				@endforeach

			@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
			@endif
		</table>
		{!! $data->links() !!}
	</div>
</div>

@endsection
