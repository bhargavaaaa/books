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
                    <div class="single-slide bg-image  bg-overlay--dark" data-bg="{{ asset('storage/app/banner/'.$banner->image) }}">
                        <div class="container">
                            <div class="home-content pl--30">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h1>I Love This Idea!</h1>
                                        <h2>Cover up front of book and
                                            <br>leave summary</h2>
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
                            @if ($product->is_active == '1')
                                <div class="single-slide">
                                    <div class="product-card">
                                        <div class="product-header">
                                            <a href="" class="author">
                                                {{ isset($product->publication) ? $product->publication[0]->publication_name : '' }}
                                            </a>
                                            <h3><a href="product-details.html">{{ $product->product_name }}</a></h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                <img src="{{ (isset($product->product_photo)) ? asset('storage/app/product/'.$product->product_photo) : asset('public/front/image/products/product-2.jpg')}}" alt="" height="200">
                                                <div class="hover-contents">
                                                    <a href="product-details.html" class="hover-image">
                                                        <img src="{{ asset('public/front/image/products/product-1.jpg')}}" alt="">
                                                    </a>
                                                    <div class="hover-btns">
                                                        <a href="cart.html" class="single-btn">
                                                            <i class="fas fa-shopping-basket"></i>
                                                        </a>
                                                        <a href="wishlist.html" class="single-btn">
                                                            <i class="fas fa-heart"></i>
                                                        </a>
                                                        <a href="compare.html" class="single-btn">
                                                            <i class="fas fa-random"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#quickModal"
                                                            class="single-btn">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price-block">
                                                <span class="price">₹ {{ $product->sale_price }}</span>
                                                <del class="price-old">₹ {{ isset($product->cutout_price) ? $product->cutout_price : '₹ 0' }}</del>
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                                                <a href="cart.html" class="single-btn">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                                <a href="wishlist.html" class="single-btn">
                                                    <i class="fas fa-heart"></i>
                                                </a>
                                                <a href="compare.html" class="single-btn">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#quickModal"
                                                    class="single-btn">
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
                            <img src="{{ asset('public/front/image/bg-images/promo-banner-with-text.jpg')}}" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="" class="promo-image promo-overlay">
                            <img src="{{ asset('public/front/image/bg-images/promo-banner-with-text-2.jpg')}}" alt="">
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
                                <img src="{{ asset('public/front/image/others/client-1.png')}}" alt="">
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
                                <img src="{{ asset('public/front/image/others/client-2.png')}}" alt="">
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
                                <img src="{{ asset('public/front/image/others/client-3.png')}}" alt="">
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
                                <img src="{{ asset('public/front/image/others/client-4.png')}}" alt="">
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
                                <img src="{{ asset('public/front/image/others/client-5.png')}}" alt="">
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

        <!-- Modal -->
        <div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog"
            aria-labelledby="quickModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="product-details-modal">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product Details Slider Big Image-->
                                <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
              "slidesToShow": 1,
              "arrows": false,
              "fade": true,
              "draggable": false,
              "swipe": false,
              "asNavFor": ".product-slider-nav"
              }'>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-1.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-2.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-3.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-4.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-5.jpg')}}" alt="">
                                    </div>
                                </div>
                                <!-- Product Details Slider Nav -->
                                <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two"
                                    data-slick-setting='{
            "infinite":true,
              "autoplay": true,
              "autoplaySpeed": 8000,
              "slidesToShow": 4,
              "arrows": true,
              "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
              "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
              "asNavFor": ".product-details-slider",
              "focusOnSelect": true
              }'>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-1.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-2.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-3.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-4.jpg')}}" alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-5.jpg')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 mt--30 mt-lg--30">
                                <div class="product-details-info pl-lg--30 ">
                                    <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p>
                                    <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                    <ul class="list-unstyled">
                                        <li>Ex Tax: <span class="list-value"> £60.24</span></li>
                                        <li>Brands: <a href="#" class="list-value font-weight-bold"> Canon</a></li>
                                        <li>Product Code: <span class="list-value"> model1</span></li>
                                        <li>Reward Points: <span class="list-value"> 200</span></li>
                                        <li>Availability: <span class="list-value"> In Stock</span></li>
                                    </ul>
                                    <div class="price-block">
                                        <span class="price-new">£73.79</span>
                                        <del class="price-old">£91.86</del>
                                    </div>
                                    <div class="rating-widget">
                                        <div class="rating-block">
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star star_on"></span>
                                            <span class="fas fa-star "></span>
                                        </div>
                                        <div class="review-widget">
                                            <a href="">(1 Reviews)</a> <span>|</span>
                                            <a href="">Write a review</a>
                                        </div>
                                    </div>
                                    <article class="product-details-article">
                                        <h4 class="sr-only">Product Summery</h4>
                                        <p>Long printed dress with thin adjustable straps. V-neckline and wiring under
                                            the Dust with ruffles at the bottom
                                            of the
                                            dress.</p>
                                    </article>
                                    <div class="add-to-cart-row">
                                        <div class="count-input-block">
                                            <span class="widget-label">Qty</span>
                                            <input type="number" class="form-control text-center" value="1">
                                        </div>
                                        <div class="add-cart-btn">
                                            <a href="" class="btn btn-outlined--primary"><span
                                                    class="plus-icon">+</span>Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="compare-wishlist-row">
                                        <a href="" class="add-link"><i class="fas fa-heart"></i>Add to Wish List</a>
                                        <a href="" class="add-link"><i class="fas fa-random"></i>Add to Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="widget-social-share">
                            <span class="widget-label">Share:</span>
                            <div class="modal-social-share">
                                <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="single-icon"><i class="fab fa-google-plus-g"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=================================
    Footer
===================================== -->
    </div>
@endsection
