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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $moduleName }} Details</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        @permission('create.products')
                            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i>
                                New</a>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="card-body  table-responsive">
                <table class="datatable  table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">Sr No.</th>
                            <th>Boards</th>
                            <th>Publications</th>
                            <th>School Name</th>
                            <th>School Description</th>
                            <th>School Photo</th>
                            <th>Status</th>
                            @if (auth()->user()->hasPermission(['edit.products', 'activeinactive.products', 'destroy.products']))
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $srno = 0  }}
                        @foreach ($projects as $project)
                        <tr>
                            <th width="10%">{{ $srno }}</th>
                            <th>{{ $project->name }}</th>
                            <th>{{ $project->name }}</th>
                            <th width="8%">{{ $project->name }}</th>
                            @if (auth()->user()->hasPermission(['edit.project', 'activeinactive.project', 'destroy.project']))
                            <th>Action</th>
                            @endif
                        </tr>
                        $sro++;
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>

            <!-- /.card-footer-->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection





@section('script')
    <script>
        $(document).ready(function() {

            @if (Session::has('message'))
                Swal.fire(
                '{{ $moduleName }}',
                '{!! session('message') !!}',
                'success'
                )
            @endif

            @if (Session::has('failmessage'))
                Swal.fire(
                '{{ $moduleName }}',
                '{!! session('failmessage') !!}',
                'error'
                )
            @endif


            $('body').on('click', '.delete', function(e) {
                let delId = $(this).data('id');
                if (delId != '') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('school.delete') }}",
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

            var datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    "url": "{{ route('product.getData') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data": {
                        is_active: function() {
                            return $("#is_active").val();
                        },
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'board_id'
                    },
                    {
                        data: 'publication_id'
                    },
                    {
                        data: 'school_name'
                    },
                    {
                        data: 'school_desc'
                    },
                    {
                        data: 'school_photo'
                    },
                    {
                        data: 'is_active'
                    },
                    @if (auth()->user()->hasPermission(['edit.products', 'activeinactive.products', 'destroy.products']))
                        { data: 'action',orderable:false,searchable:false},
                    @endif
                ],
            });

        });
    </script>
@endsection
