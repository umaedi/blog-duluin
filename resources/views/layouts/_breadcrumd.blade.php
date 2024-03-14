<div class="breadcrumb__area breadcrumb-height p-relative green-bg">
    <div class="breadcrumb__shape-1">
       <img src="{{ asset('img') }}/breadcrumb/breadcrumb-shape-1.png">
    </div>
    <div class="breadcrumb__shape-2">
       <img src="{{ asset('img') }}/breadcrumb/breadcrumb-shape-2.png">
    </div>
    <div class="container">
       <div class="row">
          <div class="col-xl-9 col-lg-7">
             <div class="breadcrumb__content">
                <h3 class="breadcrumb__title tp-char-animation">{{ $data['title'] }}</h3>
                <div class="breadcrumb__list wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                  @foreach ( $data['breadcrumb'] as $item)
                  <span class="child-one"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></span>
                  <span class="dvdr"><i class="fal fa-angle-right"></i></span>
                  @endforeach
                  <span>{{ $data['bread_current'] }}</span>
                </div>
             </div>
          </div>
          <div class="col-xl-3 col-lg-5 col-lg-4 text-center text-md-end">
             <div class="breadcrumb__img p-relative text-start z-index">
                <img class="z-index-3" src="{{ asset('img') }}/breadcrumb/breadcrumb-3.png" loading="lazy" alt="breadcrumd" width="230" height="259">
                <div class="breadcrumb__sub-img wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                   <img src="{{ asset('img') }}/breadcrumb/breadcrumb-sub-1.png" loading="lazy" alt="breadcrumd" width="71" height="80">
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>