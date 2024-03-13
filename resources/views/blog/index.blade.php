@extends('layouts.app')
@section('content')
<main>

    <!-- breadcrumb-area-start -->
    @include('layouts._breadcrumd')
    <!-- breadcrumb-area-end -->
    <!--Portfolio Start-->
    <div class="portfolio blog-grid-inner mt-30 mb-80">
       <div class="container">
          <div class="row grid blog-grid-inner">
            @forelse ($data['articles'] as $post)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30 grid-item cat1 cat4 cat3 cat5">
               <div class="tp-blog-item">
                  <div class="tp-blog-thumb fix">
                     <a href="/blog/read/{{ $post->id }}/{{ $post->slug }}"><img src="{{ $post->img }}" loading="lazy" width="500" height="250" alt="thumb"></a>
                  </div>
                  <div class="tp-blog-content">
                     <div class="tp-blog-meta d-flex align-items-center">
                        <div class="tp-blog-category category-color-1">
                           <span>{{ $post->category_name }}</span>
                        </div>
                        <div class="tp-blog-date">
                           <span>{{ $post->date }}</span>
                        </div>
                     </div>
                     <div class="tp-blog-title-box">
                        <a class="tp-blog-title-sm" href="/blog/read/{{ $post->id }}/{{ $post->slug }}">{{ $post->title }}</a>
                     </div>
                     <div class="tp-blog-author-info-box d-flex align-items-center">
                        <div class="tp-blog-avata">
                           <img src="{{ asset('img') }}/avata/avata-1.png" alt="">
                        </div>
                        <div class="tp-blog-author-info">
                           <h5>{{ $post->creator->name }}</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @empty
                
            @endforelse
          </div>
       </div>
    </div>
    <!--Portfolio End-->
 </main>
@endsection