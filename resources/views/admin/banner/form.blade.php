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
                    <li class="breadcrumb-item"><a href="{{ route('board.index') }}">{{ $moduleName ?? '' }}</a></li>
                    <li class="breadcrumb-item active">Add</li>
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
                        <h3 class="card-title">Create New {{ $moduleName ?? '' }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('banner.store') }}" id="board_form" method="post" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="board_name">
                                            Image Name <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Image Name" value="{{ old('board_name') }}">
                                        @if ($errors->has('name'))
                                            <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="image">
                                            Image <span class="requride_cls">*</span>
                                        </label>
                                        <input type="file" name="image" class="form-control input-sm" id="image" placeholder="Image" value="{{ old('image') }}" accept="image/*">
                                        @if ($errors->has('image'))
                                            <span class="requride_cls"><strong>{{ $errors->first('image') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="status">
                                            Status <span class="requride_cls">*</span>
                                        </label>
                                        <div class="radio">
                                            <label for="active"><input type="radio" name="is_active" id="active" value="1" checked>Active</label>
                                            <label for="inactive"><input type="radio" name="is_active" id="inactive" value="0">In Active</label>
                                        </div>
                                        @if ($errors->has('is_active'))
                                            <span class="requride_cls"><strong>{{ $errors->first('is_active') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <center>
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <a href=" {{ route('banner.index') }}" class="btn btn-default">Cancel</a>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')

<script>
    $(document).ready(function(){
        $("#board_form").validate({
            rules: {
                name: {
                    required: true,
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png",
                },
                is_active: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Image Name Is Required.",
                },
                image: {
                    required: "Image Required.",
                    extension: "Please upload file in these format only (jpg, jpeg, png).",
                },
            },
            submitHandler: function(form) {
                $(':input[type="submit"]').prop('disabled', true);
                form.submit();
            }
        });
    });
</script>

@endsection
