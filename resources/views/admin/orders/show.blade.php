@extends('admin.layouts.master')
@section('title')
    {{ $moduleName ?? '' }}
@endsection

@section('content')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code&family=Roboto+Slab&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/css/order_invoice.css') }}">

    </head>

    <body>
        <div class="container bootdey">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                    <div class="widget-box">
                        <h3 class="widget-title grey lighter" style="text-align: center">
                            Order Invoice
                        </h3>
                        <div class="widget-header widget-header-large">

                            <div class="widget-header widget-header-large">
                                <h3 class="widget-title grey lighter">
                                    <i class=" fa fa-book blue"></i>
                                    {{-- <img src="{{ asset('public/frontend/image/logo/Logo-Png.png') }}" width="200px" height="70px"
                                class="mt-3"> --}}
                                    <span>{{env('APP_NAME')}}</span>
                                </h3>

                                <div class="widget-toolbar no-border invoice-info">
                                    <h5 class="text-center">Customer </h5>
                                    <div class="invoice-info-label">Name :
                                        <span class="blue">{{ $order->user->name }}</span>
                                    </div>
                                    <div class="invoice-info-label">Email :
                                        <span class="blue">{{ $order->user->email }}</span>
                                    </div>
                                    <div class="invoice-info-label">Mobile :
                                        <span class="blue">{{ $order->shipping_phone }}</span>
                                    </div>
                                </div>

                                <div class="widget-toolbar no-border invoice-info">
                                    <h5 class="text-center">Order </h5>
                                    <div class="invoice-info-label">No :
                                        <span class="red">{{ $order->order_no }}</span>
                                    </div>
                                    <div class="invoice-info-label">Status :
                                        @if ($order->order_state == 0)
                                            <span class="blue">Received</span>
                                        @elseif($order->order_state == 1)
                                            <span class="blue">Shipped</span>
                                        @elseif($order->order_state == 2)
                                            <span class="blue">Delivered</span>
                                        @elseif($order->order_state == 3)
                                            <span class="blue">Cancelled</span>
                                        @elseif($order->order_state == 4)
                                            <span class="blue">Rejected</span>
                                        @endif
                                    </div>
                                    <div class="invoice-info-label">Date :
                                        <span
                                            class="blue">{{ date('d-m-Y H:i A', strtotime($order->created_at)) }}</span>
                                    </div>
                                </div>

                                {{-- <div class="widget-toolbar hidden-480">
                            <a href="#">
                                <i class=" fa fa-print"></i>
                            </a>
                        </div> --}}
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-24">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-xs-11 label label-lg label-info arrowed-in arrowed-right"
                                                    style="background-color: #3A87AD">
                                                    <b class="text-dark">Shipping Info</b>
                                                </div>
                                            </div>

                                            <div>
                                                <ul class="list-unstyled spaced">
                                                    <li>
                                                        <i class=" fa fa-caret-right blue"></i> Phone :
                                                        {{ $order->shipping_phone }}
                                                    </li>

                                                    <li>
                                                        <i class=" fa fa-caret-right blue"></i> Email :
                                                        {{ $order->shipping_email }}
                                                    </li>

                                                    <li>
                                                        <i class=" fa fa-caret-right blue"></i>Shipping Address : <br>
                                                        {{ $order->shipping_street }},{{ $order->shipping_street2 }},
                                                        {{ $order->shipping_city }}-{{ $order->shipping_zipcode }},
                                                        {{ $order->shipping_state }} , {{ $order->shipping_country }}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div><!-- /.col -->

                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"
                                                    style="background-color: #82AF6F">
                                                    <b class="text-dark">Billing Info</b>
                                                </div>
                                            </div>

                                            <div>
                                                <ul class="list-unstyled  spaced">
                                                    <li>
                                                        <i class=" fa fa-caret-right green"></i> Phone :
                                                        {{ $order->billing_phone }}
                                                    </li>

                                                    <li>
                                                        <i class=" fa fa-caret-right green"></i> Email :
                                                        {{ $order->billing_email }}
                                                    </li>

                                                    <li>
                                                        <i class=" fa fa-caret-right green"></i>Billing Address : <br>
                                                        {{ $order->billing_street }},{{ $order->billing_street2 }},
                                                        {{ $order->billing_city }}-{{ $order->billing_zipcode }},
                                                        {{ $order->billing_state }} , {{ $order->billing_country }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->

                                    <div class="space"></div>

                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="center">Order</th>
                                                    {{-- <th>Product Image</th> --}}
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Product Qty</th>
                                                    <th class="text-right">Price</th>
                                                    {{-- <th class="hidden-xs">Description</th>
                                            <th class="hidden-480">Discount</th>
                                            <th>Total</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=1; @endphp
                                                @foreach ($products as $key => $value)
                                                    <tr>
                                                        <td class="center">{{ $i++ }}</td>
                                                        {{-- <td>
                                                        <div class="product-img">
                                                            <img src="{{ url('/public/attachment/product/thumb') }}/{{ isset($orderdetail->product->thumbnail) ? $orderdetail->product->thumbnail : '' }}"
                                                                class="img-fluid" style="width: 100px;height: 100px"
                                                                alt="not found">
                                                        </div>
                                                    </td> --}}
                                                        <td>
                                                            <div class="product-name">
                                                                <p>{{ $value }}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-name">
                                                                <p>{{ json_decode($order->order_item_prices)[$key] }}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="product-name">
                                                                <p>{{ json_decode($order->order_item_quantities)[$key] }}
                                                                </p>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <p><span>Rs 
                                                                    {{ json_decode($order->order_item_quantities)[$key] * json_decode($order->order_item_prices)[$key] }}</span>
                                                            </p>
                                                        </td>
                                                        {{-- <td class="hidden-xs">
                                                1 year domain registration
                                            </td>
                                            <td class="hidden-480"> --- </td>
                                            <td>$10</td> --}}
                                                    </tr>
                                                @endforeach
                                                @php $i=1; @endphp

                                                <tr class="text-right">
                                                    <td colspan="4">Discount</td>
                                                    <td>RS {{ number_format($order->discount ?? 00, 2) }}</td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td colspan="4">Shipping Fee</td>
                                                    <td>RS {{ number_format($order->shipping_fee ?? 00, 2) }}</td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td colspan="4">Total</td>
                                                    <td>RS
                                                        {{ number_format($order->main_total ?? 0.0, 2) }}
                                                    </td>
                                                </tr>
                                                <tr class="text-right">
                                                    <td colspan="4">Final Total</td>
                                                    <td>RS
                                                        {{ number_format(($order->main_total + $order->shipping_fee)?? 0.0, 2) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="hr hr8 hr-double hr-dotted"></div>

                                    <div class="row">
                                        <div class="col-sm-9 pull-right">
                                            <i>Comments / Notes</i>
                                            <hr style="margin:3px 0 5px" /> -
                                        </div>
                                        <div class="col-sm-3 pull-left">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Payment Method</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <ol>
                                                        <li>{{ $order->payment_method }}</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
@endsection
@section('script')
    <script>

    </script>
@endsection
