@extends('layouts.dashboard.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	
	<!-- Latest orders -->
	<div class="card">
		<div class="card-header d-flex align-items-center py-0 ">
			<h5 class="py-3 mb-0"><i class="ph-list-checks me-2"></i> {{ $data['page_title'] }}</h5>
			<div class="ms-sm-auto my-sm-auto">
				 
			</div>
			
			
		</div>
		<div class="card-body">
			<div class="row">
			 
				<div class="col-lg-4">		
				
				</div>
				<div class="col-lg-4">		
				
				</div>
				<div class="col-lg-4">		
				<div class="row mb-2">
					<label class="col-auto col-form-label">Nama :</label>
					
					 
					<div class="col-lg-8">
						<input id="search" type="search" class="form-control" placeholder="Search Title..." aria-controls="datatable-news">
						
					</div>
				</div>
				</div>
				
			</div>

		</div>
		 
		<div class="table-responsive">
			<table class="small table text-nowrap datatable-column-search-inputs" id="datatable-news" width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Title</th>
						<th>Category</th>
						<th>Tags</th>
						
						<th>Creator</th>
						<th>Viewer</th>
						<th>Created At</th>
						<th>Status</th>
						 
						<th class="text-center" style="width: 20px;"><i class="ph-arrow-circle-down"></i></th>
					</tr>
				</thead>
				<tbody>
				<tr><td colspan="11" ><div class="placeholder-glow"><span class="placeholder col-12"></span></div></td></tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /latest orders -->
	
	
</div>
<!-- /content area -->

<script src="{{ asset('assets/dashboard/js/vendor/tables/datatables/datatables.min.js') }}"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script> 
<script src="{{ asset('assets/dashboard/js/vendor/forms/selects/select2.min.js') }}"></script>
<script>
//$('.sidebar-expand-lg').addClass('sidebar-main-resized');

$('.form-control-select2').select2({
	minimumResultsForSearch: Infinity
});
	
	// Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: true,
            selected: true,
			responsive: true,
			scrollX: true,
			scrollY: 350,
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: { orthogonal: 'export' }
				},
				{
					extend: 'excelHtml5',
					exportOptions: { orthogonal: 'export' }
				},
				{
					extend: 'csvHtml5',
					exportOptions: { orthogonal: 'export' }
				},
				{
					extend: 'pdfHtml5',
					exportOptions: { orthogonal: 'export' }
				}
			     
			],
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"B><"datatable-scroll"t><"datatable-footer"lip>',
            language: {
                search: '<span class="me-3">Filter :</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Search Title...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });
		
$(document).ready(function() {

	let table = '';
	
	function loadNews(){
	  table  	= $('#datatable-news').DataTable( {  
		 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/articles",
				"data": function(data) {
				   data.status = 'waiting';
				   data.month = $("#month").val();
				   data.year = $("#year").val();
				   
				   return data;
				},
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
				{ "data": "title"},
				{ "data": "category_name"},
				{ "data": "tags" },
				
				{ "data": "creator.name" },
				{ "data": "viewer" },
				{ "data": "created_at" },
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
							'<a href="#" id="open" class="dropdown-item"><i class="ph-receipt me-2"></i>'+
								'Detail'+
							'</a>'+
							'<a href="#" id="approved" class="dropdown-item verify"><i class="ph-check me-2"></i>'+
								'Publish'+
							'</a>'+
							'<a href="#" id="update" class="dropdown-item"><i class="ph-pencil me-2"></i>'+
								'Update'+
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
				if(data['status'] != 'waiting'){
					$('td', row).find('.verify').addClass('d-none');
				}
				$('td', row).eq(-1).addClass('text-center');
				if(data['status'] == 'draft'){
				$('td', row).eq(-2).html('<span class="badge bg-warning">Draft</span>');
				}else if(data['status'] == 'waiting'){
				$('td', row).addClass('table-danger');
				$('td', row).eq(-2).html('<span class="badge bg-warning">Waiting</span>');
				}else if(data['status'] == 'unpublish'){
				$('td', row).eq(-2).html('<span class="badge bg-danger">Unpublish</span>');
				}else if(data['status'] == 'publish'){
				$('td', row).eq(-2).html('<span class="badge bg-success">Publish</span>');
				}				
			}
		});
	}
	$('#search').on( 'keyup', function () {
		table.search( this.value ).draw();
	});
	
	$('#year').on( 'change', function () {
	table.ajax.reload();
	});

	$('#month').on( 'change', function () {
		table.ajax.reload();
	});
		
	$('#datatable-news tbody').on( 'click', '#open', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];	
			window.location.href = BaseUrl+"/dashboard/articles/detail/"+id;
    });
	
	loadNews()
});

</script> 
	
@endsection

