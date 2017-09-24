<div id="banner">
			<div class="container">
				<div class="element-to-center" data-container="#banner">
					<div class="row">
						<div id="banner-text" class="col-sm-12">
							<div class="text-container text-center">
								<h1>Do I have HIV?</h1>
								<br>
								<a href="{{ route('hiv_test') }}" id="open-test" class="btn btn-primary btn-lg">take the test now</a>
							</div>
						</div>


						{{-------------------------------------------------------}}
								<!-- Trigger the modal with a button -->
						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog" style="padding-top: 10%">
							<div class="row">
								<div class="col-sm-3">
								</div>
								<div class="col-sm-6">
									<div class="form-container">
										@if(!Auth::check())
											<form action="{{ route('login_auth') }}" method="post">
												<div class="row">
													<div class="col-sm-11">
														<h3>Login Form</h3>
													</div>
													<div class="col-sm-1">
														<a href="javascript:;" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></a>
													</div>
												</div>
												@include('hact.messages.success')
												<script>
													if(window.location.hash == "#login") {
														$(function() {
															$('#myModal').modal('show');
														});
													}
												</script>
												@if(Session::has('error'))
													<script>
														$(function() {
															$('#myModal').modal('show');
														});
													</script>
													<div class="alert alert-warning alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														{{ Session::get('error') }}
													</div>
												@endif
												<br>
												<div class="form-group">
													<label>Email</label>
													<input type="text" id="email" name="email" class="form-control" value="{{ $email }}" placeholder="Email" />
												</div>
												<div class="form-group">
													<label>Password</label>
													<input type="password" id="password" name="password" class="form-control" placeholder="Password" />
													{!! csrf_field() !!}
												</div>
												<div class="clearfix">
													<div class="pull-left">
														<div class="form-group">
															<input type="checkbox">
															<label>Remember Me?</label>
														</div>
													</div>
													<div class="pull-right">
														<div class="text-center">
															<a href="password/email">I forgot my password</a>
														</div>
													</div>
												</div>
												<br>
												<div class="form-group">
													<button class="btn btn-primary btn-block btn-lg" type="submit">Login</button>
												</div>
											</form>
										@endif
									</div>
								</div>
							</div>
						</div>

						{{-------------------------------------------------------}}

					</div>
				</div>
			</div>
		</div>
		<div class="content g-content">
			<div class="container">
				<div class="text-center">
					<h2>What is HIV?</h2>
				</div>
				<br>
				<p>HIV is a virus that gradually attacks the immune system, which is our body’s natural defence against illness. If a person becomes infected with HIV, they will find it harder to fight off infections and diseases. The virus destroys a type of		white blood cell called a T-helper cell and makes copies of itself inside them. T-helper cells are also referred to as CD4 cells.</p>
				<br>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<div class="text-center">
					<p><span style="font-size:32px;">There are many different strains of HIV</span> – someone who is infected may carry various different strains in their body. These are classified into types, with lots of groups and subtypes. The two main types are</p>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="text-center">
							<h2>HIV - 1</h2>
							<p>the most common type found worldwide</p>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="text-center">
							<h2>HIV - 2</h2>
							<p>this is found mainly in Western Africa, with some cases in India and Europe.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="hiv-basic-facts" class="content-with-bg">
			<div class="container-fluid">
				<div class="text-center">
					<h1>Basic facts about HIV</h1>
					<div id="hiv-fact-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#hiv-fact-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="1"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="2"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="3"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="4"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="5"></li>
							<li data-target="#hiv-fact-carousel" data-slide-to="6"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>HIV stands for human immunodeficiency virus</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>If left untreated, it can take around 10 to 15 years for AIDS to develop, which is when HIV has severely damaged the immune system</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>With early diagnosis and effective antiretroviral treatment, people with HIV can live a normal, healthy life</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>HIV is found in the following body fluids of an infected person: semen, blood, vaginal and anal fluids and breast milk</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>HIV cannot be transmitted through sweat, saliva or urine</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>According to statistics, the most common way for someone to become infected with HIV is by having anal or vaginal sex without a condom</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#hiv-basic-facts">
									<h3>You can also risk infection by using infected needles, syringes or other drug-taking equipment (blood transmission), or from mother-to-child during pregnancy, birth or breastfeeding</h3>
								</div>
							</div>
						</div>
						<a class="left carousel-control" href="#hiv-fact-carousel" role="button" data-slide="prev">
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#hiv-fact-carousel" role="button" data-slide="next">
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="content g-content">
			<div class="container">
				<div class="text-center">
					<h2>What is AIDS?</h2>
				</div>
				<br>
				<p>AIDS is a syndrome caused by the HIV virus. It is when a person’s immune system is too weak to fight off many infections, and develops when the HIV infection is very advanced. This is the last stage of HIV infection where the body can no longer defend itself and may develop various diseases, infections and if left untreated, death.</p>

				<p>There is currently no cure for HIV or AIDS. However, with the right treatment and support, people can live long and healthy lives with HIV. To do this, it is especially important to take treatment correctly and deal with any possible side-effects.</p>
				<br>
			</div>
		</div>
		<div id="aids-basic-facts" class="content-with-bg">
			<div class="container-fluid">
				<div class="text-center">
					<h1>Basic facts about AIDS</h1>
					<div id="aids-fact-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#aids-fact-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#aids-fact-carousel" data-slide-to="1"></li>
							<li data-target="#aids-fact-carousel" data-slide-to="2"></li>
							<li data-target="#aids-fact-carousel" data-slide-to="3"></li>
							<li data-target="#aids-fact-carousel" data-slide-to="4"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<div class="element-to-center" data-container="#aids-basic-facts">
									<h3>AIDS stands for acquired immune deficiency syndrome</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#aids-basic-facts">
									<h3>AIDS is also referred to as advanced HIV infection or late-stage HIV</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#aids-basic-facts">
									<h3>Someone with AIDS may develop a wide range of other health conditions including: pneumonia, thrush, fungal infections, TB, toxoplasmosis and cytomegalovirus</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#aids-basic-facts">
									<h3>There is also an increased risk of developing other life-limiting conditions, including cancer and brain illnesses</h3>
								</div>
							</div>
							<div class="item">
								<div class="element-to-center" data-container="#aids-basic-facts">
									<h3>CD4 count refers to the number of T-helper cells in a cubic millilitre of blood. When a person’s CD4 count drops below 200 cells per millilitre of blood, they are said to have AIDS</h3>
								</div>
							</div>
						</div>
						<a class="left carousel-control" href="#aids-fact-carousel" role="button" data-slide="prev">
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#aids-fact-carousel" role="button" data-slide="next">
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div id="contact-form" class="content g-content">

			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div id="take-test=info">
							<h1 style="color:#9f0113;">Need to take HIV test?</h1>
							<p>Please go to this address or contact us with the following number</p>
							<br>
						</div>
						<h2>HACT Office</h2>
						<p>2nd floor, OPD bldg.</p>
						<p>Corazon Locsin Montelibano Memorial</p>
						<p>Regional Hospital</p>
						<br>
						<br>
						<h2>Contact Number</h2>
						<p>0912 356 1864</p>
						<p>(034) 707 2280</p>
					</div>
					<div class="col-sm-6">
						<div class="form-container">
							@if(count($errors) > 0)
								<div class="alert alert-warning" role="alert">
							        <ul class="list-unstyled">
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif

							@if(Session::has('status'))
							    <div class="alert alert-success" role="alert">
							        {{ Session::get('status') }}
							    </div>
							@endif

							@if(Session::has('error'))
							    <div class="alert alert-warning" role="alert">
							        {{ Session::get('error') }}
							    </div>
							@endif
							<form action="{{ route('submit_form') }}" method="post">
								<h2>Contact Form</h2>
								<br>
								<div class="form-group form-group-lg">
									<label>Full Name</label>
									<input type="text" name="full_name" class="form-control" placeholder="Full Name" value="{{ old('full_name') }}">
								</div>
								<div class="form-group form-group-lg">
									<label>Email</label>
									<input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
								</div>
								<div class="form-group form-group-lg">
									<label>Message</label>
									<textarea class="form-control" name="message"  placeholder="enter your message" rows="5">{{ old('message') }}</textarea>
								</div>
								<br>
								<div class="form-group form-group-lg">
									{!! csrf_field() !!}
									<button class="btn btn-primary btn-block btn-lg" type="submit"><i class="fa fa-send-o"></i>&nbsp;&nbsp;&nbsp;Send Message</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

