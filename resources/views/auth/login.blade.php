@extends('layouts.auth.app')
@section('content')

<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					<form id="formSignin" autocomplete="off" novalidate class="login-form">
						<div class="card mb-0">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="{{ asset('assets/frontend/images/logo.svg') }}" class="h-48px" alt="">
									</div>
									<h5 class="mb-0">Login to your account</h5>
									<span class="d-block text-muted">Enter your credentials below</span>
								</div>

								<div class="mb-3 d-none" id="alert">
									 <div class="alert alert-danger border-0 alert-dismissible fade show">
										<span class="" id="alertMsg"></span>
										<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
								    </div>
								</div>
								<div class="mb-3">
									<label class="form-label">Email</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input name="email" type="text" class="form-control" placeholder="your email" value="admin@gmail.com">
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input  name="password" type="password" class="form-control" placeholder="•••••••••••">
										 
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<button id="btn-action" type="submit" class="btn btn-primary w-100">Sign in</button>
									<button id="btn-loading" type="button" class="btn btn-secondary w-100 d-none">
										<span class="mx-4"><i class="ph-spinner spinner"></i></span>
									</button>
								</div>

								<div class="text-center">
									 
								</div>
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->


			 @include('layouts.auth.footer')

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<script>
 

let data = getUrlVars();
let message = decodeURIComponent(data.message);
if(message != 'undefined'){
	 
	$('#alert').removeClass('d-none');
	$('#alert').html(message);
}
 
 $('#formSignin').submit(function(event) {
    event.preventDefault();
    $('#btn-action').addClass('d-none');
	$('#btn-loading').removeClass('d-none');
    const form = $(this)[0];
    const data = new FormData(form);

    $.ajax({
        url: BaseUrl+'/api/auth/signin',
        data: data,
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        complete: (response) => {
          if(response.status == 200) { 
            window.location.replace(BaseUrl+'/set_cookie?token='+response.responseJSON.data.access_token);
          }else {
            $('#alert').removeClass('d-none');
            $('#alertMsg').html('Pastikan username dan password yang anda masukan benar !');
			setTimeout(function(){
				$('#alert').addClass('d-none');
			}, 5000);
            $('#btn-loading').addClass('d-none');
            $('#btn-action').removeClass('d-none');
          }
        }
    });
  });
 
</script>
@endsection

