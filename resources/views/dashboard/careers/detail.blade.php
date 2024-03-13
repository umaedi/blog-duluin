@extends('layouts.dashboard.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

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
										</div>

										<h3 class="card-title pt-2 mb-1">
											<a href="#" class="text-body title">
												<div class="placeholder-glow"><span class="placeholder col-6"></span></div>
											</a>
										</h3>

										<ul class="list-inline list-inline-bullet text-muted mb-3">
											<li class="list-inline-item">Job Type : <a href="#" class="type"><span class="placeholder-glow"><span class="placeholder col-4"></span></span></a></li>
											<li class="list-inline-item">Experience : <a href="#" class="experience"><span class="placeholder-glow"><span class="placeholder col-4"></span></span></a></li>
											
										</ul>

										<div class="mb-3" id="content">
										<div class="placeholder-glow"><span class="placeholder col-12"></span></div>
										</div>
										
									</div>
								</div>
							</div>
							<!-- /post -->


							<!-- Comments -->
							<div class="card">
								
								<div class="card-body">
								
								<div class="text-end mt-2 mb-2">
									<a type="button" href="{{ url('dashboard/careers') }}" class="btn btn-primary ms-1">
									<i class="ph-arrow-fat-line-left me-2"></i>
										Back 
									</a>
									<button type="button" onClick="deletePages()" class="btn btn-danger ms-1">
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
							</div>
							<!-- /comments -->
							
							<!-- Latest orders -->
							<div class="card">
								<div class="card-header d-flex align-items-center py-0 ">
									<h5 class="py-3 mb-0"><i class="ph-list-checks me-2"></i>List Applicants</h5>
									<div class="ms-sm-auto my-sm-auto">
										 
									</div>
									<div class="ms-2">
									<div class="wmin-250">
										<select id="switchStatus" class="form-control form-control-select2">
											<optgroup label="Pages Status">
												<option value="">All Status</option>
												
												<option value="waiting">Waiting</option>
												<option value="replied">Replied</option>
												
											</optgroup>
										</select>
									</div>
								</div>
									
									
								</div>
								<div class="card-body">
									<div class="row">
									 
										<div class="col-lg-4">		
										<div class="row mb-2">
											
										</div>
										</div>
										<div class="col-lg-4">		
										<div class="row mb-2">
											
										</div>
										</div>
										<div class="col-lg-4">		
										<div class="row mb-2">
											<label class="col-auto col-form-label">Nama :</label>
											
											 
											<div class="col-lg-8">
												<input id="search" type="search" class="form-control" placeholder="Search Name..." aria-controls="datatable-careers">
												
											</div>
										</div>
										</div>
										
									</div>

								</div>
								 
								<div class="table-responsive">
									<table class="small table text-nowrap datatable-column-search-inputs" id="datatable-applicants" width="100%">
										<thead>
											<tr>
												<th>No.</th>
												<th>Name</th>
												<th>Gender</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Graduated</th>
												<th>Document</th>
												<th class="text-center" style="width: 20px;"><i class="ph-arrow-circle-down"></i></th>
											</tr>
										</thead>
										<tbody>
										<tr><td colspan="7" ><div class="placeholder-glow"><span class="placeholder col-12"></span></div></td></tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /latest orders -->

						</div>
						<!-- /left content -->


						
					</div>
					<!-- /inner container -->

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
$('.form-control-select2').select2({
	minimumResultsForSearch: Infinity
});
	let id = window.location.pathname.split('/').pop();
	
	
	function loadView(){
		
		$.ajax({
					data: { "id" : id},
					url: ServUrl+"/careers/detail",
					crossDomain: false,
					method: 'GET',
					complete: function(response){ 				
						if(response.status == 200){
							var careers = response.responseJSON.data.careers;
							if(careers.status == 'publish'){
								$('#publish').addClass('d-none');
								$('#unpublish').removeClass('d-none');
							}else if((careers.status == 'unpublish') || (careers.status == 'draft') || (careers.status == 'waiting')){
								$('#unpublish').addClass('d-none');
								$('#publish').removeClass('d-none');
							}
							$('.title').html(careers.position);
							$('.type').html(careers.type);
							$('.experience').html(careers.experience);
							$('#pathImg').attr('src', careers.img);
							$('#content').html(careers.description);
							loadApplicants();
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
			location.href = BaseUrl+'/dashboard/careers/update/'+id;
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
			var path = ServUrl+"/careers/verify";
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
                                        title: 'saved!',
                                        text: response.responseJSON.message,
                                        icon:'success'
                                    }); 
                                setTimeout(function(){
									location.href = BaseUrl+'/dashboard/careers/'; 
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                //location.href = BaseUrl+'/dashboard/careers/'; 
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
	
	function deletePages() {
		if(id){
			var path = ServUrl+"/careers/delete";
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
									loadView();
								}, 800);
                            }else{
                                swalInit.fire({
                                        title: 'Aborted!',
                                        text: response.responseJSON.message,
                                        icon:'warning'
                                    });	
                                 
                                location.href = BaseUrl+'/dashboard/careers'; 
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
	
	let table = '';
	
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
	
	function loadApplicants(){
	  table  	= $('#datatable-applicants').DataTable( {  
		 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/applicants",
				"data": function(data) {
				   data.status = $('#switchStatus').val();
				   data.career_id = id;
				   
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
				{ "data": "name"},
				{ "data": "gender"},
				{ "data": "email"},
				{ "data": "phone" },
				{ "data": "graduated" },
				{ "data": "document" },
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
							'<a href="#" id="reply" class="dropdown-item reply"><i class="ph-check me-2"></i>'+
								'Reply'+
							'</a>'+
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
					$('td', row).find('.reply').addClass('d-none');
				}
				$('td', row).eq(-1).addClass('text-center');
				$('td', row).eq(-2).html('<a href="'+data.document_url+'" class="btn btn-primary btn-sm" target="_blank"> Unduh </a>');
								
			}
		});
	}
	$('#search').on( 'keyup', function () {
		table.search( this.value ).draw();
	});
	
	$('#datatable-applicants tbody').on( 'click', '#open', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var id = data['id'];	
			window.location.href = BaseUrl+"/dashboard/applicants/detail/"+id;
    });
	
	$('#switchStatus').on( 'change',function () {
		let switchLoanStatus = $(this).val();
		 
		if ( ! $.fn.DataTable.isDataTable( '#datatable-applicants' ) ) {
			loadApplicants();
		}else{
			 
			table.ajax.reload();
		}
		 
    });
	


</script> 
	
@endsection

