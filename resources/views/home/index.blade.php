@extends('layouts.app')
@section('content')
<!-- tp-hero-area-start -->
<div class="tp-hero-2__ptb tp-hero-2__plr z-index fix p-relative" style="background-color: #076759">
    <div class="container-fluid g-0">
    <div class="row g-0 align-items-top">
        <div class="col-xl-6 col-lg-6">
            <div class="tp-hero-2__title-box">
                <h3 class="tp-hero-2__title">Duluin <br> Fleksibelin kebutuhanmu</h3>
                <p class="text-white">Platfrom to bring early access financial needs on managing own financial flexibility.</p>
            </div>
            <div class="tp-hero-2__btn">
                <a class="tp-btn-yellow wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s"
                href="/about">Tentang kami</a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="tp-hero-2__right p-relative">
                <div class="tp-hero-2__main-img wow tpfadeRight" data-wow-duration=".9s"
                data-wow-delay=".5s">
                <img src="{{ asset('img') }}/hero/hero-img-duluin-v3.png" loading="lazy" alt="" width="100%">
                </div>
                <div class="tp-hero-2__sub-img-1 d-none d-sm-block" data-parallax='{"x": 100, "smoothness": 30}'>
                    <img src="{{ asset('img') }}/hero/image_02_v2.png" loading="lazy" alt="">
                </div>
                <div class="tp-hero-2__sub-img-4">
                    <img src="{{ asset('img') }}/hero/hero-shape-2-2.png" loading="lazy" alt="">
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- tp-hero-area-end -->

<!-- tp-account-area-strat -->
<div class="tp-account-area pt-50">
<div class="container">
<div class="row align-items-top ">
    <div class="col-xl-6 col-lg-6">
        <div class="wow tpfadeLeft d-flex justify-content-center" data-wow-duration=".9s" data-wow-delay=".5s">
            <img src="{{ asset('img') }}/home/what's-duluin-v1.png" loading="lazy" width="80%" height="80%" alt="Apa itu duluin?">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="tp-account-step-wrapper">
            <div class="tp-account-section-box mb-40">
            <h3 class="tp-section-title-lg">Tentang Duluin</h3>
            </div>
            <div class="tp-account-step">
            <p>
                Pada awalnya Kami bertujuan untuk memberdayakan individu dengan keuangan kebebasan dan kontrol dengan merevolusi cara mereka
                mengakses dan mengelola upah yang mereka peroleh, membina dunia di mana kesejahteraan finansial dapat diakses oleh semua orang.
                Dengan memiliki produk pertama kami, Kami berkomitmen untuk itu memberikan individu pekerja keras akses cepat dengan upah yang masih harus dibayar sebelum gaji mereka siklus berakhir, meningkatkan stabilitas keuangan, mengurangi stres, dan pada akhirnya meningkatkan kesejahteraan secara keseluruhan dari pengguna kami.
            </p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- tp-account-area-end -->

