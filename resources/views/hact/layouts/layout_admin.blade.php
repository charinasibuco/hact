<!DOCTYPE html>
<html>
    @include('hact.layouts.admin_header')
    <body class="fadeIn animated">
		<div class="container">
			@if(Auth::user()->access == 1)
				@include('hact.layouts.admin_menu')
			@else
				@include('hact.layouts.doctor_menu')
			@endif
			{{--@if(Auth::user())--}}
				{{--@if(Auth::user()->access == 1)--}}
					{{--@include('hact.layouts.admin_menu')--}}
				{{--@else--}}
					{{--@include('hact.layouts.doctor_menu')--}}
				{{--@endif--}}
			{{--@endif--}}
			<div class="content-body">
				@yield('content')

			</div>
			{{--<div class="row">--}}
				{{--<div class="small-12 columns" role="content">--}}
					{{--@yield('content')--}}
				{{--</div>--}}
			{{--</div>--}}

			@include('hact.layouts.admin_footer')
		</div>
    </body>
</html>