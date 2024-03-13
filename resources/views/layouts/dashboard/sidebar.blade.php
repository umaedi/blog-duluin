<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Sidebar header -->
		<div class="sidebar-section">
			<div class="sidebar-section-body d-flex justify-content-center">
				<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

				<div>
					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
						<i class="ph-arrows-left-right"></i>
					</button>

					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
						<i class="ph-x"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /sidebar header -->


		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header pt-0">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					<a href="{{ url('/dashboard') }}" class="nav-link @if(Request::segment(2) == '')  active @endif">
						<i class="ph-house"></i>
						<span>
							Dashboard
							
						</span>
					</a>
				</li>
				
				 <!--<li class="nav-item">
					<a href="{{ url('/dashboard/todo_list') }}" class="nav-link @if(Request::segment(2) == 'todo_list')  active @endif">
						<i class="ph-spinner spinner"></i>
						<span>My Task </span>
						<span class="badge bg-primary align-self-center rounded-pill ms-auto">2</span>
					</a>
				</li> -->
			 
				<!-- Forms -->
				<li class="nav-item-header">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">MAIN APP</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<!-- <li class="nav-item">
					<a href="{{ url('/dashboard/menus') }}" class="nav-link">
						<i class="ph-list-numbers"></i>
						<span>Header Menu</span>
						 
					</a>
				</li> -->
				<li class="nav-item">
					<a href="{{ url('/dashboard/banners') }}" class="nav-link @if(Request::segment(2) == 'banners')  active @endif">
						<i class="ph-squares-four"></i>
						<span>Banner Ads</span>
						<!-- <span class="badge bg-primary align-self-center rounded-pill ms-auto">1</span> -->
					</a>
				</li>
				
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link @if(Request::segment(2) == 'articles')  active @endif">
						<i class="ph-text-aa"></i>
						<span>Articles</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ url('/dashboard/articles') }}" class="nav-link @if(Request::segment(2) == 'articles')  active @endif">List Articles</a></li>
						<li class="nav-item"><a href="{{ url('/dashboard/articles/create') }}" class="nav-link @if(Request::segment(2) == 'articles')  active @endif">Create Article</a></li>
					</ul>
				</li>
				
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link @if(Request::segment(2) == 'pages')  active @endif">
						<i class="ph-cards"></i>
						<span>Pages</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ url('/dashboard/pages') }}" class="nav-link @if(Request::segment(2) == 'pages')  active @endif">List Pages</a></li>
						<li class="nav-item"><a href="{{ url('/dashboard/pages/create') }}" class="nav-link @if(Request::segment(2) == 'pages')  active @endif">Create Page</a></li>
					</ul>
				</li>
				
				<li class="nav-item">
					<a href="{{ url('/dashboard/categories') }}" class="nav-link @if(Request::segment(2) == 'categories')  active @endif">
						<i class="ph-books"></i>
						<span>Categories</span>
					</a>
				</li>
				
				<li class="nav-item">
					<a href="{{ url('/dashboard/tags') }}" class="nav-link @if(Request::segment(2) == 'tags')  active @endif">
						<i class="ph-tag"></i>
						<span>Tags</span>
						<!-- <span class="badge bg-primary align-self-center rounded-pill ms-auto">1</span> -->
					</a>
				</li>
				<!-- /components -->
				<!-- Components -->
				<li class="nav-item-header">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Mod Page</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link @if(Request::segment(2) == 'carrers')  active @endif">
						<i class="ph-cards"></i>
						<span>Careers</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ url('/dashboard/careers') }}" class="nav-link">List Careers</a></li>
						<li class="nav-item"><a href="{{ url('/dashboard/careers/create') }}" class="nav-link">Create career</a></li>
					</ul>
				</li>

				<!-- Page kits -->
				<li class="nav-item-header">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Global Setting</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					<a href="{{ url('/dashboard/users/profile') }}" class="nav-link @if(Request::segment(3) == 'profile')  active @endif">
						<i class="ph-user-focus"></i>
						<span>Profile</span>
						 
					</a>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link @if(Request::segment(3) == 'register')  active @endif">
						<i class="ph-users-three"></i>
						<span>User Account</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ url('dashboard/users/') }}" class="nav-link">User list</a></li>
						<li class="nav-item"><a href="{{ url('dashboard/users/register') }}" class="nav-link">User Add</a></li>
						
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link">
						<i class="ph-shield-check"></i>
						<span>User Access Control</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="{{ url('dashboard/roles') }}" class="nav-link">User Role</a></li>
						<li class="nav-item"><a href="{{ url('dashboard/permissions') }}" class="nav-link">User Permissions</a></li>
						<li class="nav-item"><a href="{{ url('dashboard/log_activity') }}" class="nav-link">User Activity</a></li>
						 
					</ul>
				</li>
				 
				<li class="nav-item">
					<a href="{{ url('/dashboard/setting') }}" class="nav-link @if(Request::segment(2) == 'setting')  active @endif">
						<i class="ph-sliders"></i>
						<span>Web Setting</span>
						 
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/logout') }}" class="nav-link">
						<i class="ph-sign-out"></i>
						<span>Logout</span>
						 
					</a>
				</li>
				<li class="nav-item pb-5">
					
				</li>
				<!-- /page kits -->

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>
<!-- /main sidebar -->