@extends('front.layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main class="inner-page-sec-padding-bottom">
        <div class="container">

            <div class="row  mb--60">
                <div class="col-lg-5 mb--30">
                    <!-- Product Details Slider Big Image-->
                    <div class="product-details-slider sb-slick-slider arrow-type-two"
                        data-slick-setting='{"slidesToShow": 1,"arrows": false,"fade": true,"draggable": false,"swipe": false,"asNavFor": ".product-slider-nav"}'>
                        <div class="single-slide">
                            <img src="{{ asset('public/front/image/products/product-details-1.jpg') }}" alt="">
                        </div>
                        <div class="single-slide">
                            <img src="{{ asset('public/front/image/products/product-details-2.jpg') }}" alt="">
                        </div>
                        <div class="single-slide">
                            <img src="{{ asset('public/front/image/products/product-details-3.jpg') }}" alt="">
                        </div>
                        <div class="single-slide">
                            <img src="{{ asset('public/front/image/products/product-details-4.jpg') }}" alt="">
                        </div>
                        <div class="single-slide">
                            <img src="{{ asset('public/front/image/products/product-details-5.jpg') }}" alt="">
                        </div>
                    </div>
                    {{-- <!-- Product Details Slider Nav -->
                        <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two" data-slick-setting='{"infinite":true,"autoplay": true,"autoplaySpeed": 8000,"slidesToShow": 4,"arrows": true,"prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},"nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},"asNavFor": ".product-details-slider","focusOnSelect": true}'>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-1.jpg') }}" alt="">
                            </div>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-2.jpg') }}" alt="">
                            </div>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-3.jpg') }}" alt="">
                            </div>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-4.jpg') }}" alt="">
                            </div>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-5.jpg') }}" alt="">
                            </div>
                        </div> --}}
                </div>
                <div class="col-lg-7">
                    @php
                        $categories = [];
                        foreach ($product->category as $category) {
                            array_push($categories, $category->category_name);
                        }
                        $categories = implode(',', $categories);
                        $publications = [];
                        foreach ($product->publication as $publication) {
                            array_push($publications, $publication->publication_name);
                        }
                        $publications = implode(',', $publications);
                    @endphp

                    <div class="product-details-info pl-lg--30 ">
                        {{-- <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p> --}}
                        <p class="tag-block"><a href="#">{{ $categories }}</a></p>
                        <h3 class="product-title">{{ $product->product_name }}</h3>
                        <ul class="list-unstyled">
                            {{-- <li>Ex Tax: <span class="list-value"> ₹60.24</span></li> --}}
                            <li>Publication: <a href="#" class="list-value font-weight-bold"> {{ $publications }}</a></li>
                            <li>Product Code: <span class="list-value"> {{ $product->sku }}</span></li>
                            {{-- <li>Reward Points: <span class="list-value"> 200</span></li> --}}
                            {{-- <li>Availability: <span class="list-value"> In Stock</span></li> --}}
                        </ul>
                        <div class="price-block">
                            <span class="price-new">₹{{ $product->sale_price }}</span>
                            <del class="price-old">₹{{ $product->cutout_price }}</del>
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
                            <p>
                                {!! $product->product_desc !!}
                            </p>
                        </article>
                        <div class="add-to-cart-row">
                            <div class="count-input-block">
                                <span class="widget-label">Qty</span>
                                <input type="number" class="form-control text-center" value="1">
                            </div>
                            <div class="add-cart-btn">
                                <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                    class="btn btn-outlined--primary"><span class="plus-icon">+</span>Add to
                                    Cart</a>
                            </div>
                        </div>
                        <div class="compare-wishlist-row">
                            <a href="javascript:void(0)" data-id="{{ $product->id }}" class="add-link"><i
                                    class="fas fa-heart"></i>Add to Wish List</a>
                            <a href="javascript:void(0)" data-id="{{ $product->id }}" class="add-link"><i
                                    class="fas fa-random"></i>Add to Compare</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sb-custom-tab review-tab section-padding">
                <ul class="nav nav-tabs nav-style-2" id="myTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab1" data-toggle="tab" href="#tab-1" role="tab"
                            aria-controls="tab-1" aria-selected="true">
                            DESCRIPTION
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                            aria-selected="true">
                            REVIEWS (1)
                        </a>
                    </li>
                </ul>
                <div class="tab-content space-db--20" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1">
                        <article class="review-article">
                            <h1 class="sr-only">Tab Article</h1>
                            {!! $product->product_desc !!}
                        </article>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2">
                        <div class="review-wrapper">
                            <h2 class="title-lg mb--20">1 REVIEW FOR AUCTOR GRAVIDA ENIM</h2>
                            <div class="review-comment mb--20">
                                <div class="avatar">
                                    <img src="{{ asset('public/front/image/icon/author-logo.png') }}" alt="">
                                </div>
                                <div class="text">
                                    <div class="rating-block mb--15">
                                        <span class="ion-android-star-outline star_on"></span>
                                        <span class="ion-android-star-outline star_on"></span>
                                        <span class="ion-android-star-outline star_on"></span>
                                        <span class="ion-android-star-outline"></span>
                                        <span class="ion-android-star-outline"></span>
                                    </div>
                                    <h6 class="author">ADMIN – <span class="font-weight-400">March 23, 2015</span>
                                    </h6>
                                    <p>Lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                        quis mi.</p>
                                </div>
                            </div>
                            <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                            <div class="rating-row pt-2">
                                <p class="d-block">Your Rating</p>
                                <span class="rating-widget-block">
                                    <input type="radio" name="star" id="star1">
                                    <label for="star1"></label>
                                    <input type="radio" name="star" id="star2">
                                    <label for="star2"></label>
                                    <input type="radio" name="star" id="star3">
                                    <label for="star3"></label>
                                    <input type="radio" name="star" id="star4">
                                    <label for="star4"></label>
                                    <input type="radio" name="star" id="star5">
                                    <label for="star5"></label>
                                </span>
                                <form action="./" class="mt--15 site-form ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="message">Comment</label>
                                                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="text" id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" id="website" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="submit-btn">
                                                <a href="#" class="btn btn-black">Post Comment</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="tab-product-details">
      <div class="brand">
        <img src="image/others{{ asset('public/front/review-tab-product-details.jpg') }}" alt="">
      </div>
      <h5 class="meta">Reference <span class="small-text">demo_5</span></h5>
      <h5 class="meta">In stock <span class="small-text">297 Items</span></h5>
      <section class="product-features">
        <h3 class="title">Data sheet</h3>
        <dl class="data-sheet">
          <dt class="name">Compositions</dt>
          <dd class="value">Viscose</dd>
          <dt class="name">Styles</dt>
          <dd class="value">Casual</dd>
          <dt class="name">Properties</dt>
          <dd class="value">Maxi Dress</dd>
        </dl>
      </section>
    </div> -->
        </div>
        <!--=================================
        RELATED PRODUCTS BOOKS
    ===================================== -->
        <section class="">
            <div class="container">
                <div class="section-title section-title--bordered">
                    <h2>RELATED PRODUCTS</h2>
                </div>
                <div class="product-slider sb-slick-slider slider-border-single-row" data-slick-setting='{
                    "autoplay": true,
                    "autoplaySpeed": 8000,
                    "slidesToShow": 4,
                    "dots":true
                }' data-slick-responsive='[
                    {"breakpoint":1200, "settings": {"slidesToShow": 4} },
                    {"breakpoint":992, "settings": {"slidesToShow": 3} },
                    {"breakpoint":768, "settings": {"slidesToShow": 2} },
                    {"breakpoint":480, "settings": {"slidesToShow": 1} }
                ]'>
                    @foreach ($relatedProducts as $related)
                        <div class="single-slide">
                            <div class="product-card">
                                <div class="product-header">
                                    <a href="" class="author">
                                        {{ $related->category[0]->category_name }}
                                    </a>
                                    <h3><a
                                            href="{{ route('product_detail', encrypt($related->id)) }}">{{ $related->product_name }}</a>
                                    </h3>
                                </div>
                                <div class="product-card--body">
                                    <div class="card-image">
                                        <img src="{{ isset($related->product_image)? asset('storage/product/' . $related->product_image): asset('public/front/image/products/product-10.jpg') }}"
                                            alt="">
                                        <div class="hover-contents">
                                            <a href="{{ route('product_detail', encrypt($related->id)) }}"
                                                class="hover-image">
                                                <img src="{{ isset($related->product_image)? asset('storage/product/' . $related->product_image): asset('public/front/image/products/product-1.jpg') }}"
                                                    alt="">
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
                                                    data-id="{{ $related->id }}" class="single-btn viewRelated">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price-block">
                                        <span class="price">₹{{ $related->sale_price }}</span>
                                        <del class="price-old">₹{{ $related->cutout_price }}</del>
                                        {!! substr($product->product_desc, 0, 20) . '...' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog" aria-labelledby="quickModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="product-details-modal">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product Details Slider Big Image-->
                                <div class="product-details-slider sb-slick-slider arrow-type-two"
                                    data-slick-setting='{"slidesToShow": 1,"arrows": false,"fade": true,"draggable": false,"swipe": false,"asNavFor": ".product-slider-nav"}'>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-1.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-2.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-3.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-4.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="single-slide">
                                        <img src="{{ asset('public/front/image/products/product-details-5.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                                {{-- <!-- Product Details Slider Nav -->
                                    <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two"
                                        data-slick-setting='{"infinite":true,"autoplay": true,"autoplaySpeed": 8000,"slidesToShow": 4,"arrows": true,"prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},"nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},"asNavFor": ".product-details-slider","focusOnSelect": true}'>
                                        <div class="single-slide">
                                            <img src="{{ asset('public/front/image/products/product-details-1.jpg') }}" alt="">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{ asset('public/front/image/products/product-details-2.jpg') }}" alt="">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{ asset('public/front/image/products/product-details-3.jpg') }}" alt="">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{ asset('public/front/image/products/product-details-4.jpg') }}" alt="">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{ asset('public/front/image/products/product-details-5.jpg') }}" alt="">
                                        </div>
                                    </div> --}}
                            </div>
                            <div class="col-lg-7 mt--30 mt-lg--30">
                                <div class="product-details-info pl-lg--30 ">
                                    <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p>
                                    <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                    <ul class="list-unstyled">
                                        {{-- <li>Ex Tax: <span class="list-value"> ₹60.24</span></li> --}}
                                        <li>Publication: <a href="#" class="list-value font-weight-bold"> publications</a></li>
                                        <li>Product Code: <span class="list-value"> sku</span></li>
                                        {{-- <li>Reward Points: <span class="list-value"> 200</span></li> --}}
                                        {{-- <li>Availability: <span class="list-value"> In Stock</span></li> --}}
                                    </ul>
                                    <div class="price-block">
                                        <span class="price-new">₹73.79</span>
                                        <del class="price-old">₹91.86</del>
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
                                        <p>Long printed dress with thin adjustable straps. V-neckline and wiring
                                            under the Dust with ruffles at the bottom
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
                                        <a href="" class="add-link"><i class="fas fa-heart"></i>Add to Wish
                                            List</a>
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
    </main>
    </div>
