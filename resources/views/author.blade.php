<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Author</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
	<div class="container bg-light shadow" style="min-height: 100vh;">
		@include('header')
		<div class="border-bottom py-2 d-flex justify-content-between">
			<h1 class="h4">{{ $author['first_name'] . ' ' . $author['last_name'] }}</h1>
			@if(empty($author['books']))
			<a href="{{$author['id']}}/delete" onclick="return confirm('Are you sure delete author?')"
				class="btn btn-danger btn-sm">Delete</a>
			@endif
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
		<div class="pt-2">
			<ul>
				<li>First Name: {{$author['first_name']}}</li>
				<li>Last Name: {{$author['last_name']}}</li>
				<li>Birthday: {{ date('m/d/Y', strtotime($author['birthday'])) }}</li>
				<li>Biography: {{$author['biography']}}</li>
				<li>Gender: {{$author['gender']}}</li>
				<li>Place Of Birth: {{$author['place_of_birth']}}</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-12">
				<h3 class="h5">Books</h3>
			</div>
			<div class="col-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<td>Action</td>
							<td>Id</td>
							<td>Title</td>
							<td>Release Date</td>
							<td>ISBN</td>
							<td>Format</td>
							<td>Number Of Pages</td>
							<td>Description</td>
						</tr>
					</thead>
					<tbody>

						@foreach($author['books'] as $book)
						<tr>
							<td>
								<a href="{{url('/book/' . $book['id'] . '/delete')}}" class="btn btn-sm btn-danger"
									onclick="return confirm('Are you sure delete book?')">Delete</a>
							</td>
							<td>{{ $book['id'] }}</td>
							<td>{{ $book['title'] }}</td>
							<td>{{ date('m/d/Y', strtotime($book['release_date'])) }}</td>
							<td>{{ $book['isbn'] }}</td>
							<td>{{ $book['format'] }}</td>
							<td>{{ $book['number_of_pages'] }}</td>
							<td>{{ $book['description'] }}</td>
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