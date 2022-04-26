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
                            <a href="{{ route('category.create') }}"><button class="btn btn-primary" style="float:right;"><i class="fa fa-plus"></i> New</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Boards</th>
                                    <th>Publications</th>
                                    <th>School</th>
                                    <th>Category Name</th>
                                    <th>Category Description</th>
                                    <th>Category Image</th>
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
            "url": "{{ route('category.getCategoryData') }}",
            "dataType": "json",
            "type": "GET",
        },
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'board_id',
                orderable: false,
                searchable: false
            },
            {
                data: 'publication_id',
                orderable: false,
                searchable: false
            },
            {
                data: 'school_id',
                orderable: false,
                searchable: false
            },
            {
                data: 'category_name'
            },
            {
                data: 'category_description'
            },
            {
                data: 'category_image'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ],
    });

    $(document).on('click', '#activate', function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        console.log(linkURL);
        Swal.fire({
            title: 'Are you sure want to Activate?',
            text: "As that can be undone by doing reverse.",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                window.location.href = linkURL;
            }
        });
    });

    $(document).on('click', '#deactivate', function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        console.log(linkURL);
        Swal.fire({
            title: 'Are you sure want to De-Activate?',
            text: "As that can be undone by doing reverse.",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                window.location.href = linkURL;
            }
        });
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var linkURL = $(this).attr("href");
        console.log(linkURL);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = linkURL;
            }
        });
    });


</script>

@endsection
