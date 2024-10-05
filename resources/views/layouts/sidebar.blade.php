<!---sidebar--->
<div class="offcanvas offcanvas-start sidebar-nav mt-3 shadow-lg p-3 bg-body rounded" tabindex="-1"
	id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	<a class="navbar-brand fw-bold text-uppercase text-center bg-gray text-danger" href="{{ route('dashboard') }}">To-Do List App</a>
	<hr class="breadcrumb-divide" />
	<div class="offcanvas-body p-0">
		<div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
			tabindex="0">
			<nav class="navbar">
				<ul class="navbar-nav ms-3 p-2">

					<li class="nav-item active ">
						<a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center">
							<i class="ph-gauge-bold"></i>
							<span class="sidebar-text ms-2 text-dark">Dashboard</span>
						</a>
					</li>
					@if(hasPermission('tasks.index'))
						<li class="nav-item active ">
							<a href="{{ route('tasks.index') }}" class="nav-link d-flex align-items-center">
								<i class="ph-gauge-bold"></i>
								<span class="sidebar-text ms-2 text-dark">Task</span>
							</a>
						</li>
					@endif

					@if(auth()->user()->role->name == \App\Enums\RoleTypeEnum::Admin->value)
						<li class="nav-item active ">
							<a href="{{ route('employees') }}" class="nav-link d-flex align-items-center">
								<i class="ph-gauge-bold"></i>
								<span class="sidebar-text ms-2 text-dark">Employee</span>
							</a>
						</li>
					@endif
				</ul>
			</nav>
		</div>
	</div>
</div>
<!---end sidebar--->