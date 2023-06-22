<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the apple mobile web app capable -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!-- set the HandheldFriendly -->
	<meta name="HandheldFriendly" content="True">
	<!-- set the apple mobile web app status bar style -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- set the description -->
	<meta name="description" content="App Landing Page">
	<!-- set the Keyword -->
	<meta name="keywords" content="app, app landing, clean, landing, landing page, marketing, marketing landing, product, product landing, responsive, seo, startup landing ">
	<meta name="author" content="Vue Laboratories">
	<title>ServiTecnico</title>
    <!-- include the site stylesheet -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7COswald:400,700" rel="stylesheet">   
    

    
	<!-- include the site stylesheet -->
	@yield('head')
	<link rel="stylesheet" href="{{ asset( 'assets/css/bootstrap.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/css/plugins.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/css/font-awesome.min.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/style.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/css/colors.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/css/responsive.css')}}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset( 'assets/css/gridgum.css')}}">
	<style class="color_css"></style>
	
    
</head>
<body>
    <div id="wrapper">
    <header id="header">
        <div class="container">
            <div class="holder center-block">
                <!-- Logo of the page -->
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset( 'assets/images/logo22.png')}}" alt="Mono" class="light img-responsive width" >
                        <img src="{{ asset( 'assets/images/logoDark.png')}}" alt="mono" class="dark img-responsive width" >
                    </a>
                </div>
                <!-- Logo of the page end -->
                <!-- Navbar of the page -->
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    {{-- <a href="#" class="btn btn-default btn-white">Try Demo</a> --}}
                    @if (Route::has('login'))
                        
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-default btn-white"">Dashboard</a>
                            @else
                                {{-- @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-default btn-white" >Register</a>  
                                @endif --}}
                                <a href="{{ route('login') }}" class="btn btn-default btn-white" >Log in</a>
                                
                            @endauth
                        
                    @endif
                   
                    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/') }}" {{-- data-scroll-nav="0" --}}>INICIO</a></li>
                            
                            <li><a href="#" {{-- data-scroll-nav="2" --}}>SOBRE</a></li>
                            <li><a href="#" {{-- data-scroll-nav="3" --}}>Video Block</a></li>
                            <li><a href="#" {{-- data-scroll-nav="4" --}}></a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Navbar of the page end -->
            </div>
        </div>
    </header>
    <!-- Main of the page -->
    <main id="main">
        <!-- Hero area of the page -->
        <section class="hero-area text-center overlay" style="background-image: url(assets/images/camarografo.png);" data-scroll-index="0">
            <div id="particles-js"></div>
				<div class="container">
					<div class="row">
						<header class="heading-holder col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
							{{-- <h1><span class="text-small"></span>IMPORTADORA ONLIBO!</h1> --}}
							<div class="aligncenter">
								<img src="{{ asset( 'assets/images/logo22.png')}}" alt= "image description m-top" class="img-responsive">
							</div>
							<p></p>
						</header>
					</div>

				</div>    
        </section>
        @yield('main')
		<section class="features-area container" data-scroll-index="1">
			<div class="row">
				<header class="col-xs-12 heading-wrap col-sm-6 col-sm-offset-3 text-center">
					<h2>ENCUENTRA TU EVENTO Y ADQUIERE TUS FOTOGRAFIAS.</h2>
				</header>
			</div>
			<!-- Features of the page -->
			<ul class="features-list">
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/speech-bubble.png')}}" width="54" height="52" alt="icon id-card" class="img-responsive">
					</div>
					<h3><a href="#">Best CRM System</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/time-left.png')}}" width="56" height="50" alt="icon clock" class="img-responsive">
					</div>
					<h3><a href="#">Time Tracking</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/download.png')}}" width="51" height="45" alt="icon notes" class="img-responsive">
					</div>
					<h3><a href="#">Download easily</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/line-chart.png')}}" width="52" height="60" alt="icon calculator" class="img-responsive">
					</div>
					<h3><a href="#">Financial Charts</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/medal.png')}}" width="52" height="60" alt="icon cleaning" class="img-responsive">
					</div>
					<h3><a href="#">Badges for customer</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
				<li>
					<div class="icon-holder">
						<img src="{{ asset( 'assets/images/calendar.png')}}" width="49" height="51" alt="icon calandar" class="img-responsive">
					</div>
					<h3><a href="#">Daily Calendar</a></h3>
					<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore.</p>
				</li>
			</ul>
			<!-- Features of the page end -->
		</section>
		<!-- Features area of the page end -->
		<!-- Demo block of the page -->
		{{-- <aside class="demo-block">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-7">
						<h2>NEED A PERFECT PRODUCT FOR YOUR BUSINESS?</h2>
						<p>Nam feugiat enim diam, sed bibendum diam gravida ac. Ut urna urna, blandit viverra luctus et, vulputate vitae ligula. Duis commodo vitae massa quis maximus.</p>
					</div>
					<div class="col-xs-12 col-md-5">
						<ul>
							<li><a href="#" class="btn btn-default btn-white">Purchase now</a></li>
							<li><a href="#">Try our Demo</a></li>
						</ul>
					</div>
				</div>
			</div>
		</aside>
		<!-- Demo block of the page end -->
		<!-- Product Features of the page -->
		<section class="container product-features" data-scroll-index="2">
			<div class="row sameheight-container">
				<!-- Descr of the page -->
				<div class="col-xs-12 col-sm-6 descr sameheight">
					<div class="align">
						<h2>Quisque aliquam felis et sapien vulputate ut imperdiet.</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac nisi eget ligula ultricies porta. Integer in sapien non felis scelerisque elementum.
							<br>Aliquam scelerisque eros sit amet eleifend rhoncus. Morbi ut imperdiet mi, a dictum nisl. Nulla facilisi. Pellentesque rhoncus mattis lacus eget efficitur.
							<br>Donec pretium, mauris in auctor posuere, ante ipsum tincidunt urna,
							gravida molestie dolor tellus eget nunc. Nullam vestibulum lorem sit amet quam suscipit mollis a eget enim.
						<br><br> Quisque aliquam felis et sapien vulputate, nec scelerisque neque commodo. Quisque in dui turpis. Aliquam nec luctus orci, eget auctor felis.</p>
						<ul class="facts-list">
							<li>
								<h3><span class="counter">295</span><span class="text-block">Components</span></h3>
							</li>
							<li>
								<h3><span class="counter">323</span>+<span class="text-block">Themes</span></h3>
							</li>
							<li>
								<h3>Unlimited<span class="text-block">users</span></h3>
							</li>
						</ul>
					</div>
				</div>
				<!-- Descr of the page end -->
				<!-- img holder of the page -->
				<div class="img-holder sameheight col-xs-12 col-sm-6">
					<img src="{{ asset( 'assets/images/imac.png')}}" alt="image description" class="img-responsive">
				</div>
				<!-- img holder of the page end -->
			</div>
		</section> --}}
		<!-- Product Features of the page end -->
		<!-- Video block of the page -->
		{{-- <aside class="video-block" data-scroll-index="3">
			<div class="video overlay">
				<img src="{{ asset( 'assets/images/2600-430.jpg')}}" alt="image description" class="img-responsive">
				<a href="https://www.youtube.com/watch?v=XjDh_5ZH9wQ?autoplay=1" class="ico-play lightbox fancybox.iframe"></a>
			</div>
		</aside> --}}
		<!-- Video block of the page end -->


		<!-- Trial block of the page -->
		{{-- <section class="trial-block container" data-scroll-index="4">
			<div class="row">
				<div class="alignleft">
					<img src="{{ asset( 'assets/images/665.jpg')}}" alt="image description" class="img-responsive">
				</div>
				<div class="col-xs-12 col-sm-6 descr">
					<div class="align">
						<header class="heading-wrap">
							<h2>Nam feugiat enim diam, sed bibendum diam gravida ac!</h2>
						</header>
						<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
						<a href="#" class="btn btn-info">Try our demo</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Trial block of the page end -->
		<!-- Brands area of the page -->
		<aside class="brands-area container">
			<div class="row">
				<header class="col-xs-12 heading-wrap col-sm-6 col-sm-offset-3 text-center">
					<h2>OUR PARTNERS</h2>
				</header>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- Logos list of the page -->
					<ul class="list-unstyled line-slider">
						<li><a href="#"><img src="{{ asset( 'assets/images/partner06.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner04.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner05.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner06.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner04.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner05.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner06.png')}}" alt="image description" class="img-responsive"></a></li>
						<li><a href="#"><img src="{{ asset( 'assets/images/partner04.png')}}" alt="image description" class="img-responsive"></a></li>
					</ul>
					<!-- Logos list of the page end -->
				</div>
			</div>
		</aside> --}}
    
    </main>
    @yield('content')
	<footer id="footer">
		<!-- Aside of the page -->
		<aside class="aside">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center col-sm-6 col-sm-offset-3">
						<div class="logo"><a href="#"><img src="{{ asset( 'assets/images/logo22.png')}}" alt="mono"></a></div>
						<p></p>
						<!-- Social Networks of the page -->
						<ul class="social-networks">
							<li><a href="#"><span class="icon ico-facebook"></span></a></li>
							<li><a href="#"><span class="icon ico-twitter"></span></a></li>
							<li><a href="#"><span class="icon ico-google-plus"></span></a></li>
							<li><a href="#"><span class="icon ico-pinterest"></span></a></li>
							<li><a href="#"><span class="icon ico-icon1"></span></a></li>
						</ul>
						<!-- Social Networks of the page end -->
					</div>
				</div>
			</div>
		</aside>
		<!-- Aside of the page end -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-sm-offset-4 text-center">
					<p>&copy; Copyright 2022, <a class="white" href="https://www.uagrm.edu.bo/">UAGRM</a>. <br>All Rights Reserved</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer of the page end -->
	<!-- Back Top of the page -->
	<span id="back-top" class="fa fa-angle-up"></span>
	<div id="loader" class="loader-holder">
		<div class="block"><img src="{{asset( 'assets/images/svg/hearts.svg')}}" width="100" alt="loader"></div>
	</div>
