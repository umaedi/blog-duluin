@extends('layouts.app')
@section('content')

<!-- breadcrumb-area-start -->
@include('layouts._breadcrumd')
<!-- breadcrumb-area-end -->

<!-- tp-job-area-start -->
<div class="job-area pt-50 pb-120">
   <div class="container">
      <div class="row">
         <div class="col-xl-12">
            <div class="job-section-box text-center mb-40">
               <h3 class="tp-section-title">Posisi Terbuka</h3>
               <p>Kami saat ini mencari individu yang berbakat dan bersemangat untuk mengisi posisi Web Programmer</p>
            </div>
         </div>
      </div>
      @forelse ($data['careers'] as $karir)
      <div class="job-post-box">
         <div class="row align-items-center">
            <div class="col-lg-5 col-md-4">
               <div class="job-post-info d-flex justify-content-start align-items-center">
                  <div class="job-post-category">
                     <span>{{ $karir['position'] }}</span>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-5">
               <div class="job-post-wrapper d-flex align-items-center">
                  <div class="job-post-time d-flex align-items-center">
                     <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 16.75C13.2802 16.75 16.75 13.2802 16.75 9C16.75 4.71979 13.2802 1.25 9 1.25C4.71979 1.25 1.25 4.71979 1.25 9C1.25 13.2802 4.71979 16.75 9 16.75Z" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 5.7998V9.9998L11.8 11.3998" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>
                     <span>{{ $karir['type'] }}</span>
                  </div>
                  {{-- <div class="job-post-location d-flex align-items-center">
                     <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7.51463C1 3.9167 4.13401 1 8 1C11.866 1 15 3.9167 15 7.51463C15 11.0844 12.7658 15.2499 9.28007 16.7396C8.46748 17.0868 7.53252 17.0868 6.71993 16.7396C3.23416 15.2499 1 11.0844 1 7.51463Z" stroke="#5F6168" stroke-width="1.5"/>
                        <path d="M10 8C10 9.10457 9.10457 10 8 10C6.89543 10 6 9.10457 6 8C6 6.89543 6.89543 6 8 6C9.10457 6 10 6.89543 10 8Z" stroke="#5F6168" stroke-width="1.5"/>
                     </svg>
                     <span>Newark, NJ</span>
                  </div> --}}
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="job-post-apply-btn text-start text-md-end">
                  <a class="tp-btn-inner tp-btn-hover alt-color-orange" href="/karir/detail/{{ $karir['id'] }}/{{ $karir['slug'] }}"><span>Detail</span> <b></b></a>
               </div>
            </div>
         </div>
      </div>
      @empty
         <div class="tp-error-area tp-error-ptb p-relative">
            <div class="tp-error-left-shape">
               <img src="assets/img/login/error-shape.png" alt="">
            </div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-md-8">
                     <div class="tp-error-text-box text-center">
                        <h4 class="error-title-sm">Tidak Ada Lowongan Pekerjaan Tersedia Saat Ini</h4>
                        <p>Kami ingin berterima kasih atas minat Anda dalam bergabung dengan tim kami di Duluin. Saat ini, kami ingin memberi tahu Anda bahwa tidak ada lowongan pekerjaan yang tersedia di perusahaan kami.</p>
                        <a class="tp-btn-green" href="/">
                           <span>Kembali keberanda</span>
                           <b></b>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      @endforelse
   </div>
</div>
<!-- tp-job-area-end -->
@endsection