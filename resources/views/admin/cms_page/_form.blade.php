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
                <h1 class="m-0">Edit {{ $moduleName ?? '' }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cms_page.index') }}">{{ $moduleName ?? '' }}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Edit New {{ $moduleName ?? '' }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('cms_page.update', encrypt($cmsPage->id)) }}" id="form" method="post" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="name">
                                            CMS Name <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="CMS Name" value="{{ old('name', $cmsPage->name ) }}">
                                        @if ($errors->has('name'))
                                            <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="description">
                                            Description <span class="requride_cls"></span>
                                        </label>
                                        <textarea name="description" class="form-control input-sm ckeditor" id="description">{{ $cmsPage->description }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="requride_cls"><strong>{{ $errors->first('description') }}</strong></span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <center>
                                    <a href=" {{ route('cms_page.index') }}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-info">Submit</button>
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
        $("#form").validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "CMS Page Name Is Required.",
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
