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
										<div class="mb-3 text-center">
											<a href="#" class="d-inline-block">
												<img id="pathImg" style="max-width: 800px" src="" class="img-fluid rounded" alt="">
												
											</a>
											<div class="mt-2 caption"><div class="placeholder-glow"><span class="placeholder col-6"></span></div></div>
										</div>

										<h3 class="card-title pt-2 mb-1">
											<a href="#" class="text-body title"><div class="placeholder-glow"><span class="placeholder col-6"></span></div></a>
										</h3>

										<ul class="list-inline list-inline-bullet text-muted mb-3">
											<li class="list-inline-item">By <a href="#" class="creator"><div class="placeholder-glow"><span class="placeholder col-4"></span></div></a></li>
											<li class="list-inline-item date"><div class="placeholder-glow"><span class="placeholder col-4"></span></div></li>
											<li class="list-inline-item"><a href="#"><span class="category"><div class="placeholder-glow"><span class="placeholder col-4"></span></div></span></a></li>
										</ul>

										<div class="mb-3" id="content">
										<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
										<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
										<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
										</div>
										Tags : 
										<ul class="list-inline mb-0" id="tags">
											
											<div class="placeholder-glow"><span class="placeholder col-6"></span></div>
											
										</ul>
										
									</div>
								</div>
							</div>
							<!-- /post -->


							<!-- About author -->
							<div class="card">
								<div class="card-header d-sm-flex border-bottom-0 pb-0">
									<h5 class="mb-0">About the author</h5>

									<div class="d-inline-flex align-items-center ms-sm-auto">
										<a href="#" class="text-body ms-2" data-bs-popup="tooltip" title="Twitter"><i class="ph-twitter-logo"></i></a>
										<a href="#" class="text-body ms-2" data-bs-popup="tooltip" title="Linked In"><i class="ph-linkedin-logo"></i></a>
									</div>
								</div>

								<div class="card-body d-flex flex-column flex-lg-row">
									<div class="me-lg-3 mb-2 mb-lg-0">
										<a href="#">
											<img id="creatorImg" src="{{ asset('asstes/images/user.png') }}" class="rounded-circle" width="40" height="40" alt="">
										</a>
									</div>

									<div class="flex-fill">
										<h6 class="mb-1 creator"><div class="placeholder-glow"><span class="placeholder col-4"></span></div></h6>
										
										<ul class="list-inline mb-0">
											<li class="list-inline-item"><a id="creatorUser" href="#">Author profile</a></li>
											
										</ul>
									</div>
								</div>
							</div>
							<!-- /about author -->


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
									<button type="button" href="{{ url('dashboard/articles') }}" class="btn btn-primary ms-1">
									<i class="ph-arrow-fat-line-left me-2"></i>
										Back 
									</button>
									<button type="button" onClick="deleteArticle()" class="btn btn-danger ms-1">
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
					url: ServUrl+"/articles/detail",
					crossDomain: false,
					method: 'GET',
					complete: function(response){ 				
						if(response.status == 200){
							var articles = response.responseJSON.data.articles;
							if(articles.status == 'publish'){
								$('#publish').addClass('d-none');
								$('#unpublish').removeClass('d-none');
							}else if((articles.status == 'unpublish') || (articles.status == 'draft') || (articles.status == 'waiting')){
								$('#unpublish').addClass('d-none');
								$('#publish').removeClass('d-none');
							}
							$('.title').html(articles.title);
							$('.category').html(articles.category.name);
							$('.creator').html(articles.creator.name);
							$('.date').html(articles.date);
							$('.viewer').html(articles.viewer);
							$('.caption').html(articles.caption);
							$('#content').html(articles.content);
							$('#pathImg').attr('src', articles.img);
							$('#creatorImg').attr('src', BaseUrl+'/assets/images/users/'+articles.creator.avatar);
							$('#creatorUser').attr('href', BaseUrl+'/dashboard/users/view/'+articles.creator.id);
								if(articles.tags){
								   var tags = articles.tags.split(',')
								   var html ='';
									$.each(tags, function(x,y){
										html+='<li class="list-inline-item">';
											html+='<a href="#">';
												html+='<span class="badge bg-light border-start border-width-3 text-body border-warning rounded-start-0 mb-2">'+y+'</span>';
											html+='</a>';
										html+='</li>';
									});
									$('#tags').html(html);
							   }
							$('textarea[name=keyword]').val(articles.keyword);
							$('textarea[name=description]').val(articles.description);
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
			location.href = BaseUrl+'/dashboard/articles/update/'+id;
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
			var path = ServUrl+"/articles/verify";
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
                                        title: type+'!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                setTimeout(function(){
									loadView();
									//location.href = BaseUrl+'/dashboard/articles/'; 
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                //location.href = BaseUrl+'/dashboard/articles/'; 
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
	
	function deleteArticle() {
		if(id){
			var path = ServUrl+"/articles/delete";
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
									location.href = BaseUrl+'/dashboard/articles/';
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                location.href = BaseUrl+'/dashboard/articles/'; 
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

