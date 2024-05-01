<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('front.includes.head')
</head>
<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	@include('front.includes.notification')
	<!-- Header -->
	@include('front.includes.header')
	<!--/ End Header -->
	@yield('content')

	@include('front.includes.footer')

</body>
</html>
