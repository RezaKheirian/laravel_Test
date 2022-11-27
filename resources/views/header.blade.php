<div class="row">
	<nav class="navbar navbar-expand-lg bg-light shadow">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{url('/profile') }}">Navbar</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
				aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="{{url('/') }}" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/authors') }}">authors</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/book') }}">New Book</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{url('/logout') }}">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>