<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Authors</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
	<div class="container bg-light shadow" style="min-height: 100vh;">
		@include('header')
		<div class="border-bottom py-2">
			<h1 class="h4">Authors</h1>
		</div>
		<div>
			@if (session('messages') and isset(session('messages')['error']))
			@foreach(session('messages')['error'] as $em)
			<div class="alert alert-danger">
				{{ $em }}
			</div>
			@endforeach
			@endif
			@if (session('messages') and isset(session('messages')['success']))
			@foreach(session('messages')['success'] as $sm)
			<div class="alert alert-success">
				{{ $sm }}
			</div>
			@endforeach
			@endif
		</div>
		<div class="pt-2 d-flex justify-content-between">
			<div>
				@if( !empty($pagination) )
				<nav aria-label="...">
					<ul class="pagination">
						<li class="page-item @if( $pagination['previous_page'] == '' ){{ 'disabled' }} @endif">
							<a class="page-link" href="{{ $pagination['previous_page'] }}">Previous</a>
						</li>
						<li class="page-item active" aria-current="page">
							<a class="page-link">{{$authors['current_page']}}</a>
						</li>
						<li class="page-item @if( $pagination['next_page'] == '' ){{ 'disabled' }} @endif">
							<a class="page-link" href="{{ $pagination['next_page'] }}">Next</a>
						</li>
					</ul>
				</nav>
				@endif
			</div>
			<div>
				<form method="get" action="authors">
					<div class="input-group mb-3">
						<input type="search" name="query" class="form-control" placeholder="" aria-label=""
							aria-describedby="button-addon2">
						<button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Action</td>
							<td>Id</td>
							<td>First Name</td>
							<td>Last Name</td>
							<td>Birthday</td>
							<td>Gender</td>
							<td>Place Of Birth</td>
						</tr>
					</thead>
					<tbody>

						@foreach($authors['items'] as $item)
						<tr>
							<td>
								<a href="author/{{ $item['id'] }}" class="btn btn-sm btn-info">Detail</a>
							</td>
							<td>{{ $item['id'] }}</td>
							<td>{{ $item['first_name'] }}</td>
							<td>{{ $item['last_name'] }}</td>
							<td>{{ date('m/d/Y', strtotime($item['birthday'])) }}</td>
							<td>{{ $item['gender'] }}</td>
							<td>{{ $item['place_of_birth'] }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
	</script>
</body>

</html>