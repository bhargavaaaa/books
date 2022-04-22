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
                        <div class="card-tools">
                            @if (auth()->user()->hasPermission('create.roles'))
                            <a href="{{ route('role.create') }}"><button class="btn btn-primary" style="float:right;"><i class="fa fa-plus"></i> New</button></a>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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
            "url": "{{ route('role.getRoleData') }}",
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
                data: 'description'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ],
    });

    $('body').on('click', '.delete', function(e) {
        let delId = $(this).data('id');
        if (delId != '') {
            Swal.fire({
                title: 'Are you sure, you want to delete this Role?',
                text: "Because this will delete all the associated Users with Role.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('role.delete') }}",
                        type: "POST",
                        data: {
                            id: delId
                        },
                        success: function(response) {
                            if (response) {
                                 location.reload();

                            }
                        },
                    });

                }
            });
        }

    });
</script>
@endsection