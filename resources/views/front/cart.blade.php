@extends('front.layouts.master')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Cart Page Start -->
    <main class="cart-page-main-block inner-page-sec-padding-bottom">
        <div class="cart_area cart-area-padding ">
            <div class="container">
                <div class="page-section-title">
                    <h1>Shopping Cart</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form method="post" id="form" onsubmit="false">
                            <!-- Cart Table -->
                            <div class="cart-table table-responsive mb--40">
                                <table class="table">
                                    <!-- Head Row -->
                                    <thead>
                                        <tr>
                                            <th class="pro-remove">#</th>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subtotal = 0;
                                            $shipping_cost = 0;
                                            $grandtotal = 0;
                                        @endphp
                                        @if (isset($products) && count($products) > 0)
                                            @foreach ($products as $product)
                                                <!-- Product Row -->
                                                @php
                                                    $cartQty = session()->has('cart_qty') ? array_get(session('cart_qty'), $product->id, 1) : 1;
                                                    $total = $cartQty * $product->sale_price;
                                                    $subtotal += $total;
                                                    $grandtotal += $total;
                                                @endphp
                                                <tr>
                                                    <td class="pro-remove">
                                                        <a href="#" data-id="{{ $product->id }}"
                                                            class="deleteToCart removeToCart"><i
                                                                class="far fa-trash-alt"></i></a>
                                                    </td>
                                                    <td class="pro-thumbnail">
                                                        <a href="#">
                                                            <img src="{{ isset($product->product_photo)? asset('storage/app/product/' . $product->product_photo): asset('public/front/image/products/product-2.jpg') }}"
                                                                alt="Product" height="60" width="60">
                                                        </a>
                                                    </td>
                                                    <td class="pro-title"><a
                                                            href="#">{{ $product->product_name }}</a>
                                                    </td>
                                                    <td class="pro-price"><span>₹{{ $product->sale_price }}</span>
                                                    </td>
                                                    <td class="pro-quantity">
                                                        <div class="pro-qty">
                                                            <div class="count-input-block">
                                                                <input type="hidden" name="price[]" id="price"
                                                                    value="{{ $product->sale_price }}">
                                                                <input type="number"
                                                                    class="form-control text-center cart_qty" min="1"
                                                                    max="100" name="cart_qty[]" value="{{ $cartQty }}">
                                                                <input type="hidden" name="p_id[]" id="p_id"
                                                                    value="{{ $product->id }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="pro-subtotal"><span
                                                            id="subTotal">₹{{ number_format($total, 0) }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr id="err_tab" class="d-none">
                                                <td class="pro-remove"></td>
                                                <td class="pro-tdumbnail"></td>
                                                <td class="pro-title"></td>
                                                <td class="pro-price"></td>
                                                <td class="pro-quantity"><span id="err_qty" class="text-danger"></span>
                                                </td>
                                                <td class="pro-subtotal"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="actions">
                                                    <div class="update-block text-right">
                                                        <button type="submit" class="btn btn-outlined" id="update_btn">
                                                            Update cart
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6" class="actions text-center">
                                                    <div class="update-block">
                                                        <h4>
                                                            Opps ! Seems Like You Don't Added Any Product Yet ...
                                                        </h4>
                                                        <a class="btn btn-outlined" href="{{ route('product') }}">
                                                            Shop Now
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endisset
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 mb--30 mb-lg--0">
                    <!-- slide Block 5 / Normal Slider -->
                </div>
                <!-- Cart Summary -->
                <div class="col-lg-6 col-12 d-flex">
                    <div class="cart-summary">
                        <div class="cart-summary-wrap">
                            <h4><span>Cart Summary</span></h4>
                            <p>Sub Total <span class="text-primary">₹{{ number_format($subtotal, 2) }}</span></p>
                            <p>Shipping Cost <span
                                    class="text-primary">₹{{ number_format($shipping_cost, 2) }}</span></p>
                            <h2>Grand Total <span class="text-primary">₹{{ number_format($grandtotal, 2) }}</span>
                            </h2>
                        </div>

                        @if(session()->has('my_cart') && count(session('my_cart')) > 0)
                        <div class="cart-summary-button">
                            <a href="checkout.html" class="checkout-btn c-btn btn--primary">Checkout</a>
                            {{-- <button class="update-btn c-btn btn-outlined">Update Cart</button> --}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Cart Page End -->
</div>
@section('script')
    <script>
        $('body').on('click', '.deleteToCart', function() {
            product_id = $(this).data('id');
            btn = $(this);
            $.ajax({
                url: '{{ route('removeToCart') }}',
                method: 'POST',
                datatype: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                    cart_product: 'cart_product',
                },
                success: function(res) {
                    $('body').find('main').html(res);
                },
            });
        });

        $('body').on('click', '#update_btn', function(e) {
            e.preventDefault();
            var cart_qty = [];
            var product_id = [];
            $('#form').find(':input[name="cart_qty[]"]').each(function() {
                cart_qty.push($(this).val());
            });
            $('#form').find(':input[name="p_id[]"]').each(function() {
                product_id.push($(this).val());
            });

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: 'post',
                datatype: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    cart_qty: cart_qty,
                    product_id: product_id,
                },
                success: function(res) {
                    $('body').find('main').html(res);
                }
            });
        });

        $(document).on('keyup', '.cart_qty', function() {
            let price = Number($(this).parent().find('#price').val());
            let qty = Number($(this).val());
            if (qty == 0) {
                qty = 1;
                $(this).val(1);
            }
            if (qty < 1000) {
                $('#err_tab').addClass('d-none');
                $('#update_btn').prop('disabled', false);
                $('#subTotal').text('₹' + Number(price * qty));
            } else {
                $('#err_tab').removeClass('d-none');
                $('#update_btn').prop('disabled', true);
                $('#err_qty').html('ENTER VALID <br> QUANTITY');
            }
        });
    </script>
@endsection
@endsection
