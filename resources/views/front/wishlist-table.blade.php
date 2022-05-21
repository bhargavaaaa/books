@if (isset($products) && count($products) > 0)
    @foreach ($products as $product)
        @isset($product)
            <tr>
                <td class="pro-thumbnail">
                    <a href="{{ route('product_detail', encrypt($product->id)) }}">
                        <img src="{{ isset($product->product_photo)? asset('storage/app/product/' . $product->product_photo): asset('public/front/image/products/product-2.jpg') }}"
                            alt="Product" height="50" width="50">
                    </a>
                </td>
                <td class="pro-title"><a
                        href="{{ route('product_detail', encrypt($product->id)) }}">{{ $product->product_name ?? '' }}</a>
                </td>
                <td class="pro-price"><span>₹{{ $product->sale_price ?? 00 }}</span>
                </td>
                <td class="pro-price"><span>1</span></td>
                <td class="pro-subtotal">
                    <span>₹{{ ($product->sale_price ?? 00) * 1 }}</span>
                </td>
                <td class="pro-remove"><a href="javascript:void(0)" data-id="{{ $product->id }}"
                        class="delete-wishlist"><i class="far fa-trash-alt"></i></a></td>
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
