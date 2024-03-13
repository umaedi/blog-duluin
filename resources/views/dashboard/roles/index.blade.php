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
					<h5 class="mb-0">Roles list</h5>
				</div>

				<div class="list-group list-group-borderless py-2" id="list-roles">
					
				 
					
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
									<a href="#" onClick="create()" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
										<i class="ph-list-plus text-primary ph-2x mb-1"></i>
										Create Role 
									</a>

									
								</div>
								
								<div class="col">
									

									<a href="{{ url('dashboard/users') }}" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
										<i class="ph-users-three text-info ph-2x mb-1"></i>
										User Account
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
 <!-- Iconified modal -->
<div id="createRole" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="form-role" action="#" class="form-horizontal">
		<input name="id" type="hidden" class="form-control">
		{{ csrf_field() }}
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="ph-list me-2"></i>
					Form Role
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			<div class="modal-body">
				<div class="alert alert-info alert-icon-start alert-dismissible">
					<span class="alert-icon bg-info text-white">
						<i class="ph-info"></i>
					</span>
					<span class="fw-semibold">Here we go!</span> make sure Role Name be filled out.
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				<div class="row mb-3">
					<label class="col-form-label col-sm-3">Role name</label>
					<div class="col-sm-9">
						<input name="name" type="text" placeholder="Role name" class="form-control" required>
					</div>
				</div>
			</div>
			
			<div class="modal-footer justify-content-between">
				<!--<button type="submit" class="btn btn-flat-danger btn-icon">
					<i class="ph-trash"></i>
					Delete
				</button> -->
				<button type="submit" class="btn btn-primary">
					<i class="ph-check me-1"></i>
					Save
				</button>
			</div>
		</form>
		</div>
	</div>
</div>
<!-- /iconified modal -->   
<script>
	let page = 1;
	let currentPage = 0;
	
	function loadData(page){
		$.ajax({
        data: {"page" : page, "perpage": 8},
        url: ServUrl+"/role/list",
          method: 'GET',
          complete: function(response){ 
            var tbody = '';       
              if(response.status == 200){
				if(response.responseJSON.data.role.length == 0){
				  $('#loadMore').hide();
				}else{
				  $('#loadMore').show();
				}
                $.each(response.responseJSON.data.role, function(k,v){
                     
                   tbody +=' <div class="list-group-item hstack gap-3">';
						tbody +='<a href="#" class="status-indicator-container">';
							tbody +='<i class="ph-tree-structure text-pink"></i>';
						tbody +='</a> ';
						tbody +='<div class="flex-fill">';
							tbody +='<div class="fw-semibold">'+v.name+'</div>';
							tbody +='<span class="text-muted">'+v.user+' user account</span>';
						tbody +='</div>';

						tbody +='<div class="d-flex align-self-center dropdown ms-3">';
							tbody +='<a href="#" class="text-body d-inline-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">';
								tbody +='<i class="ph-list"></i>';
							tbody +='</a>';

							tbody +='<div class="dropdown-menu dropdown-menu-end">';
								tbody +='<a href="{{ url('dashboard/roles/view/') }}/'+v.id+'" class="dropdown-item">';
									tbody +='<i class="ph-lock-key-open me-2"></i>';
									tbody +='Permission Detail';
								tbody +='</a>';
								tbody +='<a href="#" data-id="'+v.id+'" data-name="'+v.name+'" class="dropdown-item update" data-bs-toggle="modal" data-bs-target="#chat">';
									tbody +='<i class="ph-shield-check me-2"></i>';
									tbody +='Update role name';
								tbody +='</a>';
								tbody +='<a href="#" onClick="destroy('+v.id+')" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#video">';
									tbody +='<i class="ph-trash me-2"></i>';
									tbody +='Delete roles';
								tbody +='</a>';
							tbody +='</div>';
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
	loadData(page);
	
	function loadMore(){
		var page = currentPage+1;
		loadData(page);		
	};
	
	var modal = new bootstrap.Modal(document.getElementById('createRole'), {
	  keyboard: false,
	  backdrop: 'static'
	})
	
	function create() {		 
	    modal.show();
        $('#createRole').find('#form-role')[0].reset();
		$("#form-role input:hidden").val('');
            
	};
	
	 $(document).ajaxStop(function(){
        $( ".update" ).on( "click", function(event) {
            $('#createRole').find('#form-role')[0].reset();
            var id = $(this).data("id");
            var name = $(this).data("name");
            $("input[name=id]").val(id);
            $("input[name=name]").val(name);
            
            modal.show();
        });   
	});
	
	$('#createRole').on('shown.bs.modal', function () {
        $("input[name=name]").focus();
        $(":submit").prop("disabled", false);
    });
	
	$("#form-role").submit(function(event) {
		event.preventDefault();
        var id = $("input[name=id]").val();
        if(id){
            var path = ServUrl+"/role/update";
        }else{
            var path = ServUrl+"/role/create";
        }

      	var data = $(this).serialize();
		
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
                        crossDomain: false,
                        method: 'POST',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);
						  modal.hide();						  
                          if(response.status == 201){
							swalInit.fire({
							  title: 'Saved!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							  
							loadData(1);
                          }else{
							swalInit.fire({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
								  
							loadData(1);   
                          }
                        },
                        dataType:'json'
                });
           
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				 
			}
		});
				
	});
	
	function destroy(id){
		if(id){
			var data = { "id" : id};
			
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
                        url: ServUrl+"/role/delete",
                        crossDomain: false,
                        method: 'DELETE',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);						
                          if(response.status == 200){
							swalInit.fire({
							  title: 'Delete!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							  
							loadData(1);
                          }else{
							swalInit.fire({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
								  
							loadData(1);   
                          }
                        },
                        dataType:'json'
					});
           
				}
				else if(result.dismiss === swal.DismissReason.cancel) {
					loadData(page); 
				}
			});
			 
		}	
	}
</script>
@endsection

