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
                                                aria-controls="custom-tabs-four-home" aria-selected="true">Request Registered</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-four-profile" role="tab"
                                                aria-controls="custom-tabs-four-profile" aria-selected="false">Request Accepted</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                                href="#custom-tabs-four-messages" role="tab"
                                                aria-controls="custom-tabs-four-messages"
                                                aria-selected="false">Request Rejected</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                                href="#custom-tabs-four-settings" role="tab"
                                                aria-controls="custom-tabs-four-settings"
                                                aria-selected="false">Return Taken</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="rejected-data-tab" data-toggle="pill"
                                                href="#rejected-data" role="tab" aria-controls="rejected-data"
                                                aria-selected="false">Return Accepted</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="returnrej-data-tab" data-toggle="pill"
                                                href="#returnrej-data" role="tab" aria-controls="returnrej-data"
                                                aria-selected="false">Return Rejected</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="cashback-given-tab" data-toggle="pill"
                                                href="#cashback-given" role="tab" aria-controls="cashback-given"
                                                aria-selected="false">Cashback Given</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="replacementgiven-data-tab" data-toggle="pill"
                                                href="#replacementgiven-data" role="tab" aria-controls="replacementgiven-data"
                                                aria-selected="false">Replacement Given</a>
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
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
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
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
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
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
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
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
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
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="returnrej-data" role="tabpanel"
                                            aria-labelledby="returnrej-data-tab">
                                            <table id="datatable_returnrej-data" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="cashback-given" role="tabpanel"
                                            aria-labelledby="cashback-given-tab">
                                            <table id="datatable_cashback-given" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="replacementgiven-data" role="tabpanel"
                                            aria-labelledby="replacementgiven-data-tab">
                                            <table id="datatable_replacementgiven-data" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sr. no.</th>
                                                        <th>Order no.</th>
                                                        <th>What want?</th>
                                                        <th>Problem</th>
                                                        <th>Status</th>
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
        $(document).ready(function() {
            var datatable1, datatable2, datatable3, datatable4, datatable5, datatable6, datatable7, datatable8, previous;
            datatable1 = $('#datatable_received').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getRequestRegisteredData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                autoWidth: false,
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable2 = $('#datatable_shipped').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getRequestAcceptedData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable3 = $('#datatable_delivered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getRequestRejectedData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable4 = $('#datatable_canceled').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getReturnTakenData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable5 = $('#datatable_rejected').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getReturnAcceptedData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable6 = $('#datatable_returnrej-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getReturnRejectedData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable7 = $('#datatable_cashback-given').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getCashbackGivenData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            datatable8 = $('#datatable_replacementgiven-data').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('return.orders.getReplacementGivenData') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                lengthMenu: [
                    [50, 100, 200, -1],
                    [50, 100, 200, "All"]
                ],
                autoWidth: false,
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'order_id'
                    },
                    {
                        data: 'need',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'problem',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });

            $(document).on('change', '.order_state', function() {
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
                            url: "{{ route('return.orders.state.change') }}",
                            type: "POST",
                            data: {
                                state: $th.val(),
                                id: $th.data('id')
                            },
                            dataType: "JSON",
                            success: function(response) {
                                if (response.status != true) {
                                    alert(
                                        "Something went wrong while updating order state, try again after reloading the page.");
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
                                datatable6.ajax.reload();
                                datatable7.ajax.reload();
                                datatable8.ajax.reload();
                            },
                            error: function() {
                                alert(
                                    "Something went wrong while updating order state, try again after reloading the page.");
                                datatable1.ajax.reload();
                                datatable2.ajax.reload();
                                datatable3.ajax.reload();
                                datatable4.ajax.reload();
                                datatable5.ajax.reload();
                                datatable6.ajax.reload();
                                datatable7.ajax.reload();
                                datatable8.ajax.reload();
                            }
                        });
                    } else {
                        datatable1.ajax.reload();
                        datatable2.ajax.reload();
                        datatable3.ajax.reload();
                        datatable4.ajax.reload();
                        datatable5.ajax.reload();
                        datatable6.ajax.reload();
                        datatable7.ajax.reload();
                        datatable8.ajax.reload();
                    }
                });
            });
        });
    </script>
@endsection