<!-- tp-payment-area-start -->
<div id="payment-method" class="tp-payment__area pt-50 pb-50">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="tp-payment__title-box text-center mb-55">
                <h3 class="tp-section-title-lg">Manfaat Produk Kami</h3>
                <p>Produk kami memberikan manfaat kepada perusahaan & karyawan</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-6 mb-30">
                <div class="tp-payment__item tp-payment__bg-color-2 p-relative z-index wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".3s">
                    {{-- <div class="tp-payment__shape-4">
                        <img src="{{ asset('img') }}/payment/qrcode.png" alt="">
                    </div> --}}
                    <div class="tp-payment__shape-5">
                        <img src="{{ asset('img') }}/payment/breadcrumb-3.png" loading="lazy" width="100%" height="100%" alt="benefit duluin">
                    </div>
                    {{-- <div class="tp-payment__shape-6">
                        <img src="{{ asset('img') }}/payment/hand.png" alt="">
                    </div> --}}
                    {{-- <div class="tp-payment__shape-7">
                        <img src="{{ asset('img') }}/payment/coin-1.png" alt="">
                    </div>
                    <div class="tp-payment__shape-8">
                        <img src="{{ asset('img') }}/payment/coin-2.png" alt="">
                    </div> --}}
                    <div class="tp-payment__content">
                        <h3 class="tp-payment__title">Manfaat untuk perusahaan</h3>
                        <div class="tp-plan-feature">
                            <ul>
                                <li><i class="far fa-check"></i>Berlangganan Gratis</li>
                                <li><i class="far fa-check"></i>Menyelamatkan Modal Perusahaan</li>
                                <li><i class="far fa-check"></i>Mengurangi Tingkat Turn Over</li>
                                <li><i class="far fa-check"></i>Meningkatkan Produktivitas Karyawan</li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 mb-30">
                <div class="tp-payment__item tp-payment__bg-color-3 p-relative z-index wow tpfadeRight" data-wow-duration=".9s" data-wow-delay=".5s">
                    <div class="tp-payment__shape-9">
                        <img src="{{ asset('img') }}/payment/benefit-karyawan-v1.png" loading="lazy" width="100%" height="100%" alt="benefit duluin">
                    </div>
                    <div class="tp-payment__content">
                        <h3 class="tp-payment__title">Manfaat untuk karyawan</h3>
                        <div class="tp-plan-feature">
                            <ul>
                                <li><i class="far fa-check"></i>Tanpa Bunga, Hanya Biaya Platform dan Administrasi</li>
                                <li><i class="far fa-check"></i>Transfer Cepat dalam hitungan Jam</li>
                                <li><i class="far fa-check"></i>Bebas Stres Keuangan dan Mendorong Stabilitas Keuangan</li>
                                <li><i class="far fa-check"></i>Layanan Keuangan Tambahan <br>dari Perusahaan</li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
            <!-- tp-account-area-strat -->
            <div class="tp-account-area pt-50">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-account-thumb-wrapper p-relative text-center wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".5s">
                        <div class="tp-account-bg">
                        <img src="{{ asset('img') }}/account/account-bg.png" loading="lazy" alt="">
                        </div>
                        <div class="tp-account-main-img">
                        <img src="{{ asset('img') }}/account/acc-main.png" loading="lazy" alt="">
                        </div>
                        {{-- <div class="tp-account-author">
                        <img src="{{ asset('img') }}/account/ac-author.png" alt="">
                        </div>
                        <div class="tp-account-shape-1">
                        <img src="{{ asset('img') }}/account/ac-shape-1.png" alt="">
                        </div>
                        <div class="tp-account-shape-2">
                        <img src="{{ asset('img') }}/account/ac-shape-2.png" alt="">
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="tp-account-step-wrapper">
                        <div class="tp-account-section-box mb-40">
                        <h3 class="tp-section-title-lg">Registrasi Dalam 5 Menit</h3>
                        </div>
                        <div class="tp-account-step mb-50">
                        <div class="tp-account-item d-flex align-items-center">
                            <span>01</span>
                            <p>Daftar aplikasi duluin di website resmi kami <a>duluin.gajian.com</a></p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>02</span>
                            <p>Setelah masuk ke tampilan aplikasi duluin, kamu melakukan sign up atau daftar</p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>03</span>
                            <p>Pilih perusahaan, kemudian isi nomor karyawan, alamat email, nomor telepon dan password</p>
                        </div>
                        <div class="tp-account-item d-flex align-items-center">
                            <span>04</span>
                            <p>Selanjutkan kamu dapat login, serta melengkapi data diri kamu</p>
                        </div>
                        </div>
                        <div class="tp-account-btn-box">
                        <a class="tp-btn-green mb-15" href="https://gajian.duluin.com">Daftar Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- tp-account-area-end -->
    </div>
    </div>
</div>
<!-- tp-payment-area-end -->

<!--ab-brand-area-start -->
<div class="ab-brand-area">
    <div class="container">
        <div class="ab-brand-border-bottom pb-50">
            <div class="row">
                <div class="col-12">
                <div class="ab-brand-section-box text-center mb-50">
                    <h4 class="ab-brand-title">Daftar Perusahaan yang sudah bekerja sama dengan kami</h4>
                </div>
                </div>
            </div>
            <div class="tp-integration-slider-wrapper pt-50 pb-50" data-background="{{ asset('img') }}/integration/integration-bg.jpg">
                <div class="tp-integration-slider-active">
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_GBS.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_ARSA.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_MGA.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_HJS.png" loading="lazy" alt="">
                      </div>
                   </div>
                </div>
                <div class="tp-integration-slider-active-2 carousel-rtl" dir="rtl">
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_MCB.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_BSI.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_SWA.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_SS.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_JPM.png" loading="lazy" alt="">
                      </div>
                   </div>
                   <div class="tp-integration-slider-main">
                      <div class="tp-integration-slider-item">
                        <img src="{{ asset('img') }}/brand/BI_DUTA.png" loading="lazy" alt="">
                      </div>
                   </div>
                </div>
             </div>
        </div>
    </div>
</div>
    <!--ab-brand-area-end -->

<!-- tp-testimonial-area-start -->
<div class="pt-50 pb-50" style="background-color: #076759">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="tp-testimonial-2-section-box mb-15 text-center">
                    <h3 class="tp-section-title-lg text-white">Kata mereka Tentang kami</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="tp-testimonial-2-section">
                    <div class="tp-testimonial-2-slider-active row">
                        <div class="col-md-4">
                            <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
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
                                    <p>"Sebenernya ini sangat membantu kami terutama para ibu-ibu yang kadang ada keperluan mendadak!"</p>
                                </div>
                                <div class="tp-testimonial-2-author d-flex align-items-center">
                                    <div class="tp-testimonial-2-img">
                                    <img src="{{ asset('img') }}/testimonial/female.png" loading="lazy" alt="">
                                    </div>
                                    <div class="tp-testimonial-2-author-info">
                                    <h5>Linda Megasari</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-4">
                        <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".3s">
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
                                <p>Saya sangat merasa terbantu dari segi kebutuhan, cuma kenapa tidak lansgung acc</p>
                            </div>
                            <div class="tp-testimonial-2-author d-flex align-items-center">
                                <div class="tp-testimonial-2-img">
                                <img src="{{ asset('img') }}/testimonial/male.png" loading="lazy" alt="">
                                </div>
                                <div class="tp-testimonial-2-author-info">
                                <h5>Wawan Rochmana</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="tp-testimonial-2-item p-relative wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
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
                                <p>"Ok sangat membantu"</p>
                            </div>
                            <div class="tp-testimonial-2-author d-flex align-items-center">
                                <div class="tp-testimonial-2-img">
                                <img src="{{ asset('img') }}/testimonial/male.png" loading="lazy" alt="">
                                </div>
                                <div class="tp-testimonial-2-author-info">
                                <h5>Angga Setiawan</h5>
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
<div class="tp-faq-area pt-50 pb-100 fix">
    <div class="container">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="tp-faq-left-wrapper p-relative">
                <div class="tp-faq-section-box pb-20">
                <h3 class="tp-section-title-lg">Pertanyaan yang sering ditanyakan</h3>
                <p>Berikut daftar pertanyaan yang sering ditanyakan seputar Duluin</p>
                </div>
                <div class="tp-faq-btn">
                <a class="tp-btn-green" href="#">Selengkapnya</a>
                </div>
                <div class="tp-faq-img" data-parallax='{"x": -50, "smoothness": 30}'>
                <img src="{{ asset('img') }}/faq/faq-1.png" loading="lazy" alt="">
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="tp-custom-accordion">
                <div class="accordion" id="accordionExample">
                <div class="accordion-items tp-faq-active">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apa itu Duluin?
                            <span class="accordion-btn"></span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            "Platfrom to bring early access financial needs on managing own financial flexibility".<br>
                            <a href="/about">Selengkapnya tentang kami</a>
                        </div>
                    </div>
                </div>
                <div class="accordion-items">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-buttons" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Bagaimana cara dafatar duluin?
                            <span class="accordion-btn"></span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
@endsection

