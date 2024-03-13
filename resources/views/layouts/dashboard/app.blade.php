<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{ $data['title'] }} - {{ $data['page_title'] }}</title>
	
	<link rel="shortcut icon" type="image/png" href="{{url('assets/frontend')}}/images/favicon.png">

	<!-- Global stylesheets -->
	<link href="{{ asset('assets/dashboard/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/dashboard/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/dashboard/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files --> 
	<script src="{{ asset('assets/dashboard/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('assets/dashboard/js/app.js') }}"></script>
	<script src="{{ asset('assets/dashboard/js/jquery/jquery.min.js') }}"></script>
	 <script src="{{ asset('assets/dashboard/js/components_buttons.js') }}"></script>
	 <script src="{{ asset('assets/dashboard/js/vendor/notifications/noty.min.js') }}"></script>
	 <script src="{{ asset('assets/dashboard/js/vendor/notifications/sweet_alert.min.js') }}"></script>
	<!-- /theme JS files -->
	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
	<script>
		function getToken() {
			var name = 'access_tokenku';
			let matches = document.cookie.match(new RegExp(
			  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
			));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		}
           
		$.ajaxSetup({
			headers: {
			  'Accept': 'application/json',
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  'Authorization': 'Bearer '+getToken(),
			}
		});
	   
		const BaseUrl = "{{ url('/') }}"
		const ServUrl = "{{ url('/api/v1/dashboard/') }}"
     
		function getUrlVars() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				vars[key] = value.replace(/\+/g, ' ').replace(/\#/g, ' ');
			});
			return vars;
		}
		function goBack() {
			window.history.back();
		}
		
		// Override Noty defaults
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500
        });
		
		// Defaults
        const swalInit = swal.mixin({
			buttonsStyling: false,
			reverseButtons: true,
			customClass: {
				confirmButton: 'btn btn-primary',
				cancelButton: 'btn btn-light',
				denyButton: 'btn btn-light',
				input: 'form-control',
				
			}
		});

		function formatRupiah(number) {	 
			if(number != null){
				if(number == 0){
					return '';
				}else{
					return new Intl.NumberFormat('id-ID', {  minimumFractionDigits: 0 }).format(parseFloat(number))
				}
			}else{
				return '';
			}
		}

		function localDate(date) {	 
			if(date != null){
				var data = new Date(date);
				return data.toLocaleString('en-CA',{hour12: false});
			}else{
				return '';
			}
		}		
	</script>
</head>

<body>
	@include('layouts.dashboard.header')
	<!-- Page content -->
	<div class="page-content">
		@include('layouts.dashboard.sidebar')
		<!-- Main content -->
		<div class="content-wrapper">
		
			<!-- Inner content -->
			<div class="content-inner">
			
				@yield('content')
				
				<!-- Footer -->
				 @include('layouts.dashboard.footer')
				<!-- /footer -->
			</div>
			<!-- /inner content -->
			
		</div>
		<!-- /main content -->
		
	</div>
	<!-- /page content -->
</body>

</html>

<form id="logout" method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    @csrf
                  
</form>	
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script>

	function signOut() {
		swal("Are you sure?", {
                    buttons: {
                        cancel: "No, cancel!!",
                        catch: {
                            text: "Yes, save it!",
                            value: "yes",
                        },
                        
                    },
                })
                .then((value) => {
                  if(value == 'yes'){
                  	$('#logout').trigger('submit')
                  }
      });
		 
	
	}
</script>			