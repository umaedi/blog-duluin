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
			<h5 class="mb-0">User information</h5>
		</div>

		<div class="card-body">
			<form id="form-user" action="#">
				<div class="row">
					<div class="col-lg-12">
					<div class="alert alert-danger alert-icon-start alert-dismissible fade show" hidden>
						<span class="alert-icon bg-danger text-white">
							<i class="ph-x-circle"></i>
						</span>
						This user got <span class="fw-semibold">banned</span> from access login, please call administrator.</a>
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input name="email" type="text" value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Full name</label>
							<input name="name" type="text" value="" class="form-control" disabled>
						</div>
					</div>
				</div>

				<div class="row">
					 
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Address line</label>
							<textarea name="address" type="text" value="" class="form-control" disabled></textarea>
						</div>
					</div>
					 
				</div>
				
				<div class="row">
					
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">State/City</label>
							<input name="state" type="text" value="" class="form-control" placeholder="eg: Jakarta" disabled>
						</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Phone #1</label>
							<input name="phone" type="text"  value="" class="form-control">
						</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Phone #2</label>
							<input name="phone_2" type="text" value="" class="form-control" disabled>
							<div class="form-text text-muted">your 2nd phone number</div>
						</div>
					</div>

					
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
			<!-- Actions -->
			<div class="sidebar-section mb-4">
				
				<div class="collapse show" id="sidebar-actions">
					<div class="sidebar-section-body">
							<div class="row row-tile g-0">
								<div class="col">
									<a href="#" onClick="deleteUser()" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
										<i class="ph-trash text-danger ph-2x mb-1"></i>
										Suspend Account
									</a>
								</div>
								
								<div class="col">
									<a href="#"  onClick="resetPassword()" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
										<i class="ph-user-switch text-primary ph-2x mb-1"></i>
										Reset User Password 
									</a>
								</div>
							</div>
						</div>
				</div>
			</div>
			 
		</div>
	</div>
	</div>
	<!-- /account settings -->

  </div>
</div>
<!-- /content area -->
 <script>
	var id = window.location.pathname.split('/').pop();
	function loadView(){
		
		$.ajax({
					data: { "id" : id},
					url: ServUrl+"/user",
					crossDomain: false,
					method: 'GET',
					complete: function(response){ 				
					if(response.status == 200){
								$('#role').html(response.responseJSON.data.role_name[0]);
								if(response.responseJSON.data.banned == 1){
									$('.alert-danger').attr('hidden', false);
								}
								$('input[name=name]').val(response.responseJSON.data.name);
								$('input[name=state]').val(response.responseJSON.data.state);
								$('textarea[name=address]').val(response.responseJSON.data.address);
								$('input[name=email]').val(response.responseJSON.data.email);
								$('input[name=phone]').val(response.responseJSON.data.phone);
								$('input[name=phone_2]').val(response.responseJSON.data.phone_2);
						}
					},
				dataType:'json'
				})
	
	};
	
	loadView()
	
	function deleteUser() {
		if($.isNumeric(id)){
			var path = ServUrl+"/user";
		}
		
		swalInit.fire({
                    title: 'Are you sure?',
                    text: "Are you want to suspend this User",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, suspend user!',
                    cancelButtonText: 'No, cancel!',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    }
                }).then(function(result) {
                    if(result.value) {
                         $.ajax({
                            data: {'id': id},
                            url: path,
                            method: 'DELETE',
                            complete: function(response){                
                            if(response.status == 201){
                                swalInit.fire({
                                        title: 'saved!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                $('.alert-danger').attr('hidden', false);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                location.reload(); 
                            }
                            },
                            dataType:'json'
						});
                    
                    }
                    else if(result.dismiss === swal.DismissReason.cancel) {
                        swalInit.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        );
                    }
                });
				
	};
</script> 
	
@endsection