<!-- Wrapper of the page end -->
<!-- include jQuery -->
<script src="{{ asset( 'assets/js/jquery.js')}}"></script>
<!-- include jQuery -->
<script src="{{ asset( 'assets/js/plugins.js')}}"></script>
<!-- include jQuery -->
<script src="{{ asset( 'assets/js/jquery.main.js')}}"></script>
<!-- include jQuery -->
<script src="{{ asset( 'assets/js/particles.js')}}"></script>



{{-- <div id="style-changer" data-src="style-changer.html"></div>
    </div> --}}
</body>
</html>
{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg viewBox="0 0 651 192" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 sm:h-20">
                        <g clip-path="url(#clip0)" fill="#EF3B2D">
                            <path d="M248.032 44.676h-16.466v100.23h47.394v-14.748h-30.928V44.676zM337.091 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.431 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162-.001 2.863-.479 5.584-1.432 8.161zM463.954 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.432 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162 0 2.863-.479 5.584-1.432 8.161zM650.772 44.676h-15.606v100.23h15.606V44.676zM365.013 144.906h15.607V93.538h26.776V78.182h-42.383v66.724zM542.133 78.182l-19.616 51.096-19.616-51.096h-15.808l25.617 66.724h19.614l25.617-66.724h-15.808zM591.98 76.466c-19.112 0-34.239 15.706-34.239 35.079 0 21.416 14.641 35.079 36.239 35.079 12.088 0 19.806-4.622 29.234-14.688l-10.544-8.158c-.006.008-7.958 10.449-19.832 10.449-13.802 0-19.612-11.127-19.612-16.884h51.777c2.72-22.043-11.772-40.877-33.023-40.877zm-18.713 29.28c.12-1.284 1.917-16.884 18.589-16.884 16.671 0 18.697 15.598 18.813 16.884h-37.402zM184.068 43.892c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002-35.648-20.524a2.971 2.971 0 00-2.964 0l-35.647 20.522-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v38.979l-29.706 17.103V24.493a3 3 0 00-.103-.776c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002L40.098 1.396a2.971 2.971 0 00-2.964 0L1.487 21.919l-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v122.09c0 1.063.568 2.044 1.489 2.575l71.293 41.045c.156.089.324.143.49.202.078.028.15.074.23.095a2.98 2.98 0 001.524 0c.069-.018.132-.059.2-.083.176-.061.354-.119.519-.214l71.293-41.045a2.971 2.971 0 001.489-2.575v-38.979l34.158-19.666a2.971 2.971 0 001.489-2.575V44.666a3.075 3.075 0 00-.106-.774zM74.255 143.167l-29.648-16.779 31.136-17.926.001-.001 34.164-19.669 29.674 17.084-21.772 12.428-43.555 24.863zm68.329-76.259v33.841l-12.475-7.182-17.231-9.92V49.806l12.475 7.182 17.231 9.92zm2.97-39.335l29.693 17.095-29.693 17.095-29.693-17.095 29.693-17.095zM54.06 114.089l-12.475 7.182V46.733l17.231-9.92 12.475-7.182v74.537l-17.231 9.921zM38.614 7.398l29.693 17.095-29.693 17.095L8.921 24.493 38.614 7.398zM5.938 29.632l12.475 7.182 17.231 9.92v79.676l.001.005-.001.006c0 .114.032.221.045.333.017.146.021.294.059.434l.002.007c.032.117.094.222.14.334.051.124.088.255.156.371a.036.036 0 00.004.009c.061.105.149.191.222.288.081.105.149.22.244.314l.008.01c.084.083.19.142.284.215.106.083.202.178.32.247l.013.005.011.008 34.139 19.321v34.175L5.939 144.867V29.632h-.001zm136.646 115.235l-65.352 37.625V148.31l48.399-27.628 16.953-9.677v33.862zm35.646-61.22l-29.706 17.102V66.908l17.231-9.92 12.475-7.182v33.841z"/>
                        </g>
                    </svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
 --}}