@endsection
@section('script')
    <script>
        $('body').on('click', '.viewRelated',function(){
            related_product = $(this).data('id');
            $.ajax({
                url: '{{ route("relatedproduct_detail") }}',
                method: 'POST',
                datatype: 'json',
                data:{
                    '_token':"{{ csrf_token() }}",
                    id : related_product,
                },
                success:function(res){
                    var model = $('body').find('.product-details-modal');
                    model.find('p.tag-block').text(res['categories']);

                    model.find('h3.product-title').text(res['product']['product_name']);
                    model.find('h3.product-title').text(res['product']['product_name']);
                    model.find('.list-unstyled li:first .list-value').text(res['publications']);
                    model.find('.list-unstyled li:last .list-value').text(res['product']['sku']);

                    model.find('.price-block .price-new').text('₹'+ res['product']['sale_price']);
                    model.find('.price-block .price-old').text('₹'+ res['product']['cutout_price']);

                    model.find('.product-details-article p').html(res['product']['product_desc']);

                    model.find('.add-cart-btn a').attr('data-id',res['product']['id']);
                    model.find('.compare-wishlist-row .add-link:first').attr('data-id',res['product']['id']);
                    model.find('.compare-wishlist-row .add-link:last').attr('data-id',res['product']['id']);

                    let src = model.find('.single-slide img').attr('src');
                    if(res['product']['product_photo'] && res['product']['product_photo'] != null){
                        model.find('.single-slide img').attr('src',res['product']['product_photo']);
                    }
                    // console.log(res['product']);
                },
            });
        });
    </script>
@endsection
