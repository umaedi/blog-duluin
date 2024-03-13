@extends('layouts.dashboard.app')
@section('content')
<script src="{{ asset('assets/dashboard/js/vendor/tables/datatables/datatables.min.js') }}"></script>
@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
<div class="content">
  <div class="row">
	<div class="col-lg-12">
		<div class="text-end mt-4 mb-4 gap-3">
			<a id="reject" onClick="verifyUser('reject')" href="#" class="btn btn-danger btn-labeled btn-labeled-start my-2 me-2" hidden>
				<span class="btn-labeled-icon bg-black bg-opacity-20">
					<i class="ph-x"></i>
				</span>
				<span class="mx-2">Reject </span>
			</a>
			<a id="approve" onClick="verifyUser('approve')" href="#" class="btn btn-success btn-labeled btn-labeled-start my-2 me-2" hidden>
				<span class="btn-labeled-icon bg-black bg-opacity-20">
					<i class="ph-check"></i>
				</span>
				<span class="mx-2">Approve </span>
			</a>  
			<a id="disable" onClick="verifyUser('disable')" href="#" class="btn btn-warning btn-labeled btn-labeled-start my-2" hidden>
				<span class="btn-labeled-icon bg-black bg-opacity-20">
					<i class="ph-lock-key"></i>
				</span>
				<span class="mx-2">Disable Account</span>
			</a>			
		</div>
	</div>
	<!-- Profile info -->
	<div class="col-lg-7">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">{{ $data['page_title'] }}</h5>
		</div>

		<div class="card-body">
			<form id="form-user" action="#">
				<div class="row">
					<div class="col-lg-12">
					<div class="alert alert-danger alert-icon-start alert-dismissible fade show" hidden>
						<span class="alert-icon bg-danger text-white">
							<i class="ph-x-circle"></i>
						</span>
						This lead aren't register as a borrower.
						<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Employee Name</label>
							<input name="name" type="text" value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Responsible Name</label>
							<input name="responsible_name" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Company Name</label>
							<input name="company_name" type="text" value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Employee ID</label>
							<input name="employee_id_card" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Address</label>
							<textarea name="address" type="text" value="" class="form-control" disabled></textarea>
						</div>
					</div> 
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Birthday Address</label>
							<textarea name="birthday_address" type="text" value="" class="form-control" disabled></textarea>
						</div>
					</div> 
					
					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Birthday Date</label>
							<input name="birthday_date" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Phone Number</label>
							<input name="phone_number" type="text" value="" class="form-control" placeholder="" disabled>
						</div>
					</div> 
					
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Email Account</label>
							<input name="email" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Created At</label>
							<input name="created_at" type="text" value="" class="form-control" disabled>
							 
						</div>
					</div>

					
				</div>

				<legend class="fs-base fw-bold border-bottom mt-4 pb-2 mb-3">Emergency information</legend>
				<div class="row">
					
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Emergency Name</label>
							<input name="emergency_name" type="text" value="" class="form-control" placeholder="" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Emergency Relation</label>
							<input name="emergency_relation" type="text" value="" class="form-control" placeholder="" disabled>
						</div>
					</div>
					
				</div>
				
				<div class="row">
					
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Emergency Phone</label>
							<input name="emergency_phone_number" type="text" value="" class="form-control" placeholder="" disabled>
						</div>
					</div>
					 
					
				</div>

				
			</form>
		</div>
	</div>
	</div>
	<!-- /profile info -->
	<!-- Account settings -->
	<div class="col-lg-5">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0">Additional Information</h5>
		</div>
		
		<div class="card-body">
			<!-- Actions -->
			<div class="sidebar-section mb-4">
				<form id="form-user" action="#">
				<div class="row">
					<div class="col-lg-12">
						<div class="mb-3">
							<label class="form-label">Monthly Salary</label>
							<div class="input-group">
								<span class="input-group-text">Rp.</span>
								<input name="mounthly_salary" type="text" class="form-control" placeholder="" disabled>
								 
							</div>
							 
						</div>
					</div>
					 
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Bank Payroll</label>
							<input name="bank_payroll" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Bank Number</label>
							<input name="bank_account_number" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				<legend class="fs-base fw-bold border-bottom mt-4 pb-2 mb-3">Company information</legend>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Employees Total</label>
							<input name="company_employees_total" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Cutoff Date</label>
							<input name="cutoff_date" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Company Payday</label>
							<input name="company_payday" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Start Payroll Date</label>
							<input name="start_payroll_date" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">End Payroll Date</label>
							<input name="end_payroll_date" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
					
				</div>
				<div class="row">
					 
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Total Working Days</label>
							<input name="total_working_days" type="text"  value="" class="form-control" disabled>
						</div>
					</div>
				</div>
				
				</form>
				<hr>
				<div class="collapse show" id="sidebar-actions">
					<div class="sidebar-section-body">
						<div class="row row-tile g-0">
							<div class="col">
								<a href="#" onClick="approveUser()" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-bottom-end py-2">
									<i class="ph-identification-card text-secondary ph-2x mb-1"></i>
									KTP
								</a>
							</div>
							
							<div class="col">
								<a href="#"  onClick="resetPassword()" type="button" class="btn btn-light w-100 flex-column rounded-0 rounded-top-start py-2">
									<i class="ph-identification-badge text-secondary ph-2x mb-1"></i>
									Selfie Photo
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /actions -->
			
		</div>
	</div>
	</div>
	<!-- /account settings -->
	
	<div class="col-lg-12">
		<!-- Scrollable datatable -->
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0"><i class="ph-money me-2"></i>Loan Balance <span class="max_loan_percent"></span></h5>
		</div>
				 

		<table class="table" id="datatable-loan-balance" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>Month</th>
					<th>Max Amount</th>
					<th>Credit Balance</th>
					<th>Debit Loan</th>
					<th>Last Updated</th>
					 
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
	<!-- /scrollable datatable -->
	</div>
  </div>
