@extends('layouts.app')
@section('content')
<div class="tp-error-area tp-error-ptb p-relative">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-6">
            {{-- <div class="tp-error-content-box text-center mb-40">
               <img src="{{ asset('img') }}/comingsoon.png" alt="">
            </div> --}}
            <div class="tp-error-text-box text-center">
               <h4 class="error-title-sm">Data berhasil dikirim</h4>
               <p>Terimakasih atas minat Anda untuk bergabung dengan Tim kami. Kami ingin memberitahukan bahwa kami telah menerima dokumen yang Anda kirimkan. Tim kami akan meninjau setiap aplikasi dengan cermat untuk menemukan kandidat terbaik yang sesuai dengan kebutuhan kami.</p>
               <a class="tp-btn-green" href="/">
                  <span>Kembali keberanda</span>
                  <b></b>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection