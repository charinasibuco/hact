<div class="fixed">
	<ul class="gn-menu-main">
		<li><a href="#" id="sub-menu"><i class="fi-thumbnails"></i> MAIN</a></li>
		<li><a href="{{ route('home') }}" title="HIV and Aids Core Team"><span id="logo">H</span>ACT</a></li>
		<li></li>
	</ul>
	<div id="admin-menu" class="sub-menu close">
		<div class="row">
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('patient') }}" title="Patient"><i class="fa fa-users" aria-hidden="true"></i><br />PATIENTS</a>
			</div>
			{{--<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('infections') }}" title="Infections"><i class="fa fa-heartbeat"></i><br /> Infections</a>
			</div>--}}
			@if(Auth::user()->access == 2)
				<div class="small-12 medium-4 large-2 columns">
					<a href="{{ route('mortality') }}" title="Mortality Information"><i class="fa fa-bed fa-lg"></i><br> Mortality</a>
				</div>
				<div class="small-12 medium-4 large-2 columns">
					<a href="{{ route('arv') }}" title="Prescription"><i class="fa fa-file-text-o fa-lg"></i><br> Prescription</a>
				</div>
				{{--<div class="small-12 medium-4 large-2 columns">--}}
					{{--<a href="" title="Reports"><i class="fa fa-bar-chart" aria-hidden="true"></i><br />REPORTS</a>--}}
				{{--</div>--}}
			@endif

			@if(Auth::user()->access == 3)
				<div class="small-12 medium-4 large-2 columns">
					<a href="{{ route('lab_requests') }}" title="Checkup Laboratory Requests"><i class="fa fa-ticket fa-lg"></i><br />LAB REQUESTS</a>
				</div>
			@endif

		</div>
	</div>
	<div class="secondary-menu">
		<div class="row">
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">

					</li>
					<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
					<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
				</ul>

				<section class="top-bar-section">
					<ul class="right">
						<li class="has-dropdown">
							<a href="#" title="Reports"><i class="fa fa-file-o fa-lg"></i>  Reports</a>
							<ul class="dropdown">
								<li><a href="{{ route('patient_prescribe') }}" title="Patient"><i class="fa fa-minus-circle fa-lg"></i> Prescription</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
							<a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> SETTINGS</a>
							<ul class="dropdown">
								<li class="active"><a href="{{ route('user_edit', [Auth::user()->id]) }}"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</a></li>
								@if(Auth::user()->access == 1)
									<li><a href="{{ route('user') }}" title="Users"><i class="fa fa-user-md fa-lg"></i> USERS</a></li>
								@endif
							</ul>
						</li>
						<li><a href="{{ route('logout') }}" title="Logout"><i class="fa fa-sign-out fa-lg"></i> LOGOUT</a></li>
					</ul>
				</section>
			</nav>
		</div>
	</div>
</div>

<nav class="top-bar" data-topbar role="navigation" style="margin-bottom: 30px;">
	<ul class="title-area">
		<li class="name">
			<h1><a href="{{ route('home') }}" title="HIV and Aids Core Team">HACT</a></h1>
		</li>
		<li class="toggle-topbar menu-icon">
			<a href="#"><span>Menu</span></a>
		</li>
	</ul>
	<section class="top-bar-section">

		<!-- Right menu -->
		<ul class="right">
			<li>
				<a href="{{ route('logout') }}" title="Logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
			</li>
		</ul>

		<!-- Left menu -->
		<ul class="left">
			<li>
				<a href="{{ route('patient') }}" title="Patient"><i class="fa fa-user fa-lg"></i> Patient</a>
			</li>
			{{--<li>
				<a href="{{ route('infections') }}" title="Infections"><i class="fa fa-heartbeat"></i> Infections</a>
			</li>--}}
			@if(Auth::user()->access == 3)
				<li>
					<a href="{{ route('lab_requests') }}" title="Checkup Laboratory Requests"><i class="fa fa-ticket fa-lg"></i> Lab Requests</a>
				</li>

			@endif
			@if(Auth::user()->access == 2)
				{{--<li>
					<a href="{{ route('checkup') }}" title="Check-up"><i class="fa fa-stethoscope fa-lg"></i> Check-up</a>
					<ul class="dropdown">
						<li>
							<a href="{{ route('checkup_create') }}" title="Add Check-up"><i class="fa fa-plus fa-lg"></i> Add</a>
						</li>
					</ul>
				</li>--}}
				<li>
					<a href="{{ route('arv') }}" title="Prescription"><i class="fa fa-file-text-o fa-lg"></i> Prescription</a>
				</li>
				<li class="has-dropdown">
					<a href="#" title="Prescription"><i class="fa fa-file-o fa-lg"></i>  Reports</a>
					<ul class="dropdown">
						<li>
							<a href="{{ route('patient_prescribe') }}" title="Patient"><i class="fa fa-minus-circle fa-lg"></i> Prescription</a>
						</li>
					</ul>
				</li>
				<li>
				<a href="{{ route('mortality') }}" title="Mortality Information"><i class="fa fa-bed fa-lg"></i> Mortality</a>
			</li>
			@endif

			
		</ul>
	</section>
</nav>
