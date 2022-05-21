
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
                        @if($product->product_photo && $product->product_photo != null)
                        <!-- Product Details Slider Big Image-->
                        <div class="product-details-slider sb-slick-slider arrow-type-two"
                            data-slick-setting='{"slidesToShow": 1,"arrows": false,"fade": true,"draggable": false,"swipe": false,"asNavFor": ".product-slider-nav"}'>
                            <div class="single-slide">
                                <img src="{{ asset('storage/app/product/'.$product->product_photo) }}" alt="">
                            </div>
                        </div>
                        @else
                        <!-- Product Details Slider Big Image-->
                        <div class="product-details-slider sb-slick-slider arrow-type-two"
                            data-slick-setting='{"slidesToShow": 1,"arrows": false,"fade": true,"draggable": false,"swipe": false,"asNavFor": ".product-slider-nav"}'>
                            <div class="single-slide">
                                <img src="{{ asset('public/front/image/products/product-details-1.jpg') }}" alt="">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-7 mt--30 mt-lg--30">
                        <div class="product-details-info pl-lg--30 ">
                            <p class="tag-block">{{ $categories }}</p>
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
                                {!! $product->product_desc !!}
                            </article>
                            <div class="add-to-cart-row">
                                <div class="count-input-block">
                                    <span class="widget-label">Qty</span>
                                    <input type="number" class="form-control text-center" value="1" maxlength="3">
                                </div>
                                <div class="add-cart-btn">
                                    <a href="" class="btn btn-outlined--primary" data-id="{{ $product->id }}"><span
                                            class="plus-icon">+</span>Add to Cart</a>
                                </div>
                            </div>
                            <div class="compare-wishlist-row">
                                <a href="" class="add-link" data-id="{{ $product->id }}"><i class="fas fa-heart"></i>Add to Wish
                                    List</a>
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
