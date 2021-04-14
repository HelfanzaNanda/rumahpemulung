@extends('layout.main')
@section('title', 'Blog')

@section('content')
  <!-- Header Close -->
  <section class="section-header bg-1">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center">
            <h1 class="text-capitalize mb-4 font-lg text-white">Blog Posts</h1>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section blog-post">
    <div class="container">
      <div class="row">

        <div class="col-lg-4">
          <div class="sidebar-widget mt-5 mt-lg-0">
            <div class="widget mb-5">
              <div id="search" class="widget widget_search">
                <form role="search" class="search-form-widget">
                  <input type="search" class="search-field form-control" placeholder="Search..." value="" name="s"
                    title="Search..">
                  <button type="submit" class="search-submit">
                    <i class="ti-search"></i>
                  </button>
                </form>
              </div>
            </div>

            <div class="widget mb-5 follow">
              <h4 class="mb-3 widget-title font-extra font-md">Follow us</h4>
              <hr>
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-pinterest"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="ti-dribbble"></i></a></li>
              </ul>
            </div>


            <div class="widget mb-5">
              <h4 class="mb-3 widget-title font-extra font-md">Popular Posts</h4>
              <hr>
              <ul class="list-unstyled mt-4">
                <li class="d-flex mb-4">
                  <img src="{{ asset('assets/img/blog/news-sm-img1.jpg') }}" alt="" class="img-fluid mr-3">
                  <div class="post-body">
                    <a href="#">
                      <h4>Salted fried chicken recipe. </h4>
                    </a>
                    <p>May 16, 2019</p>
                  </div>
                </li>
                <li class="d-flex mb-4">
                  <img src="{{ asset('assets/img/blog/news-sm-img2.jpg') }}" alt="" class="img-fluid mr-3">
                  <div class="post-body">
                    <a href="#">
                      <h4>Lemon rosemary rice cooking. </h4>
                    </a>
                    <p>May 16, 2019</p>
                  </div>
                </li>
                <li class="d-flex">
                  <img src="{{ asset('assets/img/blog/news-sm-img3.jpg') }}" alt="" class="img-fluid mr-3">
                  <div class="post-body">
                    <a href="#">
                      <h4>Join Us For a Delicious Event</h4>
                    </a>
                    <p>May 16, 2019</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="widget category mb-5">
              <h4 class="mb-3 widget-title font-extra font-md">Categories</h4>
              <hr>
              <ul class="list-unstyled mt-4">
                <li class="">
                  <a href="#">Web Design</a>
                  <span class="cat-count">(14)</span>
                </li>
                <li class="">
                  <a href="#">Development</a>
                  <span class="cat-count">(12)</span>
                </li>
                <li class="d">
                  <a href="#">Marketing</a>
                  <span class="cat-count">(10)</span>
                </li>
                <li class="">
                  <a href="#">Video Production</a>
                  <span class="cat-count">(1)</span>
                </li>
              </ul>
            </div>
            <div class="widget tags mb-5 ">
              <h4 class="mb-3 widget-title  font-extra font-md">Popular Tags</h4>
              <hr>
              <ul class="list-inline mt-4">
                <li class="list-inline-item"><a href="#">Design</a></li>
                <li class="list-inline-item"><a href="#">Marketing</a></li>
                <li class="list-inline-item"><a href="#">Development</a></li>
                <li class="list-inline-item"><a href="#">Seo</a></li>
                <li class="list-inline-item"><a href="#">agency</a></li>
                <li class="list-inline-item"><a href="#">wordpress</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-8 pr-5">
          <div class="row">
            <div class="col-lg-12">
              <article class="post post-grid mb-5">
                <div class="post-thumb">
                  <a href="/blog-single"><img src="{{ asset('assets/img/blog/1.jpg') }}" alt="" class="img-fluid w-100"></a>
                </div>

                <div class="blog-meta position-relative">
                  <ul class="list-inline">
                    <li class="list-inline-item"><a class="post-cat" href="#">cooking</a></li>
                    <li class="list-inline-item"><span class="date">Oct 16, 2019</span></li>
                    <li class="list-inline-item"><span class="post-comment">| 06 Comment (s)</span></li>
                  </ul>
                </div>

                <div class="blog-content">
                  <h2 class="mb-3"><a href="/blog-single">The Festive Season is Approaching</a></h2>
                  <p>The little rotter spiffing good time lemon squeezy smashing excuse my French old, cheesed off give
                    us a bell happy days brown bread, blow off Harry barney bobby. Cup of char gormless hors.! </p>

                  <a href="/blog-single" class="btn btn-main mt-3">Read More</a>
                </div>
              </article>

              <article class="post post-grid mb-5">
                <div class="post-thumb">
                  <a href="/blog-single"><img src="{{ asset('assets/img/blog/2.jpg') }}" alt="" class="img-fluid w-100"></a>
                </div>

                <div class="blog-meta position-relative">
                  <ul class="list-inline">
                    <li class="list-inline-item"><a class="post-cat" href="#">cooking</a></li>
                    <li class="list-inline-item"><span class="date">Oct 16, 2019</span></li>
                    <li class="list-inline-item"><span class="post-comment">| 06 Comment (s)</span></li>
                  </ul>
                </div>

                <div class="blog-content">
                  <h2 class="mb-3"><a href="/blog-single">Join Us For a Delicious Event</a></h2>
                  <p>The little rotter spiffing good time lemon squeezy smashing excuse my French old, cheesed off give
                    us a bell happy days brown bread, blow off Harry barney bobby. Cup of char gormless hors.! </p>

                  <a href="/blog-single" class="btn btn-main mt-3">Read More</a>
                </div>
              </article>

              <article class="post post-grid mb-5">
                <div class="post-thumb">
                  <a href="/blog-single"><img src="{{ asset('assets/img/blog/3.jpg') }}" alt="" class="img-fluid w-100"></a>
                </div>

                <div class="blog-meta position-relative">
                  <ul class="list-inline">
                    <li class="list-inline-item"><a class="post-cat" href="#">cooking</a></li>
                    <li class="list-inline-item"><span class="date">Oct 16, 2019</span></li>
                    <li class="list-inline-item"><span class="post-comment">| 06 Comment (s)</span></li>
                  </ul>
                </div>

                <div class="blog-content">
                  <h2 class="mb-3"><a href="/blog-single">Salted chicken fried rice</a></h2>
                  <p>The little rotter spiffing good time lemon squeezy smashing excuse my French old, cheesed off give
                    us a bell happy days brown bread, blow off Harry barney bobby. Cup of char gormless hors.! </p>

                  <a href="/blog-single" class="btn btn-main mt-3">Read More</a>
                </div>
              </article>


              <article class="post post-grid mb-5">
                <div class="post-thumb">
                  <a href="/blog-single"><img src="{{ asset('assets/img/blog/4.jpg') }}" alt="" class="img-fluid w-100"></a>
                </div>

                <div class="blog-meta position-relative">
                  <ul class="list-inline">
                    <li class="list-inline-item"><a class="post-cat" href="#">cooking</a></li>
                    <li class="list-inline-item"><span class="date">Oct 16, 2019</span></li>
                    <li class="list-inline-item"><span class="post-comment">| 06 Comment (s)</span></li>
                  </ul>
                </div>

                <div class="blog-content">
                  <h2 class="mb-3"><a href="/blog-single">Rastaurex crab with curry</a></h2>
                  <p>The little rotter spiffing good time lemon squeezy smashing excuse my French old, cheesed off give
                    us a bell happy days brown bread, blow off Harry barney bobby. Cup of char gormless hors.! </p>

                  <a href="/blog-single" class="btn btn-main mt-3">Read More</a>
                </div>
              </article>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Modal login -->
  <div id="mylogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login Account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ url('/login') }}" method="POST">
			      {{ csrf_field() }}
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group form-check mt-0">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Ingat Saya</label>
            </div>
            <div class="modal-footer">
              <div class="submit-button text-center">
                <button class="btn btn-success" id="submit" type="submit">Login</button>
                <div id="msgSubmit" class="h3 text-center hidden"></div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div>
              <div class="text-center">
                <p>Login menggunakan:</p>
                <div class="g-signin2" align="center" data-onsuccess="onSignIn"></div>
              </div>
            </div>
            <br>
            <div>
              <div>
                <a href="/register">Belum punya akun?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Login -->

  </main><!-- End #main -->
@endsection