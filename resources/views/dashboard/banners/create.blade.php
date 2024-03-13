@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Profile info -->
	<div class="col-lg-8">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">{{ $data['page_title'] }}</h5>
		</div>

		<div class="card-body">
			<form id="form-banner" action="#">
				<input name="id" type="hidden" value="" class="form-control">
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Position</label>
								<select name="position" type="text" value="" class="form-control form-control-select2">
								<option value="slider">Home Slider</option>
								<option value="sidebar">Sidebar</option>
								<option value="content_article">Content Article</option>
							</select>
							<div class="form-text text-muted">make sure the position is correct</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Redirect to</label>
							<input name="link" type="text" value="" placeholder="link redirect" class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					 
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea name="description" type="text" value="" class="form-control"></textarea>
						</div>
					</div>
					 
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Status</label>
								<select name="status" type="text" value="" class="form-control form-control-select2">
									<option value="publish">Publish</option>
									<option value="unpublish">Unpublish</option>
								</select>
						</div>
					</div>
				</div>

				<div class="row">
					
					<div class="col-lg-12">
						<div class="mb-3 mt-3 text-center">
							<label for="img">
								<img class="img-thumbnail img " id="view" src="{{ asset('/assets/images/upload.png') }}"/>
								<input type="file"  name="userFile"  id="img" class="form-control d-none" >
							</label>
							
							<div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
						</div>
					</div>
				</div>

				<div class="text-end mt-4">
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
	</div>
	<!-- /profile info -->

</div>
<!-- /content area -->
 
	<script src="{{ asset('assets/dashboard/js/vendor/forms/selects/select2.min.js') }}"></script>
<script>
	$('.form-control-select2').select2({
	minimumResultsForSearch: Infinity
	});
	
	let typeForm;
	let path = 'create';
	
	function loadBanner(id) {
        $.ajax({
            url: ServUrl+'/banners/detail',
            data: {'id' : id},
            type: 'GET',
            dataType: 'JSON',
			complete: (response) => {
				if(response.status == 200) {
				var banners = response.responseJSON.data.banners;
                   $('input[name=id]').val(banners.id);
                   $('input[name=link]').val(banners.link);
                   $('textarea[name=description]').val(banners.description);
                   $('select[name=position]').val(banners.position).trigger( 'change');
                   $('select[name=status]').val(banners.status).trigger( 'change');
				   $('#view').attr('src', banners.path_img);
				   typeForm = 'update';
                }
                
            }
        })
    }

	$("#form-banner").submit(function(event) {
	event.preventDefault();
	if(typeForm == 'update'){
		path = ServUrl+"/banners/update";
	}else{
		path = ServUrl+"/banners/create";
	}
	var form = $("#form-banner")[0]; 
	var data = new FormData(form);
	
	swalInit.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Yes, '+typeForm+' it!',
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
						 
						location.href = BaseUrl+'/dashboard/banners';
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
			$(":submit").prop("disabled", false);
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
	
	<?php if(isset($data['banner_id'])){ ?>
	loadBanner('<?php echo $data['banner_id']; ?>');
	<?php } ?>
</script> 
	
@endsection

