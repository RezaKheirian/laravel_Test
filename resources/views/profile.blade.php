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
			<h1 class="h4">Profile</h1>
		</div>
		<div class="pt-2">
			<ul>
				<li>Id: {{$user['id']}}</li>
				<li>First Name: {{$user['first_name']}}</li>
				<li>Last Name: {{$user['last_name']}}</li>
				<li>Email: {{$user['email']}}</li>
				<li>Gender: {{$user['gender']}}</li>
				<li>Active: {{$user['active']}}</li>
				<li>Email Confirmed: {{$user['email_confirmed']}}</li>
			</ul>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
	</script>
</body>

</html>