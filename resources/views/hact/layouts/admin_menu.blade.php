<div class="fixed">
	<ul class="gn-menu-main">
		<li><a href="#" id="sub-menu"><i class="fi-thumbnails"></i> MAIN</a></li>
		<li><a href="{{ route('home') }}" title="HIV and Aids Core Team"><span id="logo">H</span>ACT</a></li>
		<!--<li><a href="inbox.html"><span><i class="fa fa-users" aria-hidden="true"></i> PATIENTS</span></a></li>-->
		<!--<li><a href="inbox.html"><span id="notification">7</span> <span>Notification</span></a></li>-->
		<li></li>
	</ul>
	<div id="admin-menu" class="sub-menu close">
		<div class="row">
			@if(Auth::user()->access == 1)
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('patient') }}" title="Patient"><i class="fa fa-users" aria-hidden="true"></i><br />PATIENTS</a>
			</div>
			@endif
			{{--<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('vct') }}" title="VCT (Voluntary Counselling and Testing)"><i class="fa fa-hand-stop-o fa-lg"></i><br />VCT</a>
			</div>--}}
			{{--<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('infections') }}" title="Infections"><i class="fa fa-heartbeat"></i><br /> Infections</a>
			</div>--}}
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('medicine') }}" title="Pharmacy"><i class="fa fa-medkit fa-lg"></i><br />PHARMACY</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('medicine_restock') }}" title="Stock-In Medicine"><i class="fa fa-cubes fa-lg"></i><br />STOCK-IN</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('arv') }}" title="Dispense"><i class="fa fa-file-text-o fa-lg"></i><br />DISPENSE</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('symptoms') }}" title="Symptoms"><i class="fa fa-exclamation-triangle fa-lg"></i><br />SYMPTOMS</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('mortality') }}" title="Mortality Information"><i class="fa fa-bed fa-lg"></i><br> Mortality</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('user') }}" title="Users"><i class="fa fa-user-md fa-lg"></i><br />USERS</a>
			</div>
			{{--<div class="small-12 medium-4 large-2 columns">--}}
				{{--<a href="" title="Reports"><i class="fa fa-bar-chart" aria-hidden="true"></i><br />REPORTS</a>--}}
			{{--</div>--}}
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('referrals') }}" title="Referrals"><i class="fa fa-wheelchair fa-lg"></i><br />REFERRALS</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('lab_requests') }}" title="Checkup Laboratory Requests"><i class="fa fa-ticket fa-lg"></i><br />LAB REQUESTS</a>
			</div>
			<div class="small-12 medium-4 large-2 columns">
				<a href="{{ route('activity_log') }}" title="Activity Log"><i class="fa fa-clock-o fa-lg"></i><br />ACTIVITY LOGS</a>
			</div>

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
								<li class="has-dropdown">
									<a href="#" title="Patient"><i class="fa fa-user fa-lg"></i> Patient</a>
									<ul class="dropdown">
										<li><a href="{{ route('reports_patient') }}" title="Patient"><i class="fa fa-user fa-lg"></i> Gender</a></li>
										<li><a href="{{ route('reports_patient_print_master_list') }}" title="Master List" target="_blank"><i class="fa fa-list-ol fa-lg"></i> Master List</a></li>
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="#" title="Voluntatry Counselling and Testing"><i class="fa fa-hand-stop-o fa-lg"></i> VCT</a>
									<ul class="dropdown">
										<li><a href="{{ route('registry_results') }}" title="Master List" target="_blank"><i class="fa fa-book fa-lg"></i> HIV VCT Registry</a></li>
										<li><a href="{{ route('client_results') }}" title="Clients"><i class="fa fa-calendar fa-lg"></i> HCT Monthly Registry</a></li>
										<li><a href="{{ route('reports_get_vct_results') }}" title="VCT Result"><i class="fa fa-spinner fa-lg"></i> Results</a></li>
										<li><a href="{{ route('reports_get_vct_scheduled') }}" title="Scheduled Patient"><i class="fa fa-clock-o fa-lg"></i> Scheduled</a></li>
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="{{ route('infections_results') }}" title="Infections"><i class="fa fa-heartbeat fa-lg"></i> Infections</a>
									<ul class="dropdown">
										<li><a href="{{ route('infections_results') }}" title="Present Infections"><i class="fa fa-heartbeat fa-lg"></i> Present Infections</a></li>
										<li><a href="{{ route('infections_cs_results') }}" title="Clinical Stages"><i class="fa fa-sort-numeric-asc fa-lg"></i> Clinical Stages</a></li>
										<li><a href="{{ route('hiv_care_results') }}" title="HIV Care"><i class="fa fa-medkit fa-lg"></i> HIV Care</a></li>
									</ul>
								<li>
									<a href="{{ route('reports_get_tb_results') }}" title="Tuberculosis">{{-- <i class="fa fa-heart fa-lg"></i> --}} <i class="fa-cust-lung fa-lg">&nbsp;</i>  Tuberculosis</a>
								</li>
								<li><a href="{{ route('reports_get_obgyne_results') }}" title="Ob Gyne - Summary"> <i class="fa fa-venus fa-lg"></i> Ob Gyne</a></li>
								<li>
									<a href="{{ route('laboratory_results') }}" title="Laboratory"><i class="fa fa-calendar fa-lg"></i> Laboratory</a>
								</li>
								<li>
									<a href="{{ route('mortality_results') }}" title="Mortality"><i class="fa fa-bed fa-lg"></i> Mortality</a>
								</li>

								<!-- <li>
                                    <a href="" title="ARV"><i class="fa fa-minus-circle fa-lg"></i> ARV</a>
                                </li> -->
								<li>
									<a href="{{ route('art_registry_results') }}" title="ART"><i class="fa fa-life-ring fa-lg"></i> ART</a>
								</li>
								<li class="has-dropdown">
									<a href="#" title="Pharmacy"><i class="fa fa-medkit fa-lg"></i> Pharmacy</a>
									<ul class="dropdown">
										<li class="has-dropdown">
											<a href="#"><i class="fa fa-cubes fa-lg"></i> Low Stock Summary</a>
											<ul class="dropdown">
												<li><a href="{{route('medicine_stock_report_generate')}}" title="" target="_blank"> Generate</a></li>
												<li><a href="{{route('medicine_stock_report_excel')}}" title=""> Excel</a></li>
											</ul>
										</li>
										<li>
											<a href="{{route('medicine_expired')}}"><i class="fa fa-hourglass-end fa-lg"></i> Expired Medicine</a>
										</li>
										<li class="has-dropdown">
											<a href="#"><i class="fa fa-history fa-lg"></i> Pharmacy History</a>
											<ul class="dropdown">
												<li class="has-dropdown">
													<a href="#"><i class="fa fa-download fa-lg"></i> Restocking</a>
													<ul class="dropdown">
														<li><a href="{{route('medicine_history_generate')}}" title="" target="_blank"> Generate</a></li>
														<li><a href="{{route('medicine_history_excel')}}" title="" target="_blank"> Excel</a></li>
													</ul>
												</li>
												<li>
													<a href="{{route('medicine_history_dispense')}}"><i class="fa fa-upload fa-lg"></i> Dispensing</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="{{route('patient_dispense')}}"><i class="fa fa-users fa-lg"></i> Dispense on Patient</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="has-dropdown"><a href="#" title="Follow-ups"><i class="fa fa-bell fa-lg"></i> FOLLOW-UPS</a>
							<ul class="dropdown">
								<li><a href="{{ route('referrals') }}" title="Referrals"><i class="fa fa-wheelchair fa-lg"></i> REFERRALS</a></li>
								<li><a href="{{ route('lab_requests') }}" title="Checkup Laboratory Requests"><i class="fa fa-ticket fa-lg"></i> LAB REQUESTS</a></li>
							</ul>
						</li>
						<li class="has-dropdown"><a href="#" title="HIV Info"><i class="fa fa-question fa-lg"></i> HIV INFO</a>
							<ul class="dropdown">
								<li><a href="{{ route('hiv_info', 1) }}" title="Philippine HIV/AIDS Patient Registry"><i class="fa fa-star fa-lg"></i> PHILIPPINE REGISTRY</a></li>
								<li><a href="{{ route('hiv_info', 2) }}" title="HIV/AIDS Situationer"><i class="fa fa-info-circle fa-lg"></i> SITUATIONER</a></li>
								<li><a href="{{ route('hiv_info', 3) }}" title="Wester Visayas HIV/AIDS Patient Registry"><i class="fa fa-star-half-o fa-lg"></i> WESTERN VISAYAS REGISTRY</a></li>
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
