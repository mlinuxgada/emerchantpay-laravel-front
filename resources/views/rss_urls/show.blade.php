@extends('template')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>RSS Feed Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('rss_urls.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Feed Url</b></label>
			<div class="col-sm-10">
				{{ $rssUrl->url }}
			</div>
	</div>
</div>

@endsection('content')
