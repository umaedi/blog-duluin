@extends('layouts.dashboard.app')
@section('content')
<script src="{{ asset('assets/dashboard/js/vendor/tables/datatables/datatables.min.js') }}"></script>
@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Scrollable datatable -->
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">{{ $data['page_title'] }}</h5>
		</div>

		<div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div>
				<div class="btn-group">
					<a href="#" class="btn btn-indigo dropdown-toggle" data-bs-toggle="dropdown"><i class="ph-list me-2"></i>  Drop Menu</a>

					<div class="dropdown-menu">
						<a href="{{ url('dashboard/banners/create') }}" class="dropdown-item"><i class="ph-plus ph-lg me-2"></i> Create</a>
						<a href="javascript:location.reload()" class="dropdown-item"><i class="ph-arrows-clockwise ph-lg me-2"></i> Reload</a>
						
					</div>
				</div>
			</div>
		</div>
				 

		<table class="table datatable-column-search-inputs" id="datatable" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Position</th>
					<th>Description</th>
					<th>Link</th>
					<th>Status</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<tr><td colspan="7" ><div class="placeholder-glow"><span class="placeholder col-12"></span></div></td></tr>
			</tbody>
		</table>
	</div>
	<!-- /scrollable datatable -->

</div>
<!-- /content area -->


<script>
	let id 		= window.location.pathname.split('/').pop();
	let data 	= getUrlVars();
	
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
		
	
	var table 	= $('#datatable').DataTable( {  
		"scrollY": 350, 
		"responsive": true, 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/banners",
					  "data": data,
				"dataSrc": function(json){
					  json.draw = json.data.draw;
					  json.recordsTotal = json.data.recordsTotal;
					  json.recordsFiltered = json.data.recordsFiltered;
					  return json.data.data;
					},
				"type": "POST",
				"complete"	: function (response) {
						 
					  },
			  },
			"columns": [
				{ "data": null },
				{ "data": "position"},
				{ "data": "description" },
				{ "data": "link" },
				{ "data": "status" },
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
							//'<a href="#" id="open" class="dropdown-item"><i class="ph-magnifying-glass me-2"></i>'+
								//'Detail'+
							//'</a>'+
							'<a href="#" id="update" class="dropdown-item"><i class="ph-pencil me-2"></i>'+
								'Update'+
							'</a>'+
							'<a href="#" id="delete" class="dropdown-item"><i class="ph-trash me-2"></i>'+
								'Delete'+
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
					data['created_at'] = localDate(data['created_at']);
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			}],
			"createdRow": function ( row, data, index ) {
				$('td', row).eq(-1).addClass('text-center');
				if(data['status'] == 'publish'){
				$('td', row).eq(-2).html('<span class="badge bg-success">Publish</span>');
				}else if(data['status'] == 'unpublish'){
				$('td', row).eq(-2).html('<span class="badge bg-danger">Unpublish</span>');
				}
			}
		});
	
	$('#datatable tbody').on( 'click', '#update', function ( ) {
        var data = table.row( $(this).parents('tr') ).data();
		setTimeout(function(){
			location.href = BaseUrl+'/dashboard/banners/update/'+data['id'];
		}, 800);
		
     }); 
	 
	 $('#datatable tbody').on( 'click', '#delete', function ( ) {
        var data = table.row( $(this).parents('tr') ).data();

		destroy(data['id']);
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
				  if (result.value) {
                    $.ajax({
                        data: data,
                        url: ServUrl+"/banners/delete",
                        crossDomain: false,
                        method: 'DELETE',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);						
                          if(response.status == 200){
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
        });
		}	
	}
</script> 
	
@endsection

