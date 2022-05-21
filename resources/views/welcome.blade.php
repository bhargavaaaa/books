@extends('front.layouts.master')
@section('content')
    <!--=================================
            Hero Area
        ===================================== -->
    <section class="hero-area hero-slider-3">
        <div class="sb-slick-slider" data-slick-setting='{
                                                            "autoplay": true,
                                                            "autoplaySpeed": 8000,
                                                            "slidesToShow": 1,
                                                            "dots":true
                                                            }'>
            {{-- <div class="single-slide bg-image  bg-overlay--dark" data-bg="{{ asset('public/front/image/bg-images/home-3-slider-1.jpg') }}">
                    <div class="container">
                        <div class="home-content text-center">
                            <div class="row justify-content-end">
                                <div class="col-lg-6">
                                    <h1>Beautifully Designed</h1>
                                    <h2>Cover up front of book and
                                        <br>leave summary</h2>
                                    <a href="shop-grid.html" class="btn btn--yellow">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @foreach ($banners as $banner)
                <div class="single-slide bg-image  bg-overlay--dark"
                    data-bg="{{ asset('storage/app/banner/' . $banner->image) }}">
                    <div class="container">
                        <div class="home-content pl--30">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1>I Love This Idea!</h1>
                                    <h2>Cover up front of book and
                                        <br>leave summary
                                    </h2>
                                    <a href="shop-grid.html" class="btn btn--yellow">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--=================================
            Home Category Gallery
        ===================================== -->
    <section class="pt--30 section-margin">
        {{-- <h2 class="sr-only">Category Gallery Section</h2>
            <div class="container">
                <div class="category-gallery-block">
                    <a href="#" class="single-block hr-large">
                        <img src="{{ ($categories[0] != null) ? asset('storage/app/category/'. $categories[0]) : asset('public/front/image/others/cat-gal-large.png')}}" alt="">
                    </a>
                    <div class="single-block inner-block-wrapper">
                        <a href="#" class="single-image mid-image">
                            <img src="{{ ($categories[0] != null) ? asset('storage/app/category/'. $categories[0]) : asset('public/front/image/others/cat-gal-mid.png')}}" alt="">
                        </a>
                        <a href="#" class="single-image small-image">
                            <img src="{{ ($categories[0] != null) ? asset('storage/app/category/'. $categories[0]) : asset('public/front/image/others/cat-gal-small.png')}}" alt="">
                        </a>
                        <a href="#" class="single-image small-image">
                            <img src="{{ ($categories[0] != null) ? asset('storage/app/category/'. $categories[0]) : asset('public/front/image/others/cat-gal-small-2.jpg')}}" alt="">
                        </a>
                        <a href="#" class="single-image mid-image">
                            <img src="{{ ($categories[0] != null) ? asset('storage/app/category/'. $categories[0]) : asset('public/front/image/others/cat-gal-mid-2.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div> --}}
    </section>
    <!--=================================
        ARTS & PHOTOGRAPHY BOOKS
    ===================================== -->
    @foreach ($categories as $category)
        <section class="section-margin">
            <div class="container">
                <div class="section-title section-title--bordered">
                    <h2>{{ $category->category_name }}</h2>
                </div>
                <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                                "autoplay": true,
                                "autoplaySpeed": 8000,
                                "slidesToShow": 5,
                                "dots":true
                            }' data-slick-responsive='[
                                {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                                {"breakpoint":992, "settings": {"slidesToShow": 3} },
                                {"breakpoint":768, "settings": {"slidesToShow": 2} },
                                {"breakpoint":480, "settings": {"slidesToShow": 1} },
                                {"breakpoint":320, "settings": {"slidesToShow": 1} }
                            ]'>

                    @foreach ($category->product as $product)
                        @if (isset($product) && $product->is_active == '1')
                            <div class="single-slide">
                                <div class="product-card">
                                    <div class="product-header">
                                        <a href="" class="author">
                                            {{ isset($product->publication) ? $product->publication[0]->publication_name : '' }}
                                        </a>
                                        <h3><a href="{{ route('product_detail',encrypt($product->id)) }}">{{ $product->product_name }}</a></h3>
                                    </div>
                                    <div class="product-card--body">
                                        <div class="card-image">
                                            <img src="{{ isset($product->product_photo)? asset('storage/app/product/' . $product->product_photo): asset('public/front/image/products/product-2.jpg') }}"
                                                alt="" height="230" width="230">
                                            <div class="hover-contents">
                                                <a href="{{ route('product_detail',encrypt($product->id)) }}" class="hover-image">
                                                    <img src="{{ isset($product->product_photo)? asset('storage/app/product/' . $product->product_photo): asset('public/front/image/products/product-1.jpg') }}"
                                                    alt="" height="230" width="230">
                                                </a>
                                                <div class="hover-btns">
                                                    <a href="{{ route('cart') }}" class="single-btn">
                                                        <i class="fas fa-shopping-basket"></i>
                                                    </a>
                                                    {{-- <a href="" class="single-btn">
                                                        <i class="fas fa-heart"></i>
                                                    </a> --}}
                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif


                                                    <a href="#" data-toggle="modal" {{-- data-target="#quickModal" --}}
                                                    data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="price-block">
                                            <span class="price">₹ {{ $product->sale_price }}</span>
                                            <del class="price-old">₹
                                                {{ isset($product->cutout_price) ? $product->cutout_price : '₹ 0' }}</del>
                                            {{-- <span class="price-discount">20%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{-- <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        Jpple
                                    </a>
                                    <h3><a href="product-details.html">Turn Your BOOK Into High Machine</a>
                                    </h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-10.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-1.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>

                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn c" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        Wpple
                                    </a>
                                    <h3><a href="product-details.html">3 Ways Create Better BOOK With</a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-3.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-2.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        Epple
                                    </a>
                                    <h3><a href="product-details.html">What You Can Learn From Bill Gates</a>
                                    </h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-5.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-4.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        Hpple
                                    </a>
                                    <h3><a href="product-details.html">a Half Very Simple Things You To</a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-6.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-4.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>

                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        Bpple
                                    </a>
                                    <h3><a href="product-details.html">Here Is A Quick Cure For Book</a>
                                    </h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-8.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-7.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>

                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        zpple
                                    </a>
                                    <h3><a href="product-details.html">BOOK: Do You Really Need It? This </a></h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ asset('public/front/image/products/product-13.jpg')}}" alt="">
                                        <div class="hover-contents">
                                            <a href="product-details.html" class="hover-image">
                                                <img src="{{ asset('public/front/image/products/product-11.jpg')}}" alt="">
                                            </a>
                                            <div class="hover-btns">
                                                <a href="{{ route('cart') }}" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="{{ route('wishlist') }}" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>

                                                    @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn remove-wishlist" title="Added To Wishlist"><i
                                                            class="fas fa-heart"></i> </a>
                                                    @else
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="single-btn add-wishlist" title="Add To Wishlist"><i class="fas fa-heart"></i> </a>
                                                    @endif

                                                <a href="#" data-toggle="modal" data-id="{{ $product->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">£51.20</span>
                                        <del class="price-old">£51.20</del>
                                        <span class="price-discount">20%</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                </div>
            </div>
        </section>
    @endforeach
    <!--=================================
            Home Features Section
        ===================================== -->
    <section class="mb--30 space-dt--30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="text">
                            <h5>Free Shipping Item</h5>
                            <p> Orders over $500</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-redo-alt"></i>
                        </div>
                        <div class="text">
                            <h5>Money Back Guarantee</h5>
                            <p>100% money back</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="text">
                            <h5>Cash On Delivery</h5>
                            <p>Lorem ipsum dolor amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mt--30">
                    <div class="feature-box h-100">
                        <div class="icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <div class="text">
                            <h5>Help & Support</h5>
                            <p>Call us : + 0123.4567.89</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
            Promotion Section One
        ===================================== -->
    <section class="section-margin">
        <h1 class="sr-only">Promotion Section</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="" class="promo-image promo-overlay">
                        <img src="{{ asset('public/front/image/bg-images/promo-banner-with-text.jpg') }}" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <a href="" class="promo-image promo-overlay">
                        <img src="{{ asset('public/front/image/bg-images/promo-banner-with-text-2.jpg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--=================================
            CLIENT TESTIMONIALS
        ===================================== -->
    <!-- <section class="section-margin">
                <div class="container">
                    <div class="section-title section-title--bordered mb-lg--60">
                        <h2>CLIENT TESTIMONIALS</h2>
                    </div>
                    <div class="sb-slick-slider testimonial-slider" data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow":3,
                    "dots":true
                }' data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 2} },
                    {"breakpoint":992, "settings": {"slidesToShow": 1} },
                    {"breakpoint":768, "settings": {"slidesToShow": 1} },
                    {"breakpoint":490, "settings": {"slidesToShow": 1} }
                ]'>
                        <div class="single-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-image">
                                    <img src="{{ asset('public/front/image/others/client-1.png') }}" alt="">
                                </div>
                                <div class="testimonial-body">
                                    <article>
                                        <h2 class="sr-only">Testimonial Article</h2>
                                        <p>version This is Photoshops of Lorem Ipsum. Proin gravida nibh vel velit.Lorem
                                            ipsum dolor sit amet, consectetur
                                            adipiscing elit. In molestie augue magna. Pell..</p>
                                        <span class="d-block client-name">Rebecka Filson</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-image">
                                    <img src="{{ asset('public/front/image/others/client-2.png') }}" alt="">
                                </div>
                                <div class="testimonial-body">
                                    <article>
                                        <h2 class="sr-only">Testimonial Article</h2>
                                        <p>In molestie augue magna.This is Photoshops version of Lorem Ipsum. Proin gravida
                                            nibh vel velit.Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Pell..</p>
                                        <span class="d-block client-name">Rebecka Filson</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-image">
                                    <img src="{{ asset('public/front/image/others/client-3.png') }}" alt="">
                                </div>
                                <div class="testimonial-body">
                                    <article>
                                        <h2 class="sr-only">Testimonial Article</h2>
                                        <p>Lorem Ipsum This is Photoshops version of . Proin gravida nibh vel velit.Lorem
                                            ipsum dolor sit amet, consectetur
                                            adipiscing elit. In molestie augue magna. Pell..</p>
                                        <span class="d-block client-name">Rebecka Filson</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-image">
                                    <img src="{{ asset('public/front/image/others/client-4.png') }}" alt="">
                                </div>
                                <div class="testimonial-body">
                                    <article>
                                        <h2 class="sr-only">Testimonial Article</h2>
                                        <p>elit. In molestie This is Photoshops version of Lorem Ipsum. Proin gravida nibh
                                            vel velit.Lorem ipsum dolor sit amet, consectetur
                                            adipiscing augue magna. Pell..</p>
                                        <span class="d-block client-name">Rebecka Filson</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="single-slide">
                            <div class="testimonial-card">
                                <div class="testimonial-image">
                                    <img src="{{ asset('public/front/image/others/client-5.png') }}" alt="">
                                </div>
                                <div class="testimonial-body">
                                    <article>
                                        <h2 class="sr-only">Testimonial Article</h2>
                                        <p>Pell Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit.Lorem ipsum
                                            dolor sit amet, consectetur
                                            adipiscing elit. In molestie augue magna. This is..</p>
                                        <span class="d-block client-name">Rebecka Filson</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->

    <div id="modelView"></div>

    </div>
@endsection
@section('script')
    <script>
        $('body').on('click', '.viewRelated', function(e) {
            related_product = $(this).data('id');
            $.ajax({
                url: '{{ route('relatedproduct_detail') }}',
                method: 'POST',
                // datatype: 'json',
                datatype: 'html',
                data: {
                    '_token': "{{ csrf_token() }}",
                    id: related_product,
                },
                success: function(res) {
                    $('body').find('#modelView').html(res);
                    $('#quickModal').modal({
                        show: true
                    });
                },
            });
        });
    </script>
@endsection
