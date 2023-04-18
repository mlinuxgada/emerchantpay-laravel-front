@extends('template')

@section('content')

@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif

<div class="card">
	<div class="card-header">Add RSS Url</div>
	<div class="card-body">
		<form method="post" action="{{ route('rss_urls.store') }}" enctype="multipart/form-data">
			@csrf
			<div class="row mb-3">
				<label class="col-sm-2 col-label-form">Feed Url</label>
				<div class="col-sm-10">
                    <textarea rows="10" name="urls" class="form-control" placeholder="Put rss feed urls, 1 per line" ></textarea>
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-outline-dark" value="Add" />
			</div>	
		</form>
	</div>
</div>

@endsection('content')
