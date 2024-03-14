@extends('layouts.app')
@section('content')
<main>

    <!-- breadcrumb-area-start -->
    @include('layouts._breadcrumd')
    <!-- breadcrumb-area-end -->

    <!-- postbox area start -->
    <div class="postbox__area pt-50 pb-50">
       <div class="container">
          <div class="row">
             <div class="col-xxl-8 col-xl-8 col-lg-8">
                <div class="postbox__details-wrapper pr-20">
                   <article>
                      <div class="postbox__thumb w-img">
                         <a href="blog-details.html">
                            <img src="{{ $data['post']['img'] }}" alt="">
                         </a>
                      </div>
                      <div class="postbox__details-title-box pb-30">
                         <h4 class="postbox__details-title">{{ $data['post']['title'] }}</h4>
                         <p>{!! $data['post']['content'] !!}</p>
                      </div>
                      <div class="postbox__details tagcloud mb-50">
                         <span>Tags:</span>
                         <a href="#">{{ $data['post']['tags'] }}</a>
                      </div>
                      <div class="postbox__details-author-info-box mb-100 d-flex align-items-start">
                         <div class="postbox__details-author-avata">
                            <img src="{{ asset('img') }}/blog/blog-details-avata-1.jpg" alt="">
                         </div>
                         <div class="postbox__details-author-content">
                            <h5 class="postbox__details-author-title">{{ $data['post']['creator']['name'] }}</h5>
                            <div class="postbox__details-author-social">
                               <a href="#"><i class="fab fa-facebook-f"></i></a>
                               <a href="#"><i class="fab fa-twitter"></i></a>
                               <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                         </div>
                      </div>
                      <!-- Posisi html coment -->
                     <div id="disqus_thread"></div>
                     <!-- Posisi html jumlah coment -->
                     {{-- <script id="dsq-count-scr" src="//duluin-com.disqus.com/count.js" async></script> --}}
                   </article>
                </div>
             </div>
             <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="sidebar__wrapper">
                   <div class="sidebar__widget mb-40">
                      <div class="sidebar__widge-title-box">
                         <h3 class="sidebar__widget-title">Search</h3>
                      </div>
                      <div class="sidebar__widget-content">
                         <div class="sidebar__search">
                            <form action="#">
                               <div class="sidebar__search-input-2">
                                  <input type="text" placeholder="Search your keyword...">
                                  <button type="submit">
                                     <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.01371 15.2219C11.9525 15.2219 15.1456 12.0382 15.1456 8.11096C15.1456 4.18368 11.9525 1 8.01371 1C4.07488 1 0.881836 4.18368 0.881836 8.11096C0.881836 12.0382 4.07488 15.2219 8.01371 15.2219Z" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.9287 16.9996L13.0508 13.1331" stroke="#5F6168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                     </svg>
                                  </button>
                               </div>
                            </form>
                         </div>
                      </div>
                   </div>
                   <div class="sidebar__widget mb-40">
                      <div class="sidebar__widge-title-box">
                         <h3 class="sidebar__widget-title">Recent Post</h3>
                      </div>
                      <div class="sidebar__widget-content">
                         <div class="sidebar__post rc__post">
                            <div class="rc__post mb-20 d-flex">
                               <div class="rc__post-thumb fix mr-20">
                                  <a href="blog-details.html"><img src="{{ asset('img') }}/blog/blog-list-avata-1.jpg" alt=""></a>
                               </div>
                               <div class="rc__post-content">
                                  <h3 class="rc__post-title">
                                     <a href="blog-details.html">Is slower team communication a bad thing?</a>
                                  </h3>
                                  <div class="rc__meta">
                                     <span>4 March. 2022</span>
                                  </div>
                               </div>
                            </div>
                            <div class="rc__post mb-20 d-flex">
                               <div class="rc__post-thumb fix mr-20">
                                  <a href="blog-details.html"><img src="{{ asset('img') }}/blog/blog-list-avata-2.jpg" alt=""></a>
                               </div>
                               <div class="rc__post-content">
                                  <h3 class="rc__post-title">
                                     <a href="blog-details.html">Is slower team communication a bad thing?</a>
                                  </h3>
                                  <div class="rc__meta">
                                     <span>4 March. 2022</span>
                                  </div>
                               </div>
                            </div>
                            <div class="rc__post d-flex">
                               <div class="rc__post-thumb fix mr-20">
                                  <a href="blog-details.html"><img src="{{ asset('img') }}/blog/blog-list-avata-3.jpg" alt=""></a>
                               </div>
                               <div class="rc__post-content">
                                  <h3 class="rc__post-title">
                                     <a href="blog-details.html">The Ultimate Marketing Design Handbook</a>
                                  </h3>
                                  <div class="rc__meta">
                                     <span>4 March. 2022</span>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="sidebar__widget mb-40">
                      <div class="sidebar__widge-title-box">
                         <h3 class="sidebar__widget-title">Categories</h3>
                      </div>
                      <div class="sidebar__widget-content">
                         <ul>
                            @foreach ($data['categories'] as $cat)
                            {{ $cat->name }}
                            {{-- <li><a href="blog.html"><span><i class="fal fa-angle-right"></i>Technology</span><span>01</span></a></li> --}}
                            @endforeach
                         </ul>
                      </div>
                   </div>
                   <div class="sidebar__widget mb-40">
                      <div class="sidebar__widge-title-box">
                         <h3 class="sidebar__widget-title">Tags</h3>
                      </div>
                      <div class="sidebar__widget-content">
                         <div class="tagcloud">
                            <a href="#">{{ $data['post']['tags'] }}</a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- postbox area end -->
    </main>
@endsection
@push('js')
<script>
   /**
   *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
   *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
   /*
   var disqus_config = function () {
   this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
   this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
   };
   */
   (function() { // DON'T EDIT BELOW THIS LINE
   var d = document, s = d.createElement('script');
   s.src = 'https://duluin-com.disqus.com/embed.js';
   s.setAttribute('data-timestamp', +new Date());
   (d.head || d.body).appendChild(s);
   })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endpush

