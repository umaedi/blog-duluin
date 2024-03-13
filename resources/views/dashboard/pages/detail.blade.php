@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
				<div class="content">

					<!-- Inner container -->
					<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

						<!-- Left content -->
						<div class="flex-1 order-2 order-lg-1">

							<!-- Post -->
							<div class="card">
								<div class="card-body">
									<div class="mb-4">
										

										<h3 class="card-title pt-2 mb-1">
											<a href="#" class="text-body title">
												<div class="placeholder-glow"><span class="placeholder col-6"></span></div>
											</a>
										</h3>

										<ul class="list-inline list-inline-bullet text-muted mb-3">
											<li class="list-inline-item">By <a href="#" class="creator"><span class="placeholder-glow"><span class="placeholder col-4"></span></span></a></li>
											
										</ul>

										<div class="mb-3" id="content">
										<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
										</div>
										
									</div>
								</div>
							</div>
							<!-- /post -->


							


							<!-- Comments -->
							<div class="card">
								<div class="card-header d-sm-flex">
									<h6 class="mb-0">Meta Information</h6>
								</div>
								<div class="card-body">
									<div class="row">
									<div class="col-lg-6">
										<div class="mb-3">
											<label class="form-label">SEO Keyword</label>
											<textarea name="keyword" type="text" rows="3" placeholder="..." class="form-control" disabled></textarea>
											
										</div>
									</div>
									<div class="col-lg-6"> 
										<div class="mb-3">
											<label class="form-label">SEO Description</label>
											<textarea name="description" type="text" rows="3" placeholder="..." class="form-control" disabled></textarea>
											 
										</div>
									</div>
									</div>
								<div class="text-end mt-4 mb-4">
									<a type="button" href="{{ url('dashboard/pages') }}" class="btn btn-primary ms-1">
									<i class="ph-arrow-fat-line-left me-2"></i>
										Back 
									</a>
									<button type="button" onClick="deletePages()" class="btn btn-danger ms-1">
										Delete
										<i class="ph-trash ms-2"></i>
									</button>
									<button type="button" onClick="updatePages()" class="btn btn-info ms-2">
										Update
										<i class="ph-pencil ms-2"></i>
									</button>
									<button id="unpublish" type="button" onClick="unpublish()" class="btn btn-warning ms-1 d-none">
										Unpublish
										<i class="ph-arrow-fat-lines-down ms-2"></i>
									</button>
									<button id="publish" type="button" onClick="publish()" class="btn btn-indigo ms-1 d-none">
										Publish Now
										<i class="ph-arrow-fat-line-up ms-2"></i>
									</button>
								</div>
								</div>
							</div>
							<!-- /comments -->

						</div>
						<!-- /left content -->


						
					</div>
					<!-- /inner container -->

				</div>
				<!-- /content area -->

 <script>
	let id = window.location.pathname.split('/').pop();
	
	
	function loadView(){
		
		$.ajax({
					data: { "id" : id},
					url: ServUrl+"/pages/detail",
					crossDomain: false,
					method: 'GET',
					complete: function(response){ 				
						if(response.status == 200){
							var pages = response.responseJSON.data.pages;
							if(pages.status == 'publish'){
								$('#publish').addClass('d-none');
								$('#unpublish').removeClass('d-none');
							}else if((pages.status == 'unpublish') || (pages.status == 'draft') || (pages.status == 'waiting')){
								$('#unpublish').addClass('d-none');
								$('#publish').removeClass('d-none');
							}
							$('.title').html(pages.title);
							$('.creator').html(pages.creator.name);
							$('#content').html(pages.content);
							$('textarea[name=keyword]').val(pages.keyword);
							$('textarea[name=description]').val(pages.description);
						}	
					},
					dataType:'json'
				})
	
	};
	
	$( document ).ready(function() {
		loadView();
	});
	 
	
	function updatePages(){
		setTimeout(function(){
			location.href = BaseUrl+'/dashboard/pages/update/'+id;
		}, 800);
	}
	
	function publish(){
		updateStatus('publish', id)
	}
	
	function unpublish(){
		updateStatus('unpublish', id)
	}
	
	function updateStatus(type, id) {
		if(id){
			var path = ServUrl+"/pages/verify";
		}
		
		swalInit.fire({
                    title: 'Are you sure?',
                    text: 'Are you want to '+type+' this post',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, '+type+' it!',
                    cancelButtonText: 'No, cancel!',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    }
                }).then(function(result) {
                    if(result.value) {
                         $.ajax({
                            data: {id : id, type : type},
                            url: path,
                            method: 'post',
                            complete: function(response){                
                            if(response.status == 200){
                                swalInit.fire({
                                        title: 'saved!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                setTimeout(function(){
									location.href = BaseUrl+'/dashboard/pages/'; 
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                //location.href = BaseUrl+'/dashboard/pages/'; 
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
	
	function deletePages() {
		if(id){
			var path = ServUrl+"/pages/delete";
		}
		
		swalInit.fire({
                    title: 'Are you sure?',
                    text: "Are you want to delete this post",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
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
                            if(response.status == 200){
                                swalInit.fire({
                                        title: 'saved!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                setTimeout(function(){
									location.href = BaseUrl+'/dashboard/pages'; 
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                location.href = BaseUrl+'/dashboard/pages'; 
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