</div>
<!-- /content area -->

<!-- Iconified modal -->
<div id="rejectEmployee" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="form-reject" action="#" class="form-horizontal">
		<input name="id" type="hidden" class="form-control">
		<input name="type" type="hidden" class="form-control">
		{{ csrf_field() }}
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="ph-list me-2"></i>
					Form Approved Company
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			<div class="modal-body">
				<div class="alert alert-danger alert-icon-start alert-dismissible">
					<span class="alert-icon bg-danger text-white">
						<i class="ph-info"></i>
					</span>
					<span class="msg"></span>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				<div class="row mb-3">
					<label class="col-form-label col-sm-3">Reason</label>
					<div class="col-sm-9">
						<textarea name="reason" type="text" placeholder="Type reason" class="form-control" required></textarea>
					</div>
				</div>
			</div>
			
			<div class="modal-footer justify-content-between">
				<!--<button type="submit" class="btn btn-flat-danger btn-icon">
					<i class="ph-trash"></i>
					Delete
				</button> -->
				<button type="submit" class="btn btn-danger">
					<i class="ph-check me-1"></i>
					Process
				</button>
			</div>
		</form>
		</div>
	</div>
</div>
<!-- /iconified modal -->  

<!-- Iconified modal -->
<div id="approveEmployee" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		<form id="form-approve" action="#" class="form-horizontal">
		<input name="id" type="hidden" class="form-control">
		<input name="type" type="hidden" class="form-control">
		{{ csrf_field() }}
			<div class="modal-header">
				<h5 class="modal-title">
					<i class="ph-list me-2"></i>
					Form Approved Company
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			
			<div class="modal-body">
				<div class="alert alert-info alert-icon-start alert-dismissible">
					<span class="alert-icon bg-info text-white">
						<i class="ph-info"></i>
					</span>
					<span class="msg"></span>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				
			</div>
			
			<div class="modal-footer justify-content-between">
				<!--<button type="submit" class="btn btn-flat-danger btn-icon">
					<i class="ph-trash"></i>
					Delete
				</button> -->
				<button type="submit" class="btn btn-danger">
					<i class="ph-check me-1"></i>
					Process
				</button>
			</div>
		</form>
		</div>
	</div>
