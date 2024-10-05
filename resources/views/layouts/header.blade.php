<!---navbar--->
<nav class="navbar navbar-expand-lg navbar-light mt-2">
	<div class="container-fluid">

		<!---offcanvas trigger--->
		<button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas"
			data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!---end offcanvas trigger--->

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse  d-flex justify-content-end text-light" id="navbarSupportedContent">
			<ul class="navbar-nav mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
						data-bs-toggle="dropdown" aria-expanded="false">
						<i class="ph-user-bold fs-3"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<li class="text-light">
							<form action="{{ route('logout') }}" method="POST">
								@csrf
								<button class="dropdown-item">Logout</button>
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!---end navbar--->