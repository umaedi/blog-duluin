@extends('layouts.dashboard.app')
@section('content')
<script src="{{ asset('assets/dashboard/js/vendor/tables/datatables/datatables.min.js') }}"></script>
@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">

	<!-- Scrollable datatable -->
	<div class="card">
		<div class="card-header d-flex align-items-center py-0">
			<h5 class="py-3 mb-0"><i class="ph-list-checks me-2"></i> {{ $data['page_title'] }} <span class="company"> </span></h5>
			<div class="ms-auto my-auto">
					<div class="btn-group">
					<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Dropp Menu</button>
					<div class="dropdown-menu dropdown-menu-end">
						<a href="#" class="dropdown-item"><i class="ph-circles-four ph-lg me-3"></i> Filter</a>
						<a onClick="location.reload()" href="#" class="dropdown-item"><i class="ph-circles-four ph-lg me-3"></i> Reload</a>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div class="d-flex align-items-center mb-3 mb-sm-0">
				 
			</div>

			<div>
				<div class="btn-group">
					<a href="#" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Drop Menu</a>

					<div class="dropdown-menu">
						<a href="#" class="dropdown-item"><i class="ph-circles-four ph-lg me-3"></i> Filter</a>
						<a href="#" class="dropdown-item"><i class="ph-circles-four ph-lg me-3"></i> Reload</a>
						<a href="#" class="dropdown-item"><i class="ph-circles-four ph-lg me-3"></i> Import CSV</a>
					</div>
				</div>
			</div>
		</div> -->
				 

		<table class="table datatable-column-search-inputs" id="datatable-companies" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Employee Name</th>
					<th>Address</th>
					<th>Email Account</th>
					<th>Phone Number</th>
					<th>Company Name</th>
					<th>Status</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
	<!-- /scrollable datatable -->
	
	<!-- Scrollable datatable -->
	 
	<!-- /scrollable datatable -->

</div>
<!-- /content area -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
<script>
	const data 	= getUrlVars();
	//const option	= {is_approved: 'approved, waiting'};
	//let data		= {...params, ...option}; 
	// Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: true,
            selected: true,
			responsive: true,
			scrollX: true,
			scrollY: 300,
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });
	 	
	

	
	var table 	= $('#datatable-companies').DataTable( {  
		 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/employees",
					  "data": data,
				"dataSrc": function(json){
					  json.draw = json.data.draw;
					  json.recordsTotal = json.data.recordsTotal;
					  json.recordsFiltered = json.data.recordsFiltered;
					  return json.data.data;
					},
				"type": "POST",
				"complete"	: function (response) {
					 
						 $('.company').html(response.responseJSON.data.data[0].company.company_name)
					  },
			  },
			"columns": [
				{ "data": null },
				{ "data": "name"},
				{ "data": "address" },
				{ "data": "email" },
				{ "data": "phone_number" },
				{ "data": "company.company_name" },
				{ "data": "is_approved" },
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
							'<a href="#" id="open" class="dropdown-item"><i class="ph-magnifying-glass me-2"></i>'+
								'Detail'+
							'</a>'+
							'<a href="#" id="employees" class="dropdown-item"><i class="ph-list-numbers me-2"></i>'+
								'Data Loans'+
							'</a>'+
							//'<a href="#" id="delete" class="dropdown-item"><i class="ph-trash me-2"></i>'+
								//'Delete'+
							//'</a>'+
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
				
				if(data['is_approved'] == 'waiting'){
				$('td', row).addClass('table-danger');
				$('td', row).eq(-2).html('<span class="badge bg-danger">Menunggu Verifikasi</span>');
				}else if(data['is_approved'] == 'approved'){
				$('td', row).eq(-2).html('<span class="badge bg-success bg-opacity-20 text-success ms-2">Pengguna Aktif</span>');
				}
			}
		});
		
	$('#datatable-companies tbody').on( 'click', '#open', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];
		window.location.href = BaseUrl+"/dashboard/employees/view/"+id;
    } );
	
	$('#datatable-companies tbody').on( 'click', '#employees', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];
		window.location.href = BaseUrl+"/dashboard/loans?employee_id="+id;
    } );
			
	
	
</script> 
	
@endsection

