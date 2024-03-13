@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">
  <div class="row">

	<!-- Profile info -->
	<div class="col-lg-8">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Profile information</h5>
		</div>

		<div class="card-body">
			<form id="form-user" action="#">
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input name="email" type="text" value="" class="form-control">
							<div class="form-text text-muted">make sure the email is correct</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Full name</label>
							<input name="name" type="text" value="" class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					 
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Address line</label>
							<textarea name="address" type="text" value="" class="form-control"></textarea>
						</div>
					</div>
					 
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">State/City</label>
							<input name="state" type="text" value="" class="form-control" placeholder="eg: Jakarta">
						</div>
						<div class="mb-3">
							<label class="form-label">Phone #1</label>
							<input name="phone" type="text"  value="" class="form-control">
						</div>
						<div class="mb-3">
							<label class="form-label">Phone #2</label>
							<input name="phone_2" type="text" value="" class="form-control">
							<div class="form-text text-muted">your 2nd phone number</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3 text-center">
							<label for="img">
								<img class="img-thumbnail img " id="avatar" src="{{ asset('/assets/images/upload.png') }}"/>
								<input type="file"  name="userFile"  id="img" class="form-control d-none" >
							</label>
							
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div>
					</div>
				</div>

				<div class="text-end mt-2">
					<button id="btn-action" type="submit" class="btn btn-primary btn-action">Save changes</button>
					<button id="btn-loading" type="button" class="btn btn-secondary btn-loading d-none">
						<span class="mx-4"><i class="ph-spinner spinner"></i></span>
					</button>
				</div>
			</form>
		
		</div>
	</div>
	</div>
	<!-- /profile info -->
	<!-- Account settings -->
	<div class="col-lg-4">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Account settings</h5>
		</div>

		<div class="card-body">
			<form id="form-password" action="#">
				<div class="row">
					 
					<div class="col-lg-12">
						<div class="mb-3">
							<label class="form-label">Current password</label>
							<input name="old_password" type="password" value=""  class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3">
							<label class="form-label">New password</label>
							<input name="password" type="password" placeholder="Enter new password" class="form-control">
						</div>
					</div>

					<div class="col-lg-12">
						<div class="mb-3">
							<label class="form-label">Repeat password</label>
							<input name="password_confirmation" type="password" placeholder="Repeat new password" class="form-control">
						</div>
					</div>
				</div>

				 

				<div class="text-end">
					<button id="btn-action" type="submit" class="btn btn-primary btn-action">Save changes</button>
					<button id="btn-loading" type="button" class="btn btn-secondary btn-loading d-none">
						<span class="mx-4"><i class="ph-spinner spinner"></i></span>
					</button>
				</div>
			</form>
		
		</div>
	</div>
	</div>
	<!-- /account settings -->

  </div>
</div>
<!-- /content area -->
 <script>  
	 
	function loadView(){
		
		$.ajax({
				data: "",
				url: ServUrl+"/user/account",
				crossDomain: false,
				method: 'GET',
				complete: function(response){ 				
				if(response.status == 200){
				 
							$('#role').html(response.responseJSON.data.role_name[0]);
							$('input[name=name]').val(response.responseJSON.data.name);
							$('input[name=state]').val(response.responseJSON.data.state);
							$('textarea[name=address]').val(response.responseJSON.data.address);
							$('input[name=email]').val(response.responseJSON.data.email);
							$('input[name=phone]').val(response.responseJSON.data.phone);
							$('input[name=phone_2]').val(response.responseJSON.data.phone_2);
							$('#avatar').attr('src', response.responseJSON.data.avatar);
					}
				},
				dataType:'json'
				})
	
	};
	
	loadView();
	
	$("#form-user").submit(function(event) {
	event.preventDefault();
	$('.btn-action').addClass('d-none');
	$('.btn-loading').removeClass('d-none');
	var path = ServUrl+"/user/update_account";
	var form = $("#form-user")[0]; 
	var data = new FormData(form);
	
	swalInit.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, save it!',
		cancelButtonText: 'No, cancel!',
		buttonsStyling: false,
		customClass: {
			confirmButton: 'btn btn-success',
			cancelButton: 'btn btn-danger'
		}
	}).then(function(result) {
		if(result.value) {
			
				$.ajax({
					data: data,
					url: path,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					method: 'POST',
					complete: function(response){                
					if(response.status == 201){
						swalInit.fire({
								title: 'Saved!',
								text: response.responseJSON.message,
								icon:'success'
							}); 
						 
						loadView();
						$('.btn-action').removeClass('d-none');
						$('.btn-loading').addClass('d-none');
					}else{
						swalInit.fire({
								title: 'Aborted!',
								text: response.responseJSON.message,
								icon:'warning'
							});	
						$('.btn-action').removeClass('d-none');
						$('.btn-loading').addClass('d-none');
					}
					},
					dataType:'json'
			});
			
			
		}
		else if(result.dismiss === swal.DismissReason.cancel) {
			$('.btn-action').removeClass('d-none');
			$('.btn-loading').addClass('d-none');
		}
	});
			
	});
	
	 $("#form-password").submit(function(e) {
            e.preventDefault();
			$('.btn-action').addClass('d-none');
			$('.btn-loading').removeClass('d-none');
            let data = $(this).serialize();
            
            $.ajax({
                url: ServUrl+"/user/change_password",
                data: data,
                method: 'POST',
                dataType: 'JSON',
				complete: function(response){                
					if(response.status == 201){
					new Noty({
						text: response.responseJSON.message,
						type: 'alert'
					}).show();
					$('.btn-action').removeClass('d-none');
					$('.btn-loading').addClass('d-none');					
                    setTimeout(function(){
						window.location.replace(BaseUrl+'/logout');
					}, 800);
                    }else {
                    new Noty({
							layout: 'bottomCenter',
							text: response.responseJSON.message,
							type: 'alert'
						}).show();
						
						$('.btn-action').removeClass('d-none');
						$('.btn-loading').addClass('d-none');
					}
            }
            });
        });
	
	function readURL(input,img) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$(input).prev('img').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	
	$("#img").change(function(){
			readURL(this);
	});
</script>	
@endsection

