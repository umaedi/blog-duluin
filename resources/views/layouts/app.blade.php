<!doctype html>
<html class="no-js" lang="zxx">


<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Duluin.com - Fleksibelin Kebutuhanmu</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="robots" content="noindex">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img') }}/favicon.png">

   <!-- CSS here -->
   <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.min.css">
   <link rel="stylesheet" href="{{ asset('css') }}/animate.css">
   <link rel="stylesheet" href="{{ asset('css') }}/custom-animation.css">
   <link rel="stylesheet" href="{{ asset('css') }}/slick.css">
   <link rel="stylesheet" href="{{ asset('css') }}/nice-select.css">
   <link rel="stylesheet" href="{{ asset('css') }}/flaticon.css">
   <link rel="stylesheet" href="{{ asset('css') }}/swiper-bundle.css">
   <link rel="stylesheet" href="{{ asset('css') }}/meanmenu.css">
   <link rel="stylesheet" href="{{ asset('css') }}/font-awesome-pro.css">
   <link rel="stylesheet" href="{{ asset('css') }}/magnific-popup.css">
   <link rel="stylesheet" href="{{ asset('css') }}/spacing.css">
   <link rel="stylesheet" href="{{ asset('css') }}/style.css">
</head>

<body>

   <!-- preloader -->
   <div id="preloader">
      <div class="preloader">
         <span></span>
         <span></span>
      </div>
   </div>
   <!-- preloader end  -->

   <!-- back-to-top-start  -->
   <button class="scroll-top scroll-to-target tp-style-green" data-target="html">
      <i class="far fa-angle-double-up"></i>
   </button>
   <!-- back-to-top-end  -->

    @include('layouts.header')
    <main id="swup" class="fix">
        @yield('content')
    </main>
    @include('layouts.footer')

   <!-- JS here -->
   <script src="{{ asset('js') }}/jquery.js"></script>
   <script src="{{ asset('js') }}/waypoints.js"></script>
   <script src="{{ asset('js') }}/bootstrap.bundle.min.js"></script>
   <script src="{{ asset('js') }}/slick.min.js"></script>
   <script src="{{ asset('js') }}/magnific-popup.js"></script>
   <script src="{{ asset('js') }}/counterup.js"></script>
   <script src="{{ asset('js') }}/purecounter.js"></script>
   <script src="{{ asset('js') }}/wow.js"></script>
   <script src="{{ asset('js') }}/nice-select.js"></script>
   <script src="{{ asset('js') }}/swiper-bundle.js"></script>
   <script src="{{ asset('js') }}/meanmenu.js"></script>
   <script src="{{ asset('js') }}/tilt.jquery.js"></script>
   <script src="{{ asset('js') }}/isotope-pkgd.js"></script>
   <script src="{{ asset('js') }}/imagesloaded-pkgd.js"></script>
   <script src="{{ asset('js') }}/ajax-form.js"></script>
   <script src="{{ asset('js') }}/gsap.min.js"></script>
   {{-- <script src="{{ asset('js') }}/ScrollTrigger.min.js"></script> --}}
   {{-- <script src="{{ asset('js') }}/ScrollSmoother.min.js"></script> --}}
   <script src="{{ asset('js') }}/split-text.min.js"></script>
   {{-- <script src="{{ asset('js') }}/parallax-scroll.js"></script> --}}
   <script src="{{ asset('js') }}/main.js"></script>

   {{-- request ajax --}}
   <script type="text/javascript">
        async function transAjax(data) {
            html = null;
            data.headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            await $.ajax(data).done(function(res) {
                    html = res;
                })
                .fail(function() {
                    return false;
                })
            return html
        }
    </script>
    {{-- end request ajax --}}

    <script src="https://unpkg.com/swup@4"></script>
    <script>
    const swup = new Swup({ animationSelector: false });
    </script>

   @stack('js')
</body>
</html>