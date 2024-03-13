@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">
	<div class="mb-3">
		<h4 class="mb-2">Permission for user <span class="text-primary name"></span> </h4>
		<span class="text-muted">change manually permission by user here !</span>
	</div>
	<!-- Inner container -->
	<div class="row align-items-stretch align-items-lg-start">
		 

		<!-- Right content -->
		<div class=" col-lg-8 order-2 order-lg-1">
			<!-- Dropdown list -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">Permission list</h5>
				</div>

				<div class="list-group form-switch list-group-borderless py-2" id="list-permissions">
					
					
					
				</div>
				<div class="text-center mt-2 mb-4 gap-3">
				</div>
			</div>
			<!-- /dropdown list -->
			

		</div>
		<!-- /right content -->
		
		<!-- Right content -->
		<div class=" col-lg-4">
			<!-- Dropdown list -->
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0">User Roles</h5>
				</div>

				<div class="list-group form-switch list-group-borderless py-2" id="list-roles">
					
 
					
				</div>
				<div class="text-center mt-4 mb-4 gap-3">
					<a href="{{ url('/dashboard/users') }}" class="btn btn-danger btn-labeled btn-labeled-start">
						<span class="btn-labeled-icon bg-black bg-opacity-20">
							<i class="ph-caret-circle-left"></i>
						</span>
						Back
					</a>
					<a href="{{ url('/dashboard/roles') }}" class="btn btn-primary btn-labeled btn-labeled-start">
						<span class="btn-labeled-icon bg-black bg-opacity-20">
							<i class="ph-plus-circle"></i>
						</span>
						Create Role
					</a>        
				</div>
			</div>
			<!-- /dropdown list -->
			

		</div>
		<!-- /right content -->
		
	</div>
	<!-- /inner container -->

</div>
<!-- /content area -->
   
