<!DOCTYPE html>
<html>
    @include('web.header')
    <body>
    @include('web.navigation')
    <div class="content transparent">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<h2>About HIV</h2>
						<br>
					</div>
				</div>
				<div class="row">
					@foreach($hiv_info as $row)
						<div class="col-sm-4">
							<div class="card">
								<div class="card-image">
									<img width="100" height="270" src="{{ asset($row->image) }}" alt=" Image">
								</div>
								<div class="card-text">
									<h3>{{ $row->description }}</h3>
								</div>
								<div class="card-control">
									<div class="text-center">
										<a href="{{ asset($row->file) }}" title="download"><i class="fa fa-download"></i></a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
    @include('web.footer')
    </body>
</html>