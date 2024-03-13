@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Profile info -->
	<div class="col-lg-8">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Register New User</h5>
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
								<img class="img-thumbnail img " id="view" src="{{ asset('/assets/images/upload.png') }}"/>
								<input type="file"  name="userFile"  id="img" class="form-control d-none" >
							</label>
							
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input name="password" type="password" placeholder="Enter new password" class="form-control">
							 
						</div>
					</div>

					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Confirmation Password</label>
							<input name="password_confirmation" type="password" placeholder="Repeat new password" class="form-control">
						</div>
					</div>
				</div>

				<div class="text-end mt-2">
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	<!-- /profile info -->

</div>
<!-- /content area -->
 
<script>
	$( "input[name=email]" ).change(function() {
	  var email =$(this).val()
	  
	  $.ajax({
					data: {"email": email},
					url: ServUrl+"/user/check_email",
                    crossDomain: false,
                    method: 'POST',
                    complete: function(response){ 		
                        if(response.status == '200'){
                            if(response.responseJSON.data.result == false){
                            swalInit.fire({ title: 'Email Already Registrated',  text: "please use another email",});
                            $("input[name=email]").val("");
                            $('select[name=role]').html("");							
                            }else{
							$("input[name=name]").focus();	
							}
                        }else{
                            swalInit.fire({
                                title: 'Aborted!',
                                text: response.responseJSON.message,
                                icon:'warning',
                            }); 
									 
						}
                    },
					dataType:'json'
                })
	});

	$("#form-user").submit(function(event) {
	event.preventDefault();

	var path = ServUrl+"/user";
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
			$(":submit").prop("disabled", true);
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
						 
						location.href = BaseUrl+'/dashboard/users/permission/'+response.responseJSON.data.id;
					}else{
						swalInit.fire({
								title: 'Aborted!',
								text: response.responseJSON.message,
								icon:'warning'
							});	
						$(":submit").prop("disabled", false);
						//location.reload(); 
					}
					},
					dataType:'json'
			});
			
			
		}
		else if(result.dismiss === swal.DismissReason.cancel) {
			swalInit.fire(
				'Cancelled',
				'Your imaginary it is safe :)',
				'error'
			);
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

