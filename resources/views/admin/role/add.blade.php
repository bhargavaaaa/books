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
                <h1 class="m-0">Add {{ $moduleName ?? '' }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">{{ $moduleName ?? '' }}</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                        <h3 class="card-title">Create New {{ $moduleName ?? '' }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" id="role_form" method="post" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="name">
                                            Role Name <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="description">
                                            Description <span class="requride_cls">*</span>
                                        </label>
                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description" style="resize:none;" rows="2">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="requride_cls"><strong>{{ $errors->first('description') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Permissions :</label>
                                <div class="col-lg-12 card bg-light">
                                    @php $cnt = 1;$cn = 1; @endphp
                                    @foreach($permissions as $key => $permission)
                                    @if($cnt%3 == 1)
                                    <div class="row">
                                        @endif
                                        <div class="col-lg-4 card-dark permissions-list">
                                            <div class="mt-3 card-header">
                                                <h5 class="card-title">{{ $key ?? '' }}</h5>
                                                <div class="card-tools">
                                                    <a class="btn btn-tool selectDeselect" value="select">Select All</a>
                                                    <a class="btn btn-tool selectDeselect" value="deselect">Deselect All</a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @foreach($permission as $key=>$val)
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input permission" name="permission[]" type="checkbox" id="customCheckbox{{$cn}}" value="{{ $val->id }}">
                                                    <label for="customCheckbox{{$cn}}" class="custom-control-label">{{ $val->name }}</label>
                                                </div>
                                                @php $cn++; @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                        @if($cnt%3 == 0)
                                    </div>
                                    <hr class="form-part">
                                    @endif
                                    @php $cnt++; @endphp

                                    @endforeach
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <center>
                            <a href=" {{ route('role.index') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $('body').on('click', '.selectDeselect', function(e) {
        var selectVal = $(this).attr('value');
        if (selectVal == 'select') {
            $(this).closest('.permissions-list').find(".card-body .permission").prop("checked", true);
        } else {
            $(this).closest('.permissions-list').find(".card-body .permission").prop("checked", false);
        }
    });

    $("#role_form").validate({
        rules: {
            name: {
                required: true,
                remote: {
                    type: 'POST',
                    url: "{{route('role.checkRoleName')}}",
                    data: {
                        name: function() {
                            return $("#name").val();
                        },
                    },
                },
            },
            description: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Role Name Is Required.",
                remote: "Role Already Exist."
            },
            description: {
                required: "Description is required.",
            },
        },
        errorPlacement: function(error, element) {
            error.css('color', 'red').appendTo(element.parent("div"));
        },
    });
</script>
@endsection