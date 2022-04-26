@extends('admin.layouts.master')
@section('title')
    {{ $moduleName ?? '' }}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $moduleName ?? '' }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $moduleName ?? '' }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $moduleName ?? '' }} Details</h3>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                                href="#custom-tabs-four-home" role="tab"
                                                aria-controls="custom-tabs-four-home" aria-selected="true">Received</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-four-profile" role="tab"
                                                aria-controls="custom-tabs-four-profile" aria-selected="false">Shipped</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                                href="#custom-tabs-four-messages" role="tab"
                                                aria-controls="custom-tabs-four-messages"
                                                aria-selected="false">Delivered</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                                href="#custom-tabs-four-settings" role="tab"
                                                aria-controls="custom-tabs-four-settings"
                                                aria-selected="false">Cancelled</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="rejected-data-tab" data-toggle="pill"
                                                href="#rejected-data" role="tab" aria-controls="rejected-data"
                                                aria-selected="false">Rejected</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-home-tab">
                                            <table id="datatable_received" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-profile-tab">
                                            <table id="datatable_shipped" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-messages-tab">
                                            <table id="datatable_delivered" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                            aria-labelledby="custom-tabs-four-settings-tab">
                                            <table id="datatable_canceled" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="rejected-data" role="tabpanel"
                                            aria-labelledby="rejected-data-tab">
                                            <table id="datatable_rejected" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>Order Items</th>
                                                        <th>Total Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Payment Method</th>
                                                        <th>Order State</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/. container-fluid -->
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var datatable1, datatable2, datatable3, datatable4, datatable5, previous;
            datatable1 = $('#datatable_received').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('orders.getReceivedOrdersData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                autoWidth: false,
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                order: [
                    [7, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_no'
                    },
                    {
                        data: 'order_item_ids',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_item_quantities',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'main_total'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'order_state',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            datatable2 = $('#datatable_shipped').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('orders.getShippedOrdersData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                order: [
                    [7, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_no'
                    },
                    {
                        data: 'order_item_ids',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_item_quantities',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'main_total'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'order_state',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            datatable3 = $('#datatable_delivered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('orders.getDeliveredOrdersData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                order: [
                    [7, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_no'
                    },
                    {
                        data: 'order_item_ids',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_item_quantities',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'main_total'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'order_state',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            datatable4 = $('#datatable_canceled').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('orders.getCancelledOrdersData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                order: [
                    [7, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_no'
                    },
                    {
                        data: 'order_item_ids',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_item_quantities',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'main_total'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'order_state',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            datatable5 = $('#datatable_rejected').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('orders.getRejectedOrdersData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                order: [
                    [7, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_no'
                    },
                    {
                        data: 'order_item_ids',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_item_quantities',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'main_total'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'order_state',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $(document).on('change', '.order_state', function () {
                var $th = $(this);
                Swal.fire({
                    title: 'Are you sure want to change order state?',
                    text: "As that can not be undone it's state.",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ route('orders.state.change') }}",
                            type: "POST",
                            data: {
                                state: $th.val(),
                                id: $th.data('id')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status != true){
                                    alert("Something went wrong while updating order state, try again after reloading the page.");
                                } else {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: "Order state has been changed.",
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Okay'
                                    });
                                }
                                datatable1.ajax.reload();
                                datatable2.ajax.reload();
                                datatable3.ajax.reload();
                                datatable4.ajax.reload();
                                datatable5.ajax.reload();
                            },
                            error: function() {
                                alert("Something went wrong while updating order state, try again after reloading the page.");
                                datatable1.ajax.reload();
                                datatable2.ajax.reload();
                                datatable3.ajax.reload();
                                datatable4.ajax.reload();
                                datatable5.ajax.reload();
                            }
                        });
                    } else {
                        datatable1.ajax.reload();
                        datatable2.ajax.reload();
                        datatable3.ajax.reload();
                        datatable4.ajax.reload();
                        datatable5.ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
