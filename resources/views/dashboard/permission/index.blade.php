@extends('layouts.dashboard.app')
@section('content')
<script src="{{ asset('assets/dashboard/js/vendor/tables/datatables/datatables.min.js') }}"></script>
@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Scrollable datatable -->
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Permissions List</h5>
		</div>

		<div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div>
				<a onClick="create()" href="#" class="btn btn-indigo">
					<i class="ph-plus me-2"></i>
					Create Permission
				</a>
			</div>
		</div>
				 

		<table class="table" id="datatable-permissions" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Permission Name</th>
					<th>Guard</th>
					<th>Create At</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
	<!-- /scrollable datatable -->

</div>
<!-- /content area -->

<!-- Iconified modal -->
<div id="createPermission" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="form-permission" action="#" class="form-horizontal">
		{{ csrf_field() }}
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="ph-list me-2"></i>
					Form Permission
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			<div class="modal-body">
				<div class="alert alert-info alert-icon-start alert-dismissible">
					<span class="alert-icon bg-info text-white">
						<i class="ph-info"></i>
					</span>
					<span class="fw-semibold">Disclaimer!</span> Make sure the permission name is right.
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				<div class="row mb-3">
					<label class="col-form-label col-sm-3">Permission name</label>
					<div class="col-sm-9">
						<input name="name" type="text" placeholder="Permission name" class="form-control">
					</div>
				</div>
			</div>
			
			<div class="modal-footer justify-content-between">
				<!--<button type="submit" class="btn btn-flat-danger btn-icon">
					<i class="ph-trash"></i>
					Delete
				</button> -->
				<button class="btn btn-primary" data-bs-dismiss="modal">
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
	var data 	= getUrlVars();
	
	 $.extend( $.fn.dataTable.defaults, {
            autoWidth: true,
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
			buttons: {
                dom: {
                    button: {
                        className: 'btn btn-light'
                    }
                },
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel'},
                    {extend: 'pdf'},
                    {extend: 'print'}
                ]
            },
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ipB>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });
		
	 
	var table 	= $('#datatable-permissions').DataTable( { 
		 
		"scrollY": 300, 
		"responsive": true, 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/permission/list",
					  "data": data,
				"dataSrc": function(json){
					  json.draw = json.data.draw;
					  json.recordsTotal = json.data.recordsTotal;
					  json.recordsFiltered = json.data.recordsFiltered;

					  return json.data.data;
					},
				"type": "GET",
				"complete"	: function (response) {
						 
					  },
			  },
			"columns": [
				{ "data": null },
				{ "data": "name"},
				{ "data": "guard_name" },
				{ "data": "created_at" },
				{ "data": null },
				],
			"columnDefs": [{
				"targets": -1,
				"data": null,
				"orderable": false,
				"defaultContent":
					'<div class="dropdown">'+
						'<a href="#" class="text-body" data-bs-toggle="dropdown"><i class="ph-list"></i></a>'+
						'<div class="dropdown-menu dropdown-menu-end">'+
							//'<a href="#" class="dropdown-item"><i class="ph-chart-line me-2"></i>'+
								//'View statement'+
							//'</a>'+
							//'<a href="#" class="dropdown-item"><i class="ph-pencil me-2"></i>'+
								//'Edit campaign'+
							//'</a>'+
							'<a href="#" id="delete" class="dropdown-item"><i class="ph-lock-key me-2"></i>'+
								'Delete Permission'+
							'</a>'+
							//'<div class="dropdown-divider"></div>'+
							//'<a href="#" class="dropdown-item"><i class="ph-gear me-2"></i>'+
								//'Settings'+
							//'</a>'+
						'</div>'+
					'</div>'
				},{
				"searchable": false,
				"orderable": false,
				"targets": 0,
				"data": "id",
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			}],
			"createdRow": function ( row, data, index ) {
				$('td', row).eq(-1).addClass('text-center');
			} 
		});
		
	$('#datatable-permissions tbody').on( 'click', '#delete', function ( ) {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];
		var name = data['name'];
		 
		destroy(id, name);
     } ); 
	 
	var createPermission = new bootstrap.Modal(document.getElementById('createPermission'), {
	  keyboard: false,
	  backdrop: 'static'
	})
	
	function create() {
		 
	    createPermission.show();
        $('#createPermission').find('#form-permission')[0].reset();
            
	};
	
	$('#createPermission').on('shown.bs.modal', function () {
        $("input[name=name]").focus();
        $(":submit").prop("disabled", false);
    });
	
	$("#form-permission").submit(function(event) {
		event.preventDefault();
        var id = $("input[name=id]").val();
        if($.isNumeric(id)){
            var path = ServUrl+"/permission/update/"+id;
        }else{
            var path = ServUrl+"/permission/create";
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
                          if(response.status == 201){
							swalInit.fire({
							  title: 'Saved!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							  
							table.ajax.reload();
                          }else{
							swalInit.fire({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
								  
							table.ajax.reload();  
                          }
                        },
                        dataType:'json'
                });
				 
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				 table.ajax.reload();
			}
		});
				
	});
	
	function destroy(id, name){
		if($.isNumeric(id)){
			var data = { "id" : id, "name": name};
			swal("Are you sure?", {
				buttons: {
					cancel: "No, cancel!!",
					catch: {
						text: "Yes, delete it!",
						value: "yes",
					},  
				},
                })
                .then((value) => {
					if(value == 'yes'){
					$(":submit").prop("disabled", true);
                    createPermission.hide();
					
                    $.ajax({
                        data: data,
                        url: ServUrl+"/permission/delete/",
                        crossDomain: false,
                        method: 'DELETE',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);						
                          if(response.status == 201){
							swal({
							  title: 'Saved!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							  
							table.ajax.reload();
                          }else{
							swal({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
								  
							table.ajax.reload();   
                          }
                        },
                        dataType:'json'
                });
            }
        });
		}	
	}
</script> 
	
@endsection

