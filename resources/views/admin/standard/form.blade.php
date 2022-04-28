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
                <div class="col-12 col-lg order-1 order-lg-0">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title">{{ $moduleName }} Create</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="{{ route('standard.store') }}" method="POST" enctype="multipart/form-data"
                                id="form">
                                @csrf()
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label class="form-label">Standard <span class="requride_cls">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="board">Board </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="board" name="board[]"
                                                multiple>
                                                @foreach ($boards as $board)
                                                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('board')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="publication">Publication </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="publication"
                                                name="publication[]" multiple>
                                                @foreach ($publications as $publication)
                                                    <option value="{{ $publication->id }}">
                                                        {{ $publication->publication_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('publication')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="school">School </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="school" name="school[]"
                                                multiple>
                                                @foreach ($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->school_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('school')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12 mb-3 col-sm-12">
                                            <label for="description">Description </label>
                                            <textarea class="ckeditor form-control description" name="description" id="description"></textarea>

                                            <span id='ckdescription' class="error"></span>
                                            @error('description')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <center>
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <a href=" {{ route('standard.index') }}" class="btn btn-default">Cancel</a>
                                    </center>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("#form").submit(function(e) {
                var totalcontentlength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi,
                    '').length;
                if (totalcontentlength != 0) {
                    if (totalcontentlength < 10) {
                        e.preventDefault();
                        $("#ckdescription").html('<b>Please Enter Minimum 10 Character</b>');
                    } else {
                        $("#ckdescription").html('');

                    }
                } else {
                    $("#ckdescription").html('');
                }
            });

            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Standard Is Required.",
                    },
                },
                errorPlacement: function(error, element) {
                    error.css('color', 'red').appendTo(element.parent("div"));
                },
                submitHandler: function(form) {
                    form.submit();
                    $(':input[type="submit"]').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
