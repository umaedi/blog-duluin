@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">
	<div class="mb-3">
		<h4 class="mb-2">Permission for role <span class="text-primary role">...</span> </h4>
		<span class="text-muted">change manually permission by role here !</span>
	</div>
	<!-- Inner container -->
	<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">


		<!-- Right content -->
		<div class="flex-1 order-2 order-lg-1">
			<!-- Dropdown list -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Role Has Permission</h5>
				</div>

				<div class="list-group form-switch list-group-borderless py-2" id="list-roles">
					 
				</div>
				<div class="text-center mt-2 mb-4 gap-3">
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
									<a href="#" onClick="deleteRole()" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
										<i class="ph-trash text-danger ph-2x mb-1"></i>
										Delete Role
									</a>
								</div>
								
								<div class="col">
									<a href="{{ url('dashboard/roles') }}" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
										<i class="ph-tree-structure text-primary ph-2x mb-1"></i>
										Role Permission 
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /actions -->

			 
				 
			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /left sidebar component -->

	</div>
	<!-- /inner container -->

</div>
<!-- /content area -->
   
<script>
	var id = window.location.pathname.split('/').pop();
	
	function loadDataRole(){
		$.ajax({
        data: {id:id},
        url: ServUrl+"/role/role_has_permission",
          method: 'GET',
          complete: function(response){ 
				       
              if(response.status == 200){
				var tbody = '';
				$('.role').html(response.responseJSON.data.role.name);
				
				tbody +='<div class="list-group-item bg-light fw-semibold text-primary">Permission by Role </div>'
				if(response.responseJSON.data.role.permissions.length == 0){
					tbody +='<div class="list-group-item text-center">No access for role '+response.responseJSON.data.role.name+'</div>'
				}
                $.each(response.responseJSON.data.role.permissions, function(k,v){
					
					tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container">';
							tbody +='<i class="ph-lock-key-open text-danger"></i>';
						tbody +='</a> ';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
						tbody +='</div>';
						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<input name="permission" value="'+v.name+'" type="checkbox" class="form-check-input ms-auto" checked>';
						tbody +='</div>';
					tbody +='</div>';
						
                });
				
				
				
				tbody +='<div class="list-group-item bg-light fw-semibold text-primary">Available Permission</div>';
				if(response.responseJSON.data.all_permission.length == 0){
					tbody +='<div class="list-group-item text-center">No access available for role</div>'
				}
				$.each(response.responseJSON.data.all_permission, function(k,v){
					var addClass = ''
                    $.each(response.responseJSON.data.role.permissions, function(a,b){
                        if (b.name == v.name) { addClass = 'checked'; }
                    });
					if(addClass == ''){
					tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container">';
							tbody +='<i class="ph-lock-key text-info"></i>';
						tbody +='</a> ';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
						tbody +='</div>';
						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<input name="permission" value="'+v.name+'" type="checkbox" class="form-check-input ms-auto">';
						tbody +='</div>';
					tbody +='</div>';
					} 			
				});
				
				
                $('#list-roles').html(tbody);
                 
				$('#total-data').html(response.responseJSON.data.role.length+' displayed data'); 
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
	loadDataRole();

	$(document).ajaxStop(function() {
        $("input[name='permission']").change(function(){
            if($(this).prop('checked') == true){  
                addPermission($(this).val(), id)
            }else{
                deletePermission($(this).val(), id)
            }
           
        });

    });
	
	function addPermission(name, id) {
		
		if(id){
			var path = ServUrl+"/role/permission/add";
            var data = {'name': name, 'id' : id};
		}
		swalInit.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, add it!',
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
							method: 'POST',
							complete: function(response){                
							if(response.status == 201){
								
									loadDataRole();
							
							}else{
								swalInit.fire({
										title: 'Aborted!',
										text: response.responseJSON.message,
										icon:'warning'
									});	
								 
								loadDataRole ();
							}
							},
							dataType:'json'
						});
					
                    }
                    else if(result.dismiss === swal.DismissReason.cancel) {
                        
						loadDataRole();
                    }
                });
				
	};
	
	function deletePermission(name, id) {
		
		if(id){
			var path = ServUrl+"/role/permission/delete";
            var data = {'name': name, 'id' : id};
		}
		
		swalInit.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
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
							data: data,
							url: path,
							method: 'DELETE',
							complete: function(response){                
							if(response.status == 200){
								swalInit.fire({
										title: 'Deleted!',
										text: response.responseJSON.message,
										icon:'success'
									}); 
									loadDataRole();
							
							}else{
								swalInit.fire({
										title: 'Aborted!',
										text: response.responseJSON.message,
										icon:'warning'
									});	
								 
								loadDataRole ();
							}
							},
							dataType:'json'
						});
					
                    }
                    else if(result.dismiss === swal.DismissReason.cancel) {
                        loadDataRole ();
                    }
                });
				
	};
	
	function deleteRole() {
		if(id){
			var path = ServUrl+"/role/delete";
		}
		
		swalInit.fire({
                    title: 'Are you sure?',
                    text: "Are you want to delete this Role",
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
                                        title: 'deleted!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                loadDataRole();
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

