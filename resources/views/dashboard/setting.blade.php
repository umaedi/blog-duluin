@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Multiline tabs -->
	<div class="row">
		<div class="col-lg-12">
		
			<div class="card">
				 
				<ul class="nav nav-tabs nav-tabs-highlight">
					<li class="nav-item col-3">
						<a href="#setting" class="nav-link active" data-bs-toggle="tab" role="tab" aria-selected="true">
							<div>
								<div class="fw-semibold">Meta Setting</div>
								<span class="opacity-50">About site information</span>
							</div>
						</a>
					</li>
					<li class="nav-item col-3">
						<a href="#social" class="nav-link" data-bs-toggle="tab" role="tab" aria-selected="true">
							<div>
								<div class="fw-semibold">Social Media</div>
								<span class="opacity-50">My social media account</span>
							</div>
						</a>
					</li>
					<li class="nav-item col-3">
						<a href="#maps" class="nav-link" data-bs-toggle="tab" role="tab" aria-selected="true">
							<div>
								<div class="fw-semibold">Maps</div>
								<span class="opacity-50">My localisation</span>
							</div>
						</a>
					</li>
					 
					 
				</ul>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="setting" role="tabpanel">
					<!-- Basic layout -->
					<div class="card">
						 
						<div class="card-body mt-2">
							<form id="form-info" action="#">
							<input type="hidden" name="id">
							<legend class="fs-base fw-bold border-bottom pb-2 mb-3">Site information</legend>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Website title</label>
									<div class="col-lg-8">
										<input name="title" type="text" class="form-control" placeholder="">
									</div>
								</div>
								
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Description</label>
									<div class="col-lg-8">
										<textarea name="description" type="text" class="form-control" placeholder=""></textarea>
									</div>
								</div>

								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Address</label>
									<div class="col-lg-8">
										<textarea name="address" type="text" class="form-control" placeholder=""></textarea>
									</div>
								</div>
								
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Phone number</label>
									<div class="col-lg-3">
										<input name="phone" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">2nd phone number</label>
									<div class="col-lg-3">
										<input name="phone_2" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Official E-mail</label>
									<div class="col-lg-4">
										<input name="email" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<legend class="fs-base fw-bold border-bottom pb-2 mb-3">Meta information</legend>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Meta description</label>
									<div class="col-lg-8">
										<textarea name="meta_description"  type="text" class="form-control" placeholder=""></textarea>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Meta keyword</label>
									<div class="col-lg-8">
										<textarea name="meta_keywoard" type="text" class="form-control" placeholder=""></textarea>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Copyright</label>
									<div class="col-lg-8">
										<input name="footer" type="text" class="form-control" placeholder="">
									</div>
								</div>
								
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Your logo</label>
									<div class="col-lg-6">
										<input name="userfile" type="file" class="form-control">
										<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
									</div>
								</div>
								
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label"></label>
									<div class="col-lg-6">
										<div class="col-sm-9" id="logoImg">
									
										</div>
									</div>
									
								</div>
								<div class="text-end">
									<button onClick="submitInfo()" type="button" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
								</div>
							</form>
						</div>
					</div>
					<!-- /basic layout -->
				  </div>
				  <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="profile-tab">
					<!-- Basic layout -->
					<div class="card">
						 
						<div class="card-body mt-2">
							<form id="form-social" action="#">
							<legend class="fs-base fw-bold border-bottom pb-2 mb-3">Social Media information</legend>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Youtube</label>
									<div class="col-lg-6">
										<input name="youtube" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">LinkedIn</label>
									<div class="col-lg-6">
										<input name="linkedin" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Instagram</label>
									<div class="col-lg-6">
										<input name="instagram" type="text" class="form-control" placeholder="">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Facebook</label>
									<div class="col-lg-6">
										<input name="facebook" type="text" class="form-control" placeholder="">
									</div>
								</div>
								
								
								<div class="text-end">
									<button onClick="submitSocial()" type="button" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
								</div>
							</form>
						</div>
					</div>
					<!-- /basic layout -->
				  </div>
				  <div class="tab-pane fade" id="maps" role="tabpanel" aria-labelledby="profile-tab">
					<!-- Basic layout -->
					<div class="card">
						 
						<div class="card-body mt-2">
							<form id="form-maps" action="#">
								<div class="row mb-3">
									<label class="col-lg-2 col-form-label">Google Maps</label>
									<div class="col-lg-12">
										<textarea name="google_maps" type="text" class="form-control" placeholder=""></textarea>
									</div>
								</div>
								 
								
								
								<div class="text-end">
									<button onClick="submitMaps()" type="button" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
								</div>
							</form>
						</div>
					</div>
					<!-- /basic layout -->
				  </div>
				   
				</div>
			</div>
		</div>

		
	</div>
	<!-- /multiline tabs -->

</div>
<!-- /content area -->

<script>  
  let id = '';      
function loadSetting(){
		$.ajax({
		  data: "",
		  url: ServUrl+"/setting/app",
          method: 'GET',
          complete: function(response){ 
					if(response.status == 200){
						id = id;	 
						$("input[name=id]").val(response.responseJSON.data.id);
						$("input[name=title]").val(response.responseJSON.data.title);
						$("textarea[name=description]").val(response.responseJSON.data.description);
						$("textarea[name=address]").val(response.responseJSON.data.address);
						$("input[name=phone]").val(response.responseJSON.data.phone);
						$("input[name=phone_2]").val(response.responseJSON.data.phone_2);
						$("input[name=email]").val(response.responseJSON.data.email);
						$("textarea[name=meta_description]").val(response.responseJSON.data.meta_description);
						$("textarea[name=meta_keywoard]").val(response.responseJSON.data.meta_keywoard);
						$("input[name=footer]").val(response.responseJSON.data.footer);

						
						$("input[name=facebook]").val(response.responseJSON.data.facebook);
						$("input[name=instagram]").val(response.responseJSON.data.instagram);
						$("input[name=youtube]").val(response.responseJSON.data.youtube);
						$("input[name=linkedin]").val(response.responseJSON.data.linkedin);
						
						
						$("textarea[name=google_maps]").val(response.responseJSON.data.google_maps);
						
						
						$("#logoImg").html('<img class="img-thumbnail" width="80" src="'+response.responseJSON.data.logo+'" alt="">');
							
           			}else{
						swalInit.fire({
							title: 'Abord !!',
							html: response.responseJSON.message,
							timer: 2500,
							timerProgressBar: false,
							
						}).then(function (result) {
							
							//window.history.back();
						
						});
						
						
					}
					
				},
				dataType:'json'
			})
	
	};
	loadSetting();
	
	function submitInfo(){
		var form = $("#form-info")[0]; 
		var data = new FormData(form);
		submit(data);
	}
	
	function submitSocial(){
		var form = $("#form-social")[0]; 
		var data = new FormData(form);
		submit(data);
	}
	
	function submitMaps(){
		var form = $("#form-maps")[0]; 
		var data = new FormData(form);
		submit(data);
	}
	
	function submit(data) {
		
		var path = ServUrl+"/setting/update";
		
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
							$(":submit").prop("disabled", false); 
							loadSetting(); 
							
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
					'Your imaginary file is safe :)',
					'error'
				);
			}
		});

				
	};	
</script>  
	
@endsection

