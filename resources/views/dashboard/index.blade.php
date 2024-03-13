@extends('layouts.dashboard.app')
@section('content')

@include('layouts.dashboard.breadcrumb')

<!-- Content area -->
				<div class="content">

					<!-- Simple statistics -->
					<div class="mb-3">
						<h6 class="mb-0">Static Data</h6>
						<span class="text-muted">Boxes with icons</span>
					</div>

					<div class="row">
						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<i class="ph-books ph-2x text-indigo me-3"></i>

									<div class="flex-fill text-end">
										<h4 class="mb-0">{{ $data['count_categories']; }}</h4>
										<span class="text-muted">total categories</span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<i class="ph-users-four ph-2x text-indigo me-3"></i>

									<div class="flex-fill text-end">
										<h4 class="mb-0">{{ $data['count_users']; }}</h4>
										<span class="text-muted">total users</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<div class="flex-fill">
										<h4 class="mb-0">{{ $data['count_careers']; }}</h4>
										<span class="text-muted">total careers</span>
									</div>

									<i class="ph-squares-four ph-2x text-primary ms-3"></i>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-xl-3">
							<div class="card card-body">
								<div class="d-flex align-items-center">
									<div class="flex-fill">
										<h4 class="mb-0">{{ $data['count_articles']; }}</h4>
										<span class="text-muted">total articles</span>
									</div>

									<i class="ph-table ph-2x text-danger ms-3"></i>
								</div>
							</div>
						</div>
					</div>

					<!-- /simple statistics -->

 

					
				</div>
				<!-- /content area -->

	
@endsection

