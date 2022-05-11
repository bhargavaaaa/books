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
                <h1 class="m-0">View {{ $moduleName ?? '' }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('board.index') }}">{{ $moduleName ?? '' }}</a></li>
                    <li class="breadcrumb-item active">View</li>
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
                        <h3 class="card-title">View {{ $moduleName ?? '' }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="#" id="board_form" method="post" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="board_name">
                                            Image Name <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Image Name" value="{{ old('board_name', $banner->name) }}" disabled>
                                        @if ($errors->has('name'))
                                            <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="image">
                                            Image <span class="requride_cls">*</span>
                                        </label>
                                        {{-- <input type="file" name="image" class="form-control input-sm" id="image" placeholder="Image" value="{{ old('image') }}" accept="image/*">
                                        @if ($errors->has('image'))
                                            <span class="requride_cls"><strong>{{ $errors->first('image') }}</strong></span>
                                        @endif --}}
                                        <div>
                                            <img src="{{ asset('storage/app/banner/'.$banner->image) }}" alt="" height="500">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <center>
                                    {{-- <button type="submit" class="btn btn-info">Submit</button> --}}
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

@endsection
