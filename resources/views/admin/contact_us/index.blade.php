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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $moduleName ?? '' }} Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/. container-fluid -->
        </div>
    </div>
</section>
<!-- /.content -->

@endsection
@section('script')

<script>
     $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ route('contact_us.getContactUsData') }}",
            "dataType": "json",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'mobile'
            },
            {
                data: 'message'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ],
    });

</script>

@endsection
