@extends('front.layouts.master')
@section('content')

    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Wishlist Page Start -->
    <div class="cart_area inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="./">
                        <!-- Cart Table -->
                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($products) && count($products) > 0)
                                        @foreach ($products as $product)
                                            @isset($product)
                                                <tr>
                                                    <td class="pro-thumbnail">
                                                        <a href="{{ route('product_detail',encrypt($product->id)) }}">
                                                            <img src="{{ isset($product->product_photo)? asset('storage/app/product/' . $product->product_photo): asset('public/front/image/products/product-2.jpg') }}"
                                                                alt="Product" height="60" width="60">
                                                        </a>
                                                    </td>
                                                    <td class="pro-title"><a
                                                            href="{{ route('product_detail',encrypt($product->id)) }}">{{ $product->product_name ?? '' }}</a>
                                                    </td>
                                                    <td class="pro-price"><span>₹{{ $product->sale_price ?? 00 }}</span>
                                                    </td>
                                                    <td class="pro-price"><span>1</span></td>
                                                    {{-- <td class="pro-quantity">
                                                        <div class="pro-qty">
                                                            <div class="count-input-block">
                                                                1
                                                            </div>
                                                        </div>
                                                    </td> --}}
                                                    <td class="pro-subtotal">
                                                        <span>₹{{ ($product->sale_price ?? 00) * 1 }}</span>
                                                    </td>
                                                    <td class="pro-remove"><a href="javascript:void(0)"
                                                            data-id="{{ $product->id }}" class="delete-wishlist"><i
                                                                class="far fa-trash-alt"></i></a></td>
                                                </tr>
                                            @endisset
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">
                                                    You don't have any product in your Wishlist !!
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- <tr>
                                        <td class="pro-thumbnail"><a href="#"><img src="{{ asset('public/front/image/products/product-details-1.jpg') }}"
                                                    alt="Product"></a></td>
                                        <td class="pro-title"><a href="#">Macrox Glasses</a></td>
                                        <td class="pro-price"><span>$220.00</span></td>
                                        <td class="pro-quantity">
                                            <div class="pro-qty">
                                                <div class="count-input-block">
                                                    <input type="number" class="form-control text-center" value="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pro-subtotal"><span>$220.00</span></td>
                                        <td class="pro-remove"><a href="#"><i class="far fa-trash-alt"></i></a></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
    </div>
@section('script')
    <script>
        $('body').on('click', '.delete-wishlist', function() {
            product_id = $(this).data('id');
            btn = $(this);
            $.ajax({
                url: '{{ route('removeWishlist') }}',
                method: 'POST',
                datatype: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                    wishlist_page: 'wishlist',
                },
                success: function(res) {
                    if (res) {
                        $('body').find('tbody').html(res);
                    }
                },
            });
        });
    </script>
@endsection
@endsection
