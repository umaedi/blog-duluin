@extends('layouts.app')
@section('content')
<main>
    <!-- breadcrumb-area-start -->
    <div class="breadcrumb__area breadcrumb-height p-relative green-bg">
       <div class="breadcrumb__shape-1">
          <img src="{{ asset('img') }}/breadcrumb/breadcrumb-shape-1.png" alt="">
       </div>
       <div class="breadcrumb__shape-2">
          <img src="{{ asset('img') }}/breadcrumb/breadcrumb-shape-2.png" alt="">
       </div>
       <div class="container">
          <div class="row">
             <div class="col-xl-9 col-lg-7">
                <div class="breadcrumb__content">
                   <h3 class="breadcrumb__title tp-char-animation">Tentang Duluin</h3>
                   <div class="breadcrumb__list wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                      <span class="child-one"><a href="/">Beranda</a></span>
                      <span class="dvdr"><i class="fal fa-angle-right"></i></span>
                      <span>Tentang Duluin</span>
                   </div>
                </div>
             </div>
             <div class="col-xl-3 col-lg-5 col-lg-4 text-center text-md-end">
                <div class="breadcrumb__img p-relative text-start z-index">
                   <img class="z-index-3" src="{{ asset('img') }}/breadcrumb/breadcrumb-3.png" alt="">
                   <div class="breadcrumb__sub-img wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".4s">
                      <img src="{{ asset('img') }}/breadcrumb/breadcrumb-sub-1.png" alt="">
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- breadcrumb-area-end -->

            <!-- postbox area start -->
            <div class="postbox__area pt-50 pb-100">
                <div class="container">
                   <div class="row justify-content-center">
                      <div class="col-xxl-8 col-xl-8 col-lg-8">
                         <div class="postbox__details-wrapper pr-20">
                            <article>
                               <div class="postbox__details-title-box pb-30">
                                  <h4 class="postbox__details-title">Apa itu Duluin Gajian?</h4>
                                     <div class="postbox__details-qoute mb-30">
                                <blockquote class="d-flex align-items-start">
                                   <div class="postbox__details-qoute-icon">
                                      <svg width="37" height="27" viewBox="0 0 37 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M35.046 0.402002C32.4553 2.01 30.222 3.97534 28.346 6.298C26.5593 8.53133 25.3533 10.8093 24.728 13.132C25.3533 12.596 26.0233 12.194 26.738 11.926C27.542 11.5687 28.3013 11.39 29.016 11.39C31.16 11.39 32.9467 12.1493 34.376 13.668C35.8053 15.0973 36.52 16.884 36.52 19.028C36.52 21.172 35.7607 22.9587 34.242 24.388C32.8127 25.8173 31.026 26.532 28.882 26.532C26.6487 26.532 24.8173 25.7727 23.388 24.254C21.9587 22.7353 21.244 20.77 21.244 18.358C21.244 15.142 22.1373 11.7027 23.924 8.04C25.8 4.288 27.8993 1.608 30.222 0H35.046V0.402002ZM13.802 0.402002C11.2113 2.01 8.978 3.97534 7.102 6.298C5.31533 8.53133 4.10933 10.8093 3.484 13.132C4.10933 12.596 4.77933 12.194 5.494 11.926C6.298 11.5687 7.05733 11.39 7.772 11.39C9.916 11.39 11.7027 12.1493 13.132 13.668C14.5613 15.0973 15.276 16.884 15.276 19.028C15.276 21.172 14.5167 22.9587 12.998 24.388C11.5687 25.8173 9.782 26.532 7.638 26.532C5.40467 26.532 3.57333 25.7727 2.144 24.254C0.714667 22.7353 0 20.77 0 18.358C0 15.142 0.893333 11.7027 2.68 8.04C4.556 4.288 6.65533 1.608 8.978 0H13.802V0.402002Z" fill="#076759"/>
                                      </svg>
                                   </div>
                                   <div class="postbox__details-qoute-text">
                                      <p>“Platfrom to bring early access financial needs on managing own financial flexibility.</p>
                                   </div>
                                </blockquote>
                             </div>
                                  <p>Pada awalnya Kami bertujuan untuk memberdayakan individu dengan keuangan kebebasan dan kontrol dengan merevolusi cara mereka mengakses dan mengelola upah yang mereka peroleh, membina dunia di mana kesejahteraan finansial dapat diakses oleh semua orang. Dengan memiliki produk pertama kami, Kami berkomitmen untuk itu memberikan individu pekerja keras akses cepat dengan upah yang masih harus dibayar sebelum gaji mereka siklus berakhir, meningkatkan stabilitas keuangan, mengurangi stres, dan pada akhirnya meningkatkan kesejahteraan secara keseluruhan dari pengguna kami.</p>
                               </div>
                            </article>
                            <div class="postbox__details-title-box pb-30">
                                <h4 class="postbox__details-title">Alamat kami</h4>
                                <p>Jl. Gading Kirana Timur A11/15, Kelapa Gading Barat, Kelapa Gading, Jakarta Utara, Jakarta, 14240</p>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.882838505303!2d106.89805007316608!3d-6.146434660247097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f54f7d1e4637%3A0x7d13697d54add034!2sJl.%20Gading%20Kirana%20Tim.%20Blok%20A11%20No.15%2C%20RT.1%2FRW.8%2C%20Klp.%20Gading%20Bar.%2C%20Kec.%20Klp.%20Gading%2C%20Jkt%20Utara%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2014240!5e0!3m2!1sen!2sid!4v1710123038793!5m2!1sen!2sid" width="800" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                             </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <!-- postbox area end -->
 </main>
@endsection