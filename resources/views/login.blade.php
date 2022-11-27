<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
	<div class=" container-fluid d-flex vh-100 align-items-center">
		<div class="rounded-3 border p-4 bg-light mx-auto" style="width: 400px; max-width: 100%;">
			<form action="login" method="POST">
				@csrf
				<div class="row mb-5">
					<div class="col-12 d-flex justify-content-between align-items-center">
						<h1 class="h5">Login</h1>
					</div>
				</div>
				@if (session('status') and session('status')['error'])
				@foreach(session('status')['error'] as $em)
				<div class="alert alert-danger">
					{{ $em }}
				</div>
				@endforeach
				@endif
				<div class="row mb-3">
					<div class="form-floating col-12">
						<input type="email" class="form-control" name="email" id="email" placeholder="email" required>
						<label for="email" class="ps-4">EMail</label>
					</div>
				</div>
				<div class="row mb-3">
					<div class="form-floating col-12">
						<input type="password" class="form-control" name="password" id="password" placeholder="password"
							required>
						<label for="password" class="ps-4">Password</label>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<button type="submit" class="btn btn-primary w-100">Login</button>
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