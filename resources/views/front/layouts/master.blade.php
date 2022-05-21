<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('front.layouts.partials.headerscript')
    @yield('css')

</head>

<body>
    <div class="site-wrapper" id="top">
        <div id="siteHeader">
            @include('front.layouts.partials.header')
        </div>

        @yield('content')

    </div>
    @include('front.layouts.partials.footer')
    @include('front.layouts.partials.footerscript')
    @yield('script')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $('body').on('click', '.add-wishlist', function() {
            product_id = $(this).data('id');
            btn = $(this);

            $.ajax({
                url: '{{ route('addWishlist') }}',
                method: 'POST',
                datatype: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function(res) {
                    if (res[0] == true) {
                        btn.attr('title', "Added To Wishlist");
                        btn.removeClass('add-wishlist').addClass('remove-wishlist').html(
                            '<i class="fas fa-heart"></i> ');
                    } else {

                    }
                },
            });
        });


        $('body').on('click', '.remove-wishlist', function() {
            product_id = $(this).data('id');
            btn = $(this);
            $.ajax({
                url: '{{ route('removeWishlist') }}',
                method: 'POST',
                datatype: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function(res) {
                    if (res[0] == true) {
                        btn.removeClass('remove-wishlist').addClass('add-wishlist').html(
                            '<i class="fas fa-heart"></i> Add To Wishlist');
                    } else {

                    }
                },
            });
        });

        $('body').on('click', '.addToCart', function() {
            product_id = $(this).data('id');
            btn = $(this);
            $.ajax({
                url: '{{ route('addToCart') }}',
                method: 'POST',
                datatype: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function(res) {
                    $('body').find('#siteHeader').html(res);
                    btn.attr('title', "Go To Cart");
                    btn.attr('href', "{{ route('cart') }}");
                    btn.removeClass('addToCart').html('<i class="fas fa-shopping-cart"></i> ');
                },
            });
        });

        $('body').on('click', '.removeToCart', function() {
            product_id = $(this).data('id');
            btn = $(this);
            $.ajax({
                url: '{{ route('removeToCart') }}',
                method: 'POST',
                datatype: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    product_id: product_id,
                },
                success: function(res) {
                    $('body').find('#siteHeader').html(res);
                },
            });
        });
    </script>
</body>

</html>
