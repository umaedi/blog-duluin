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

			 
		</div>
				 

		<table class="table small" id="datatable-leads" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Log Name</th>
					<th>Causer</th>
					<th>Event</th>
					<th>Subject</th>
					<th>Created At</th>
					 
					 
				</tr>
			</thead>
			<tbody>
			<tr><td colspan="6" ><div class="placeholder-glow"><span class="placeholder col-12"></span></div></td></tr>
			</tbody>
		</table>
	</div>
	<!-- /scrollable datatable -->

</div>
<!-- /content area -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
<script>
	var data 	= getUrlVars();
	
	 $.extend( $.fn.dataTable.defaults, {
            autoWidth: true,
            selected: true,
			responsive: true,
			scrollX: true,
            columnDefs: [{ 
                orderable: false,
                
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
		
	 
	
	var table 	= $('#datatable-leads').DataTable( {  
		"scrollY": 400, 
		"responsive": true, 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/activity",
					  "data": data,
				"dataSrc": function(json){
					  json.draw = json.data.draw;
					  json.recordsTotal = json.data.recordsTotal;
					  json.recordsFiltered = json.data.recordsFiltered;
					  console.log(json);
					  return json.data.data;
					},
				"type": "GET",
				"complete"	: function (response) {
						 
					  },
			  },
			"columns": [
				{ "data": null },
				{ "data": "log_name"},
				{ "data": "causer" },
				{ "data": "event" },
				{ "data": "subject" },
				{ "data": "created_at" },
				 
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
		
	$('#datatable-leads tbody').on( 'click', '#open', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];
		window.location.href = BaseUrl+"/dashboard/leads/view/"+id;
    } );
			
	$('#datatable-leads tbody').on( 'click', '#delete', function ( ) {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];
		var name = data['name'];
		 
		destroy(id, name);
     } ); 
	 
	 
	 
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
                        url: ServUrl+"/lead",
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

