<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>New Book</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
	<div class="container bg-light shadow" style="min-height: 100vh;">
		@include('header')
		<div class="border-bottom py-2">
			<h1 class="h4">New Book</h1>
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
		<div class="rounded-3 border p-4 bg-light mx-auto" style="max-width: 100%;">
			<form action="{{ url('/book/store') }}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<select class="form-control" name="author" id="author" placeholder="author" required>
								@foreach($authors['items'] as $author)
								<option value="{{$author['id']}}">{{$author['first_name'] . ' ' . $author['last_name']}}
								</option>
								@endforeach
							</select>
							<label for="author" class="ps-4">Author</label>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<input type="text" class="form-control" name="title" id="title" placeholder="title"
								required>
							<label for="title" class="ps-4">Title</label>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<input type="date" class="form-control" name="release_date" id="release_date"
								placeholder="release_date" required>
							<label for="release_date" class="ps-4">Release Date</label>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<input type="text" class="form-control" name="isbn" id="isbn" placeholder="isbn" required>
							<label for="isbn" class="ps-4">ISBN</label>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<input type="text" class="form-control" name="format" id="format" placeholder="format"
								required>
							<label for="format" class="ps-4">Format</label>
						</div>
					</div>

					<div class="col-md-4 mb-3">
						<div class="form-floating col-12">
							<input type="number" min="1" step="1" class="form-control" name="number_of_pages"
								id="number_of_pages" placeholder="number_of_pages" required>
							<label for="number_of_pages" class="ps-4">Number Of Pages</label>
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="form-floating col-12">
						<textarea class="form-control" name="description" id="description" placeholder="description"
							required></textarea>
						<label for="description" class="ps-4">Description</label>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary w-auto">Create</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
	</script>
</body>

</html>