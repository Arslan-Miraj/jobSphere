<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>JobSphere | Find Best Jobs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">JobSphere</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
						</li>	
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="{{ route('jobs') }}">Find Jobs</a>
						</li>										
					</ul>		
					
					@if (!Auth::check())
					<a class="btn btn-outline-primary me-2" href="{{ route('login') }}" type="submit">Login</a>
						@else
					<a class="btn btn-outline-primary me-2" href="{{ route('profile') }}" type="submit">My Account</a>
					@endif
					
					<a class="btn btn-primary" href="{{ route('create_post_job') }}" type="submit">Post a Job</a>
				</div>
			</div>
		</nav>
	</header>

	@yield('main')
		  
	<footer class="bg-dark py-3 bg-2">
		<div class="container">
			<p class="text-center text-white pt-3 fw-bold fs-6">© 2025 TetraObject, All Rights Reserved.</p>
		</div>
	</footer> 
	<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
	<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
	<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	@yield('customJS')
</body>
</html>