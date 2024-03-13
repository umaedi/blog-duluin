@extends('layouts.app')
@section('content')
<main>
    <div class="tp-error-area tp-error-ptb p-relative">
       <div class="tp-error-left-shape">
          <img src="assets/img/login/error-shape.png" alt="">
       </div>
       <div class="container">
          <div class="row justify-content-center">
             <div class="col-md-8">
                {{-- <div class="tp-error-content-box text-center mb-40">
                   <img src="assets/img/login/text-404.png" alt="">
                </div> --}}
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
 </main>
@endsection