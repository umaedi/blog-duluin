<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="robots" content="noindex">
	<title>{{ $data['title'] }}</title>

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
	<!-- /theme JS files -->
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
	</script>
</head>

<body>
	
	@yield('content')

</body>

</html>

<form id="logout" method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    @csrf
                  
</form>	
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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