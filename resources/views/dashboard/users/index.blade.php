@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Inner container -->
	<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">


		<!-- Right content -->
		<div class="flex-1 order-2 order-lg-1">
			<!-- Dropdown list -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">User list</h5>
				</div>

				<div class="list-group list-group-borderless py-2" id="list-user">
					<div class="list-group-item hstack gap-3">
					<div class="flex-fill">
					 <div class="placeholder-glow"><span class="placeholder col-12"></span></div>
					</div>
					</div>
				</div>
				<div class="text-center mt-2 mb-4 gap-3">
					<button id="loadMore" onclick="loadMore()" data-value="" type="button" data-initial-text="<i class='ph-spinner me-2'></i> Load More" data-loading-text="<i class='ph-spinner spinner me-2'></i> Loading..." class="btn btn-light btn-loading col-4 me-3"><i class="ph-spinner me-2"></i> Load More</button>
				</div>
			</div>
			<!-- /dropdown list -->
			

		</div>
		<!-- /right content -->
		
		<!-- Left sidebar component -->
		<div class="sidebar sidebar-component sidebar-expand-lg border rounded shadow-sm order-1 order-lg-2 ms-lg-3 mb-3">

			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Header -->
				<div class="sidebar-section sidebar-section-body d-flex align-items-center d-lg-none pb-2">
					<h5 class="mb-0">Sidebar</h5>
					<div class="ms-auto">
						<button type="button" class="btn btn-light border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-component-toggle">
							<i class="ph-x"></i>
						</button>
					</div>
				</div>
				<!-- /header -->

				<!-- Actions -->
				<div class="sidebar-section">
					<div class="sidebar-section-header border-bottom">
						<span class="fw-semibold">Access Control</span>
						<div class="ms-auto">
							<a href="#sidebar-actions" class="text-reset" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator"></i>
							</a>
						</div>
					</div>

					<div class="collapse show" id="sidebar-actions">
						<div class="sidebar-section-body">
							<div class="row row-tile g-0">
								<div class="col">
									<a href="{{ url('dashboard/users/register') }}" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
										<i class="ph-user-plus text-primary ph-2x mb-1"></i>
										Register User 
									</a>

									
								</div>
								
								<div class="col">
									

									<a href="{{ url('dashboard/roles') }}" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
										<i class="ph-tree-structure text-pink ph-2x mb-1"></i>
										Role Permission
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /actions -->

				<!-- Filter -->
				<div class="sidebar-section">
					<div class="sidebar-section-header border-bottom">
						<span class="fw-semibold">Filters By Role</span>
						<div class="ms-auto">
							<a href="#sidebar-filters" class="text-reset" data-bs-toggle="collapse">
								<i class="ph-caret-down collapsible-indicator"></i>
							</a>
						</div>
					</div>

					<div class="collapse show">
					<form id="role"> 
						<div class="sidebar-section-body" id="list-role">
							<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
						</div>
						<div class="text-center mt-4 mb-4 gap-3">
							
							<a href="#" id="submitRole" class="btn btn-primary btn-labeled btn-labeled-start">
								<span class="btn-labeled-icon bg-black bg-opacity-20">
									<i class="ph-plus-circle"></i>
								</span>
								Apply filter
							</a> 						
						</div>
						</form>	
					</div>
				</div>
				<!-- /filter -->
 
				 
			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /left sidebar component -->

	</div>
	<!-- /inner container -->

</div>
<!-- /content area -->
   
