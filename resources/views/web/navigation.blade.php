<nav class="navbar navbar-default navbar-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('login_page')}}"><img src="{{ asset('frontend/images/hact_logo.png') }}" alt="hact logo"></a>
		</div>

		<div class="collapse navbar-collapse" id="main-navigation">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ route('login_page')}}">home</a></li>
				<li><a href="{{ route('hiv_test')}}">test</a></li>
				<li><a href="{{ route('about_hiv')}}">learn more about HIV</a></li>
				<li><a href="{{ route('login_page')}}#contact-form">contact us</a></li>
				@if(!Auth::check())
					<li><a @if(Request::route() && Request::route()->getName() == 'login_page') href="{{ route('login_page')}}"  data-toggle="modal" data-target="#myModal" @else href="{{ route('login_page')}}#login" @endif>login</a></li>
				@else
					<li><a href="{{ route('home')}}#" id="navbar-login">Portal</a></li>
				@endif
			</ul>
		</div>
	</div>
</nav>