</div>
<!-- /iconified modal -->  
 <script>
	 
	var id = window.location.pathname.split('/').pop();
	
	function loadView(){
		
		$.ajax({
					data: { "id" : id},
					url: ServUrl+"/employees/detail",
					crossDomain: false,
					method: 'GET',
					complete: function(response){ 				
					if(response.status == 200){
								 
							if(response.responseJSON.data.is_approved == 'approved'){
								$('#disable').attr('hidden', false);
							}else if(response.responseJSON.data.is_approved == 'rejected'){
								$('#approve').attr('hidden', false);
							}else{
								$('#disable').attr('hidden', false);
								$('#approve').attr('hidden', false);
								$('#reject').attr('hidden', false);
							}
							
							$('.max_loan_percent').html(response.responseJSON.data.company.max_loan_percent+'% of Salary');
							$('input[name=name]').val(response.responseJSON.data.name);
							$('input[name=employee_id_card]').val(response.responseJSON.data.employee_id_card);
							$('textarea[name=address]').val(response.responseJSON.data.address);
							$('textarea[name=birthday_address]').val(response.responseJSON.data.birthday_address);
							$('input[name=birthday_date]').val(response.responseJSON.data.birthday_date);
							$('input[name=phone_number ]').val(response.responseJSON.data.phone_number );
							$('input[name=email]').val(response.responseJSON.data.email);
							$('input[name=emergency_name]').val(response.responseJSON.data.emergency_name);
							$('input[name=emergency_phone_number]').val(response.responseJSON.data.emergency_phone_number);
							$('input[name=emergency_relation]').val(response.responseJSON.data.emergency_relation);
							$('input[name=mounthly_salary]').val(formatRupiah(response.responseJSON.data.mounthly_salary));
							$('input[name=bank_payroll]').val(response.responseJSON.data.bank_payroll);
							$('input[name=bank_account_number]').val(response.responseJSON.data.bank_account_number);
							$('input[name=created_at]').val(localDate(response.responseJSON.data.created_at));
							
							$('input[name=company_name]').val(response.responseJSON.data.company.company_name);
							$('input[name=responsible_name]').val(response.responseJSON.data.company.responsible_name);
							$('input[name=company_employees_total]').val(response.responseJSON.data.company.company_employees_total);
							$('input[name=cutoff_date]').val(response.responseJSON.data.company.cutoff_date);
							$('input[name=company_payday]').val(response.responseJSON.data.company.company_payday);
							 
							$('input[name=total_working_days]').val(response.responseJSON.data.company.total_working_days);
							$('input[name=start_payroll_date]').val(response.responseJSON.data.company.start_payroll_date);
							$('input[name=end_payroll_date]').val(response.responseJSON.data.company.end_payroll_date);
							 
						}
					},
				dataType:'json'
				})
	
	};
	
	loadView();
	 $.extend( $.fn.dataTable.defaults, {
            autoWidth: true,
            selected: true,
			responsive: true,
			scrollX: true,
			scrollY: 200,
            columnDefs: [{ 
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });
		
	var table 	= $('#datatable-loan-balance').DataTable( {  
		 
		"order": [[ 0, "desc" ]], 
		"processing": true,
		"serverSide": true,
			"ajax": {
				"url": ServUrl+"/loans/balance_employee",
					  "data": {employee_id : id },
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
				{ "data": "month"},
				{ "data": "loan_max_amount" },
				{ "data": "loan_credit_amount" },
				{ "data": "loan_debit_amount" },
				{ "data": "updated_at" },
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
								'Detail Loans'+
							'</a>'+
							 
						'</div>'+
					'</div>'
				},{
				"searchable": false,
				"orderable": false,
				"targets": 0,
				"data": "id",
				render: function (data, type, row, meta) {
					data['loan_max_amount'] = formatRupiah(data['loan_max_amount']);
					data['loan_credit_amount'] = formatRupiah(data['loan_credit_amount']);
					data['loan_debit_amount'] = formatRupiah(data['loan_debit_amount']);
					data['updated_at'] = localDate(data['updated_at']);
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
	
	 
	
	function verifyUser(opt) {
		
		swalInit.fire({
			title: 'Are you sure?',
			text: "Are you want to "+opt+" this User",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, '+opt+' it!',
			cancelButtonText: 'No, cancel!',
			buttonsStyling: false,
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			}
		}).then(function(result) {
			if(result.value) {
				
			   if(opt == 'reject'){
				   showFormReject('rejected', 'Rejected employee application by {{ $data["user"]->name; }}');
			   }else if(opt == 'approve'){
				   showFormApprove('approved', 'Approved employee application by {{ $data["user"]->name; }}');
			   }else if(opt == 'disable'){
				   showFormReject('disabled', 'Disable this employee account by {{ $data["user"]->name; }}, it`s also will disable loan feature on employees');
			   }
				  
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				
			}
		});
				
	};
	
	var rejectEmployee = new bootstrap.Modal(document.getElementById('rejectEmployee'), {
	  keyboard: false,
	  backdrop: 'static'
	});
	
	var approveEmployee = new bootstrap.Modal(document.getElementById('approveEmployee'), {
	  keyboard: false,
	  backdrop: 'static'
	});
	
	function showFormReject(type, msg) {		 
	    rejectEmployee.show();
		$(".msg").html(msg);
		$("input[name=type]").val(type);
		$("input[name=id]").val(id);         
	};
	
	function showFormApprove(type, msg) {		 
	    approveEmployee.show();
		$(".msg").html(msg);
		$("input[name=type]").val(type);
		$("input[name=id]").val(id);         
	};
	
	 
	$("#form-reject").submit(function(event) {
		event.preventDefault();
        var path = ServUrl+"/employees/verify";
       

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
				rejectEmployee.hide();
				$.ajax({
                        data: data,
                        url: path,
                        method: 'POST',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);
						  					  
                          if(response.status == 201){
							swalInit.fire({
							  title: 'Saved!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							  
							location.reload();
                          }else{
							swalInit.fire({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
								  
							loadView();   
                          }
                        },
                        dataType:'json'
                });
           
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				 
			}
		});
				
	});
	
	$("#form-approve").submit(function(event) {
		event.preventDefault();
        var path = ServUrl+"/employees/verify";
       

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
				approveEmployee.hide();
				$.ajax({
                        data: data,
                        url: path,
                        method: 'POST',
                        complete: function(response){   
						  $(":submit").prop("disabled", false);
						  					  
                          if(response.status == 201){
							swalInit.fire({
							  title: 'Saved!',
							  text: response.responseJSON.message,
							  icon:'success'
							  });
							$('#approve').attr('hidden', true);
							$('#reject').attr('hidden', true);	  
							loadView();
							table.ajax.reload();						
							//location.reload();
                          }else{
							swalInit.fire({
							  title: 'Aborted!',
							  text: response.responseJSON.message,
							  icon:'warning',
							  }); 
							
							location.reload();							
                          }
                        },
                        dataType:'json'
                });
           
			}
			else if(result.dismiss === swal.DismissReason.cancel) {
				 
			}
		});
				
	});
</script> 
	
@endsection

