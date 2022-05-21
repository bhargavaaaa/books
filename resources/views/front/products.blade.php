@extends('front.layouts.master')
@section('content')
<style>
    .fa-shopping-cart{
        color: #62ab00 !important;
    }
</style>


<section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main class="inner-page-sec-padding-bottom" id="load_data">
        <div class="container">
            <div class="shop-toolbar mb--30">
                <div class="row align-items-center">
                    {{-- <div class="col-lg-2 col-md-2 col-sm-6">
							<!-- Product View Mode -->
							<div class="product-view-mode">
								<a href="#" class="sorting-btn" data-target="grid"><i class="fas fa-th"></i></a>
								<a href="#" class="sorting-btn" data-target="grid-four">
									<span class="grid-four-icon">
										<i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
									</span>
								</a>
								<a href="#" class="sorting-btn active" data-target="list "><i
										class="fas fa-list"></i></a>
							</div>
						</div> --}}
                    <div class="col-xl-8 col-md-8 col-sm-12  mt--10 mt-sm--0">
                        <span class="toolbar-status">
                            Showing 1 to 10 of {{ $productCount }} (1 Pages)
                        </span>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                        <div class="sorting-selection">
                            <span>Sort By:</span>
                            <select class="form-control nice-select sort-select mr-0">
                                <option value="default" selected="selected">Default Sorting</option>
                                <option value="sort_A-Z">Sort
                                    By:Name (A - Z)</option>
                                <option value="sort_Z-A">Sort
                                    By:Name (Z - A)</option>
                                <option value="sort_Low-High">Sort
                                    By:Price (Low &gt; High)</option>
                                <option value="sort_High-Low">Sort
                                    By:Price (High &gt; Low)</option>
                                {{-- <option value="">Sort
                                <option value="sort_Rating-Highest">Sort
                                    By:Rating (Highest)</option>
                                <option value="sort_Rating-Lowest">Sort
                                    By:Rating (Lowest)</option>
                                    By:Model (A - Z)</option>
                                <option value="">Sort
                                    By:Model (Z - A)</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-toolbar d-none">
                <div class="row align-items-center">
                    {{-- <div class="col-lg-2 col-md-2 col-sm-6">
							<!-- Product View Mode -->
							<div class="product-view-mode">
								<a href="#" class="sorting-btn active" data-target="grid"><i class="fas fa-th"></i></a>
								<a href="#" class="sorting-btn" data-target="grid-four">
									<span class="grid-four-icon">
										<i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
									</span>
								</a>
								<a href="#" class="sorting-btn" data-target="list "><i class="fas fa-list"></i></a>
							</div>
						</div> --}}
                    <div class="col-xl-8 col-md-8 col-sm-12  mt--10 mt-sm--0">
                        <span class="toolbar-status">
                            Showing 1 to 10 of {{ $productCount }} (1 Pages)
                        </span>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                        <div class="sorting-selection">
                            <span>Sort By:</span>
                            <select class="form-control nice-select sort-select mr-0">
                                <option value="default" selected="selected">Default Sorting</option>
                                <option value="sort_A-Z">Sort
                                    By:Name (A - Z)</option>
                                <option value="sort_Z-A">Sort
                                    By:Name (Z - A)</option>
                                <option value="sort_Low-High">Sort
                                    By:Price (Low &gt; High)</option>
                                <option value="sort_High-Low">Sort
                                    By:Price (High &gt; Low)</option>
                                {{-- <option value="">Sort
                                <option value="sort_Rating-Highest">Sort
                                    By:Rating (Highest)</option>
                                <option value="sort_Rating-Lowest">Sort
                                    By:Rating (Lowest)</option>
                                <option value="">Sort
                                    By:Model (A - Z)</option>
                                <option value="">Sort
                                    By:Model (Z - A)</option> --}}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop-product-wrap list with-pagination row space-db--30 shop-border">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-card card-style-list">
                            <div class="product-list-content">
                                <div class="card-image">
                                    @if (isset($product->product_photo))

                                        <img src="{{ asset('storage/app/product/' . $product->product_photo) }}" alt="">
                                    @else
                                        <img src="{{ asset('public/front/image/products/product-3.jpg') }}" alt="">
                                    @endif

                                </div>
                                <div class="product-card--body">
                                    <div class="product-header">
                                        <a href="" class="author">
                                            {{ count($product->category) > 0 ? $product->category[0]->category_name : '' }}
                                        </a>
                                        <h3>
                                            <a href="{{ route('product_detail', encrypt($product->id)) }}" tabindex="0">
                                                {{ $product->product_name }}
                                            </a>
                                        </h3>
                                    </div>
                                    <article>
                                        <h2 class="sr-only">Card List Article</h2>
                                        <p>
                                            {!! substr(trim($product->product_desc), 0, 100) . '...' !!}
                                        </p>
                                    </article>
                                    <div class="price-block">
                                        <span class="price">₹ {{ $product->sale_price }}</span>
                                        <del class="price-old">₹ {{ $product->cutout_price }}</del>
                                        {{-- <span class="price-discount">20%</span> --}}
                                    </div>
                                    <div class="rating-block">
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star "></span>
                                    </div>
                                    <div class="btn-block">
                                        <a href="{{ route('product_detail', encrypt($product->id)) }}"
                                            class="btn btn-outlined">View</a>

                                        @if (session()->has('my_wishlist') && in_array($product->id,session('my_wishlist')))
                                        <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                            class="card-link remove-wishlist"  title="Added To Wishlist"><i
                                                class="fas fa-heart"></i> </a>
                                        @else
                                        <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                            class="card-link add-wishlist"><i class="fas fa-heart"></i> Add To
                                            Wishlist</a>
                                        @endif

                                        @if (session()->has('my_cart') && in_array($product->id,session('my_cart')))
                                        <a href="{{ route('cart') }}" data-id="{{ $product->id }}" class="card-link" title="Go To Cart"><i class="fas fa-shopping-cart"></i> </a>
                                        @else
                                        <a href="javascript:void(0)" data-id="{{ $product->id }}" class="card-link addToCart"><i class="fas fa-random"></i> Add To Cart</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @php
                $l_id = [];
                foreach ($products as $product) {
                    array_push($l_id, $product->id);
                }
                sort($l_id);
                $last_id = $l_id;
                // $last_id = last($l_id);
                // $last_id = $l_id[0];
            @endphp
            <input type="hidden" name="last_id" id="last_id" value="{{ $products ? json_encode($last_id) : null }}">
            <!-- Pagination Block -->
            <div class="row pt--30">
                <div class="col-md-12">
                    <div class="pagination-block">
                        <ul class="pagination-btns flex-center">
                            <li><a href="javascript:void(0)" class="single-btn prev-btn ">|<i
                                        class="zmdi zmdi-chevron-left"></i> </a>
                            </li>
                            {{-- <li><a href="javascript:void(0)" class="single-btn prev-btn "><i class="zmdi zmdi-chevron-left"></i> </a>
                            </li> --}}

                            @php
                                $pages = ceil($productCount / 2);
                                $cnt = 1;
                            @endphp

                            @if ($productCount >= 1)
                                @for ($i = 1; $i <= $pages; $i++)
                                    @if ($cnt == 5)
                                    @break
                                @endif

                                @if ($i == 1)
                                    <li class="active">
                                        <a href="javascript:void(0)" class="single-btn paginate-btn"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="javascript:void(0)" class="single-btn paginate-btn"
                                            data-page="{{ $i }}">{{ $i }}</a>
                                    </li>
                                @endif

                                @php $cnt++ @endphp
                            @endfor
                        @endif
                        {{-- <li class="active"><a href="javascript:void(0)" class="single-btn paginate-btn"
                                    data-page="1">1</a></li> --}}

                        {{-- <li><a href="javascript:void(0)" class="single-btn paginate-btn" data-page="3">3</a></li>
                                    <li><a href="javascript:void(0)" class="single-btn paginate-btn" data-page="4">4</a></li>
                                    <li><a href="javascript:void(0)" class="single-btn paginate-btn" data-page="5">5</a></li> --}}
                        {{-- <li><a href="javascript:void(0)" class="single-btn paginate-btn next-btn" data-page="5"><i class="zmdi zmdi-chevron-right"></i></a>
                            </li> --}}
                        <li>
                            <a href="javascript:void(0)" class="single-btn paginate-btn next-btn"
                                data-page="{{ $i }}">
                                <i class="zmdi zmdi-chevron-right"></i>|</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

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
                            </div>
                            <div class="col-lg-7 mt--30 mt-lg--30">
                                <div class="product-details-info pl-lg--30 ">
                                    <p class="tag-block">Tags: <a href="#">Movado</a>, <a href="#">Omega</a></p>
                                    <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                    <ul class="list-unstyled">
                                        <li>Ex Tax: <span class="list-value"> ₹ 60.24</span></li>
                                        <li>Brands: <a href="#" class="list-value font-weight-bold"> Canon</a>
                                        </li>
                                        <li>Product Code: <span class="list-value"> model1</span></li>
                                        <li>Reward Points: <span class="list-value"> 200</span></li>
                                        <li>Availability: <span class="list-value"> In Stock</span></li>
                                    </ul>
                                    <div class="price-block">
                                        <span class="price-new">₹ 73.79</span>
                                        <del class="price-old">₹ 91.86</del>
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
                                            <a href="javascript:void(0)" class="btn btn-outlined--primary addToCart"><span
                                                    class="plus-icon">+</span>Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="compare-wishlist-row">
                                        @if (true)
                                            <a href="javascript:void(0)" class="add-link"
                                                style="color: #62ab00;"><i class="fas fa-heart"></i> Added To
                                                Wishlist</a>
                                        @else
                                            <a href="javascript:void(0)" class="add-link"><i
                                                    class="fas fa-heart"></i>Add to WishList</a>
                                        @endif
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
    </div>
</main>
</div>
@section('script')
    <script>
        function load_product(page, sort_select, last_id) {

            if (page != null && sort_select != null) {
                $.ajax({
                    url: '{{ route('load_products') }}',
                    method: 'post',
                    datatype: 'html',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        last_id: last_id,
                        page: page,
                        sort_select: sort_select,
                    },
                    success: function(res) {
                        $('body').find('#load_data').html(res);
                    },
                });
            }
        }

        $('body').on('click', '.paginate-btn', function(e) {
            e.preventDefault();

            let page = $(this).data('page');
            let sort_select = $('body').find('.sort-select').val();
            let last_id = $('#last_id').val();
            load_product(page, sort_select, last_id);
        });

        $('body').on('change', '.sort-select', function(e) {
            e.preventDefault();

            let page = $('body').find('.paginate-btn').data('page');
            let last_id = $('body').find('#last_id').val(null);
            let sort_select = $(this).val();
            last_id = null;
            page = 1;
            load_product(page, sort_select, last_id);
        });


    </script>
@endsection
@endsection
