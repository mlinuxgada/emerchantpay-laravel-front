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
			<div class="col col-md-6"><b>RSS Feed Items</b></div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<tr>
                <th class="w-auto">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="feedUrl">Feed Url</label>
                      </div>
                    <select  class="form-select form-select-sm" name="rss_url_id" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="feedUrl">
                        <option value="{{ route('rss_items.index') }}"> --- </option>
                        @foreach ($data['rss_urls'] as $rss_url)
                            <option value="{{ route('rss_items.index',
                                                    [
                                                        'page' =>  $data['filters']['page'],
                                                        'rss_url_id' => $rss_url->id,
                                                        'title' => $data['filters']['title'],
                                                        'publish_date' => $data['filters']['publish_date'],
                                                    ]) }}" 
                                {{ $rss_url->id == $data['filters']['rss_url_id'] ? "selected" : "" }}>
                                {{ $rss_url->url }}
                            </option>
                        @endforeach
                    </select>
                    </div
                </th>
                <th class="th-lg" style="min-width: 350px;">
                    <form action="{{ route('rss_items.index') }}" method="GET">
                        
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="postTitle">Title</span>
                          </div>                        

                        <input
                            type="text"
                            name="title" onchange="this.form.submit()"
                            value="{{ $data['filters']['title'] }}" 
                            id="postTitle" 
                            class="form-control w-25" 
                        />
                        <input type="hidden" name="page"  value="{{ $data['filters']['page'] }}" />
                        <input type="hidden" name="rss_url_id"  value="{{ $data['filters']['rss_url_id'] }}" />
                        <input type="hidden" name="publish_date"  value="{{ $data['filters']['publish_date'] }}" />

                        </div>

                    </form>
                </th>
				<!-- <th>Link</th> -->
				<th>Description</th>
                <th class="th-lg" style="min-width: 250px;">
                    <form action="{{ route('rss_items.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="postTitle">Date</span>
                            </div>                        

                                    
                            <input
                                type="date"
                                class="form-control"
                                name="publish_date"
                                value="{{ $data['filters']['publish_date'] }}"
                                class="form-control w-25" 
                                onchange="this.form.submit()"
                            />

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                        <input type="hidden" name="page"  value="{{ $data['filters']['page'] }}" />
                        <input type="hidden" name="rss_url_id"  value="{{ $data['filters']['rss_url_id'] }}" />
                        <input type="hidden" name="title"  value="{{ $data['filters']['title'] }}" />

                        </div>
                    </form>
                </th>
			</tr>
			@if(count($data['items']) > 0)

				@foreach($data['items'] as $row)

					<tr>
						<td>{{ $row->source_url }}</td>
                        <td>
                            <a href="{{ $row->link }}" target="_blank">{{ $row->title }}</a>
                        </td>
						<!-- <td>{{ $row->link }}</td> -->
						<td>{{ $row->description }}</td>
						<td>{{ $row->publish_date }}</td>
					</tr>

				@endforeach

			@else
				<tr>
					<td colspan="5" class="text-center">No Data Found</td>
				</tr>
			@endif
		</table>

		{!! $data['items']->links() !!}

	</div>
</div>

@endsection
