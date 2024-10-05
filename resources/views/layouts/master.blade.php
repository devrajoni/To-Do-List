<!DOCTYPE html>
<html>
	<head>
		@include('layouts.head')
	</head>
	<body>
		@include('layouts.header')

		@include('layouts.sidebar')

		<div class="main mt-3 rounded">
			<div style="min-height: calc(100vh - 155px);">
					@yield('content')
			</div>
		</div>
		@include('layouts.script')
	</body>
</html>