<script>
	let id = window.location.pathname.split('/').pop();
	let page = 1;
	let currentPage = 0;

	function loadData(role){
		$.ajax({
        data: {"page" : page, "perpage": 100},
        url: ServUrl+"/role/list",
          method: 'GET',
          complete: function(response){ 
            var tbody = '';       
              if(response.status == 200){
					
                $.each(response.responseJSON.data.role, function(k,v){
					var attr = '';
                    if(role == v.name){
                        attr = 'checked';
                    }
					tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold text-primary">'+v.name+'</div>';
							tbody +='<span class="text-muted">'+v.user+' user account</span>';
						tbody +='</div>';

						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<input type="checkbox" name="role" value="'+v.name+'" class="form-check-input ms-auto" '+attr+'>';
						tbody +='</div>';
					tbody +='</div>';
                   
                });
				
				if(page == 1){
					$('#list-roles').html(tbody);
				}else{
					$('#list-roles').append(tbody);
				}
				
				currentPage = response.responseJSON.data._meta.currentPage;
				  
                $('#loadMore').data("value", response.responseJSON.data._meta.currentPage); 
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
	 
	function loadPermissions(){	
	$.ajax({
		data: {"id" : id},
		url: ServUrl+"/user/permission",
				crossDomain: false,
				method: 'GET',
				complete: function(response){ 				
				if(response.status == 200){
					
					loadData(response.responseJSON.data.role_name[0]);
					
					$('#role').html(response.responseJSON.data.role_name[0]);
					$('.name').html(response.responseJSON.data.user.name);
					 
					var tbody = '';
					
						tbody +='<div class="list-group-item bg-light fw-semibold text-primary">Available Permission</div>';
					$.each(response.responseJSON.data.all_permission, function(k,v){
					var addClass = ''
						$.each(response.responseJSON.data.role, function(a,b){
							if (b.name == v.name) { addClass = 'checked'; }
						});
						$.each(response.responseJSON.data.direct_permission, function(c,d){
							if (d.name == v.name) { addClass = 'checked'; }
						});	
						if(addClass == ''){
							tbody +='<div class="list-group-item hstack gap-3">';
							tbody +='<a href="#" class="status-indicator-container"><i class="ph-lock-key text-info"></i></a>';
							tbody +='<div class="flex-fill">';
								tbody +='<div class="fw-semibold">'+v.name+'</div>';
							tbody +='</div>';
							tbody +='<div class="d-flex align-self-center dropdown ms-3">';
								tbody +='<input type="checkbox" name="permission" value="'+v.name+'" class="form-check-input ms-auto">';
							tbody +='</div>';
							tbody +='</div>'; 
						}
							
					});
						
						
						tbody +='<div class="list-group-item bg-light fw-semibold text-primary">Direct Permission</div>';
					$.each(response.responseJSON.data.direct_permission, function(k,v){
						
						tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container"><i class="ph-lock-key-open text-danger"></i></a>';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
						tbody +='</div>';
						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<input type="checkbox" name="permission" value="'+v.name+'" class="form-check-input ms-auto" checked>';
						tbody +='</div>';
						tbody +='</div>'; 
					 
						 
					});
					
						
						tbody +='<div class="list-group-item bg-light fw-semibold text-primary">Permission by Role</div>';
					$.each(response.responseJSON.data.role, function(k,v){
						tbody +='<div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container"><i class="ph-lock-key-open text-danger"></i></a>';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
						tbody +='</div>';
						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<input type="checkbox" name="permissionRole" checked class="form-check-input ms-auto">';
						tbody +='</div>';
						tbody +='</div>'; 
						 
						 
					});
					$('#list-permissions').html(tbody);
					
					
					}else if(response.status == 401){
						e('info','401 server conection error');
					}
				},
			dataType:'json'
			})
	};
	loadPermissions();
	
	$( document ).ajaxStop(function() {
        $("input[name='permission']").change(function(){
            if($(this).prop('checked') == true){  
                addPermission($(this).val(), id)
            }else{
                deletePermission($(this).val(), id)
            }
           
        });

        $("input[name='role']").change(function(){
            if($(this).prop('checked') == true){  
                addRole($(this).val(), id)
            }
        });

        $("input[name='permissionRole']").change(function(){
             new Noty({
                    text: 'Na`nah, unable to change the permission !',
                    type: 'error'
                }).show();
			 
            $("input[name='permissionRole']").prop('checked', true)
        });
    });
	
	function addPermission(permission, id) {
		event.preventDefault();

		if(id){
			var path = ServUrl+"/user/permission";
            var data = {'permission': permission, 'id' : id};
		}
		
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
						method: 'POST',
						complete: function(response){                
						if(response.status == 201){
							swalInit.fire({
									title: 'Saved!',
									text: response.responseJSON.message,
									icon:'success'
								}); 
								loadPermissions();
						}else{
							swalInit.fire({
									title: 'Aborted!',
									text: response.responseJSON.message,
									icon:'warning'
								});	
								loadPermissions(); 
						}
						},
						dataType:'json'
				});
			 
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				loadPermissions();
			}
		});
				
	};
	
	function deletePermission(permission, id) {
		event.preventDefault();

		if(id){
			var path = ServUrl+"/user/permission";
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
						data: {'permission': permission, 'id' : id},
						url: path,
						method: 'DELETE',
						complete: function(response){                
						if(response.status == 200){
							swalInit.fire({
									title: 'deleted!',
									text: response.responseJSON.message,
									icon:'success'
								}); 
								loadPermissions();
						}else{
							swalInit.fire({
									title: 'Aborted!',
									text: response.responseJSON.message,
									icon:'warning'
								});	
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
	
	 function addRole(role, id) {
		 
		if(id){
			var path = ServUrl+"/user/role";
            var data = {'role': role, 'id' : id};
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
						crossDomain: false,
						method: 'POST',
						complete: function(response){                
						if(response.status == 201){
							swalInit.fire({
									title: 'Saved!',
									text: response.responseJSON.message,
									icon:'success'
								}); 
								loadPermissions();
						}else{
							swalInit.fire({
									title: 'Aborted!',
									text: response.responseJSON.message,
									icon:'warning'
								});	
							 
							loadPermissions(); 
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
				
	};

</script>	
@endsection

