@extends('template')

@section('content')

<div class="card">
	<div class="card-header">Edit RSS Feed</div>
	<div class="card-body">
		<form method="post" action="{{ route('rss_urls.update', $rssUrl->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Feed Url</label>
				<div class="col-sm-10">
					<input type="text" name="url" class="form-control" value="{{ $rssUrl->url }}" />
				</div>
			</div>
			<div class="text-center">
				<input type="hidden" name="hidden_id" value="{{ $rssUrl->id }}" />
				<input type="submit" class="btn btn-primary" value="Edit" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')

