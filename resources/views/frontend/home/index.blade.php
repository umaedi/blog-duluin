@extends('layouts.app')
@section('content')
    <main class="fix">
        <!-- tp-hero-area-start -->
        <div class="tp-hero-2__area tp-hero-2__ptb tp-hero-2__plr z-index fix p-relative"
            data-background="{{ asset('img') }}/hero/hero-bg-2.png">
            <div class="container-fluid g-0">
            <div class="row g-0 align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-hero-2__title-box">
                        <h3 class="tp-hero-2__title">Duluin <br> Fleksibelin kebutuhanmu</h3>
                        <p class="text-white">Platfrom to bring early access financial needs on managing own financial flexibility.</p>
                    </div>
                    <div class="tp-hero-2__btn">
                        <a class="tp-btn-green wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s"
                        href="service-details.html">Tentang kami</a>
                    </div>
                    <div class="tp-hero-2__user p-relative">
                        <h4 class="tp-char-animation-2">Over<span>5Ok+ Client</span> all over the world</h4>
                        <div class="tp-hero-2__user-img">
                        <img src="{{ asset('img') }}/hero/hero-user.jpg" alt="">
                        </div>
                        <div class="tp-hero-2__shape-1">
                        <svg width="101" height="15" viewBox="0 0 101 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.336934 5.24122C16.3707 0.583948 58.7418 -4.19312 99.9564 13.9568"
                                stroke="white" stroke-width="1.5" />
                        </svg>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-hero-2__right text-end p-relative">
                        <div class="tp-hero-2__main-img wow tpfadeRight" data-wow-duration=".9s"
                        data-wow-delay=".5s">
                        <img src="{{ asset('img') }}/hero/hero-img-2-1.png" alt="">
                        </div>
                        <div class="tp-hero-2__sub-img-1 d-none d-sm-block" data-parallax='{"x": 100, "smoothness": 30}'>
                        <img src="{{ asset('img') }}/hero/image_02.png" alt="">
                        </div>
                        <div class="tp-hero-2__sub-img-2 d-none d-sm-block"
                        data-parallax='{"x": -100, "smoothness": 10}'>
                        <img src="{{ asset('img') }}/hero/hero-img-2-3.png" alt="">
                        </div>
                        <div class="tp-hero-2__sub-img-3 d-none d-sm-block"
                        data-parallax='{"y": -80, "smoothness": 30}'>
                        <img src="{{ asset('img') }}/hero/hero-img-2-4.png" alt="">
                        </div>
                        <div class="tp-hero-2__sub-img-4">
                        <img src="{{ asset('img') }}/hero/hero-shape-2-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-hero-area-end -->

          <!-- tp-account-area-strat -->
          <div class="tp-account-area pt-110 pb-120">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-account-thumb-wrapper p-relative text-center wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                        <div class="tp-account-bg">
                        <img src="{{ asset('img') }}/account/account-bg.png" alt="">
                        </div>
                        <div class="tp-account-main-img">
                        <img src="{{ asset('img') }}/account/acc-main.png" alt="">
                        </div>
                        <div class="tp-account-author">
                        <img src="{{ asset('img') }}/account/ac-author.png" alt="">
                        </div>
                        <div class="tp-account-shape-1">
                        <img src="{{ asset('img') }}/account/ac-shape-1.png" alt="">
                        </div>
                        <div class="tp-account-shape-2">
                        <img src="{{ asset('img') }}/account/ac-shape-2.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-account-step-wrapper">
                        <div class="tp-account-section-box mb-40">
                        <h3 class="tp-section-title-lg">Kami hadir untuk membantu</h3>
                        </div>
                        <div class="tp-account-step mb-50">
                        <div class="tp-account-item d-flex align-items-center">
                            <span>01</span>
                            <p>Karyawan terhindar dari jeratan hutang</p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>02</span>
                            <p>Karyawan merasa senang serta menurunkan turnover rate pada Perusahaan</p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>03</span>
                            <p>Akses yang mudah untuk semua keperluan dari Karyawan secara update</p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>03</span>
                            <p>Karyawan dapat merasakanFleksibel dalam penggunaan keuangan</p>
                        </div>
                        </div>
                        <div class="tp-account-btn-box">
                        <a class="tp-btn-green mb-15" href="register.html">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-account-area-end -->


        <!-- tp-payment-area-start -->
        <div id="payment-method" class="tp-payment__area pb-110">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="tp-payment__title-box text-center mb-55">
                        <h3 class="tp-section-title-lg">You'll love our powerful payments.</h3>
                        <p>We've got all your payments covered</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-6 mb-30">
                        <div class="tp-payment__item tp-payment__bg-color-2 p-relative z-index wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                            <div class="tp-payment__shape-4">
                                <img src="{{ asset('img') }}/payment/qrcode.png" alt="">
                            </div>
                            <div class="tp-payment__shape-5">
                                <img src="{{ asset('img') }}/payment/mobile.png" alt="">
                            </div>
                            <div class="tp-payment__shape-6">
                                <img src="{{ asset('img') }}/payment/hand.png" alt="">
                            </div>
                            <div class="tp-payment__shape-7">
                                <img src="{{ asset('img') }}/payment/coin-1.png" alt="">
                            </div>
                            <div class="tp-payment__shape-8">
                                <img src="{{ asset('img') }}/payment/coin-2.png" alt="">
                            </div>
                            <div class="tp-payment__content">
                                <h3 class="tp-payment__title">Scan & Go</h3>
                                <p>Transform your payment link into a QR code
                                    that customers can scan with their <br>
                                    phone to pay.
                                </p>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 mb-30">
                        <div class="tp-payment__item tp-payment__bg-color-3 p-relative z-index wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                            <div class="tp-payment__shape-9">
                                <img src="{{ asset('img') }}/payment/payment-3.png" alt="">
                            </div>
                            <div class="tp-payment__shape-11">
                                <img src="{{ asset('img') }}/payment/message.png" alt="">
                            </div>
                            <div class="tp-payment__content">
                                <h3 class="tp-payment__title">Easily Send Requesrs
                                    vai e-mail or SMS</h3>
                                <p>... or copy-paste the link</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 mb-30">
                    <div class="tp-payment__item p-relative z-index wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                        <div class="tp-payment__shape-1">
                        <img src="{{ asset('img') }}/payment/background.png" alt="">
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="tp-payment__content tp-payment__content-space">
                                <h3 class="tp-payment__title">Online Billing & <br> Invoicing Payments.</h3>
                                <p>Get paid faster with Online Invoicing <br> and the Virtual Terminal.</p>
                                <a href="service-details.html">Explore Invoicing Tools<i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tp-payment__shape-2">
                                <img src="{{ asset('img') }}/payment/image.png" alt="">
                            </div>
                            <div class="tp-payment__shape-3 d-none d-sm-block">
                                <img src="{{ asset('img') }}/payment/get-paid.png" alt="">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-payment-area-end -->

        <!--ab-brand-area-start -->
        <div class="ab-brand-area">
            <div class="container">
               <div class="ab-brand-border-bottom pb-90">
                  <div class="row">
                     <div class="col-12">
                        <div class="ab-brand-section-box text-center mb-50">
                           <h4 class="ab-brand-title">Daftar Perusahaan yang sudah bekerja sama dengan kami</h4>
                        </div>
                     </div>
                  </div>
                  <div class="row justify-content-center">
                     <div class="col-xl-10">
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 justify-content-center">
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-1.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-2.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-3.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-4.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-5.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-6.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-7.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-8.png" alt="">
                              </div>
                           </div>
                           <div class="col">
                              <div class="ab-brand-item mb-25">
                                 <img src="{{ asset('img') }}/brand/brand-inner-9.png" alt="">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--ab-brand-area-end -->

        <!-- tp-testimonial-area-start -->
        <div class="tp-testimonial-2-area pt-110 pb-120" data-background="{{ asset('img') }}/testimonial/testi-bg-2-1.png">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="tp-testimonial-2-section-box mb-15 text-center">
                        <h3 class="tp-section-title-lg text-white">Kata mereka<br>
                        Tentang kami</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tp-testimonial-2-section">
                        <div class="tp-testimonial-2-slider-active">
                        <div>
                            <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
                                <div class="tp-testimonial-2-border-shape">
                                    <img src="{{ asset('img') }}/testimonial/BODY.png" alt="">
                                </div>
                                <div class="tp-testimonial-2-star">
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                </div>
                                <div class="tp-testimonial-2-content">
                                    <p>"Is it possible to Love your credit card processor? with Softec, yes!"</p>
                                </div>
                                <div class="tp-testimonial-2-author d-flex align-items-center">
                                    <div class="tp-testimonial-2-img">
                                    <img src="{{ asset('img') }}/testimonial/testi-icon-2-1.png" alt="">
                                    </div>
                                    <div class="tp-testimonial-2-author-info">
                                    <h5>Lana Rey</h5>
                                    <span>Founder & Leader</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                                <div class="tp-testimonial-2-border-shape">
                                    <img src="{{ asset('img') }}/testimonial/BODY.png" alt="">
                                </div>
                                <div class="tp-testimonial-2-star">
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                </div>
                                <div class="tp-testimonial-2-content">
                                    <p>"Is it possible to Love your credit card processor? with Softec, yes!"</p>
                                </div>
                                <div class="tp-testimonial-2-author d-flex align-items-center">
                                    <div class="tp-testimonial-2-img">
                                    <img src="{{ asset('img') }}/testimonial/testi-icon-2-2.png" alt="">
                                    </div>
                                    <div class="tp-testimonial-2-author-info">
                                    <h5>J. McGhee</h5>
                                    <span>Founder & Leader</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                                <div class="tp-testimonial-2-border-shape">
                                    <img src="{{ asset('img') }}/testimonial/BODY.png" alt="">
                                </div>
                                <div class="tp-testimonial-2-star">
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                </div>
                                <div class="tp-testimonial-2-content">
                                    <p>"Is it possible to Love your credit card processor? with Softec, yes!"</p>
                                </div>
                                <div class="tp-testimonial-2-author d-flex align-items-center">
                                    <div class="tp-testimonial-2-img">
                                    <img src="{{ asset('img') }}/testimonial/testi-icon-2-3.png" alt="">
                                    </div>
                                    <div class="tp-testimonial-2-author-info">
                                    <h5>Michael H.</h5>
                                    <span>Founder & Leader</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".9s">
                                <div class="tp-testimonial-2-border-shape">
                                    <img src="{{ asset('img') }}/testimonial/BODY.png" alt="">
                                </div>
                                <div class="tp-testimonial-2-star">
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                    <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 0L10.472 5.26604L16 6.11567L12 10.2124L12.944 16L8 13.266L3.056 16L4 10.2124L0 6.11567L5.528 5.26604L8 0Z" fill="#FFCF55"/>
                                    </svg>
                                    </span>
                                </div>
                                <div class="tp-testimonial-2-content">
                                    <p>"Is it possible to Love your credit card processor? with Softec, yes!"</p>
                                </div>
                                <div class="tp-testimonial-2-author d-flex align-items-center">
                                    <div class="tp-testimonial-2-img">
                                    <img src="{{ asset('img') }}/testimonial/testi-icon-2-1.png" alt="">
                                    </div>
                                    <div class="tp-testimonial-2-author-info">
                                    <h5>Lana Rey</h5>
                                    <span>Founder & Leader</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-testimonial-area-end -->

        <!-- tp-faq-area-start -->
        <div class="tp-faq-area pt-140 pb-120 fix">
            <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-faq-left-wrapper p-relative">
                        <div class="tp-faq-section-box pb-20">
                        <h3 class="tp-section-title-lg">Pertanyaan yang sering ditanyakan</h3>
                        <p>Berikut daftar pertanyaan yang sering ditanyakan seputar Duluin</p>
                        </div>
                        <div class="tp-faq-btn">
                        <a class="tp-btn-green" href="contact.html">Selengkapnya</a>
                        </div>
                        <div class="tp-faq-img" data-parallax='{"x": -50, "smoothness": 30}'>
                        <img src="{{ asset('img') }}/faq/faq-1.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-custom-accordion">
                        <div class="accordion" id="accordionExample">
                        <div class="accordion-items">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bagaimana cara mendaftar Duluin?
                                    <span class="accordion-btn"></span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    The Softec Shop is built right into your account dashboard, and is accessible
                                    immediately after signing up.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-items tp-faq-active">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-buttons" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Do I need to change banks?
                                    <span class="accordion-btn"></span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    The Softec Shop is built right into your account dashboard, and is accessible
                                    immediately after signing up.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-items">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    How can I order equipment?
                                    <span class="accordion-btn"></span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    The Softec Shop is built right into your account dashboard, and is accessible
                                    immediately after signing up.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-items">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Do you offer volume discounts?
                                    <span class="accordion-btn"></span>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    The Softec Shop is built right into your account dashboard, and is accessible
                                    immediately after signing up.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-items">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    How does signing up work?
                                    <span class="accordion-btn"></span>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    The Softec Shop is built right into your account dashboard, and is accessible
                                    immediately after signing up.
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-faq-area-end -->

        <!-- tp-cta-area-start -->
        <div class="tp-cta-area p-relative">
            <div class="tp-cta-grey-bg grey-bg-2"></div>
            <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tp-cta-bg" data-background="{{ asset('img') }}/cta/cta-bg.jpg">
                        <div class="tp-cta-content text-center">
                        <h3 class="tp-section-title-lg text-white">Try our service now!</h3>
                        <p>Eyerything you need to accept cord payments and grow your business <br>
                            anywhere on the planet.</p>
                        <a class="tp-btn-green" href="service-details.html">Get Started Now</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-cta-area-end -->

    </main>
@endsection