<script>
	let fRole = '';
	let page = 1;
	let rolePage = 1;
	let currentPage = 0;
	let currentRolePage = 0;
	
	function loadData(page, fRole){
		$.ajax({
        data: {"page" : page, "role" : fRole},
        url: ServUrl+"/user/list",
          method: 'GET',
          complete: function(response){ 
            var tbody = '';       
              if(response.status == 200){
				if(response.responseJSON.data.user.length == 0){
				  $('#loadMore').hide();
				}else{
				  $('#loadMore').show();
				}
                $.each(response.responseJSON.data.user, function(k,v){
					if(!v.role[0]){
						var role = '<span class="text-danger">missing role, user haven`t any access fr !!</span>'
					}else{
						var role = '<span class="text-success">'+v.role[0]+'</span>';
					}
					tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container">';
							tbody +='<img src="{{ asset('assets/dashboard/images/demo/users/face1.jpg') }}" class="w-40px h-40px rounded-pill" alt="">';
							tbody +='<span class="status-indicator bg-success"></span>';
						tbody +='</a>';

						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
							tbody +='<span class="text-muted">'+role+'</span>';
						tbody +='</div>';

						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<a href="#" class="text-body d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">';
								tbody +='<i class="ph-list"></i>';
							tbody +='</a>';

							tbody +='<div class="dropdown-menu dropdown-menu-end">';
								tbody +='<a href="{{ url('dashboard/users/view/') }}/'+v.id+'" class="dropdown-item">';
									tbody +='<i class="ph-magnifying-glass me-2"></i>Detail';
								tbody +='</a>';
								tbody +='<a href="{{ url('dashboard/users/permission/') }}/'+v.id+'" class="dropdown-item">';
									tbody +='<i class="ph-lock-key-open me-2"></i>Permission';
								tbody +='</a>';
								tbody +='<a onClick="destroy('+v.id+')" href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#video">';
									tbody +='<i class="ph-trash me-2"></i>Delete';
								tbody +='</a>';
							tbody +='</div>';
						tbody +='</div>';
					tbody +='</div>';
                     
                });
				
				if(page == 1){
					$('#list-user').html(tbody);
				}else{
					$('#list-user').append(tbody);
				}
				
				currentPage = response.responseJSON.data._meta.currentPage;
				 				
                $('#loadMore').data("value", response.responseJSON.data._meta.currentPage); 
				$('#total-data').html(response.responseJSON.data.user.length+' displayed data'); 
              }else{
                swal({
					title: 'Aborted!',
					text: response.responseJSON.message,
					icon:'warning'
				});	
              }
          },
		dataType:'json'
    })
	};
	loadData(page, '');
	
	function loadMore(){
		var page = currentPage+1;
		loadData(page);		
	};
	
	function loadRole(rolePage){
		$.ajax({
        data: {"page" : rolePage, "perpage": 15},
        url: ServUrl+"/role/list",
          method: 'GET',
          complete: function(response){ 
            var tbody = '';       
              if(response.status == 200){
				if(response.responseJSON.data.role.length == 0){
				  $('#loadMoreRole').hide();
				}else{
				  $('#loadMoreRole').show();
				}
                $.each(response.responseJSON.data.role, function(k,v){
					
						tbody +='<label class="form-check form-check-reverse text-start mb-2">';
							tbody +='<input type="checkbox" name="id[]" value="'+v.id+'" class="form-check-input">';
							tbody +='<span class="form-check-label">'+v.name+'</span>';
						tbody +='</label>';
					
                });
				
				 
				$('#list-role').html(tbody);
				
				currentRolePage = response.responseJSON.data._meta.currentPage;
				 				
                $('#loadMoreRole').data("value", response.responseJSON.data._meta.currentPage); 
				  
              }else{
                swalInit.fire({
					title: 'Aborted!',
					text: response.responseJSON.message,
					icon:'warning'
				});	
              }
          },
		dataType:'json'
    })
	};
	loadRole(rolePage);
	
	 
	$( "#submitRole" ).on( "click", function(event) {
		var data = $( "#role" ).serialize()
		var values = $("input[name='id[]']:checked")
		  .map(function(){
			  return $(this).val();}
			  ).get();
		 var roleId = [];
		 $.each(values, function(k,v){
			 roleId += v+',';
		 });

		var fRole = roleId;
	   
		loadData(1, fRole);
	});   
	 
</script>	
@endsection

