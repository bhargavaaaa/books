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
                            <h3 class="card-title">{{ $moduleName }} Edit</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="{{ route('category.update', encrypt($category->id)) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf()
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label class="form-label">Name <span class="requride_cls">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                            value="{{ old('name', $category->category_name) }}" />
                                        @error('name')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="board">Board </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="board" name="board[]" multiple>
                                                @foreach ($boards as $board)
                                                    <option value="{{ $board->id }}"
                                                        @if (in_array($board->id, $board_ids)) selected @else null @endif>
                                                        {{ $board->name }}</option>
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
                                        <label for="publication">Publication</label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="publication" name="publication[]"
                                                multiple>
                                                @foreach ($publications as $publication)
                                                    <option value="{{ $publication->id }}"
                                                        @if (in_array($publication->id, $publication_ids)) selected @else null @endif>{{ $publication->publication_name }}</option>
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
                                        <label for="publication">School</label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="school" name="school[]"
                                                multiple>
                                                @foreach ($schools as $school)
                                                    <option value="{{ $school->id }}"
                                                        @if (in_array($school->id, $school_ids)) selected @else null @endif>{{ $school->school_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('school')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3 col-sm-12">
                                        <label for="board">Image </label>
                                        <div>
                                            <input type="file" class="file-input" name="image" id="image"
                                                placeholder="Image" accept="image/png, image/jpg, image/jpeg" />
                                            <input type="hidden" class="file-input" name="old_image" id="old_image"
                                                value="{{ $category->category_image }}" />
                                            @error('image')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if (isset($category->category_image))
                                        <div class="col-md-2 mb-3 col-sm-12">
                                            <label for="board">Old Image </label>
                                            <div>
                                                <img src="{{ url('storage/app/category/' . $category->category_image) }}"
                                                    id="imgView" alt="Image Not load" height="100" width="100">
                                                <br>
                                                <a href="#" onclick="return removeImg()" id="removeImg">Remove Image</a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-12 mb-3 col-sm-12">
                                        <label for="description">Description</label>
                                        <textarea class="ckeditor form-control description" name="description"
                                            id="description">{!! $category->category_id !!}</textarea>

                                        <span id='ckdescription' class="error"></span>
                                        @error('description')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <center class="mt-4">
                                    <button class="btn btn-icon btn-icon-end btn-primary m-1" type="submit" id="submit">
                                        Submit
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-default m-1"
                                        onclick="history.back()">Cancel</a>
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
            function removeImg(e) {
                $('#imgView').attr('src','').hide(100);
                $('#old_image').val('');
                $('#removeImg').hide(100);
            }
        jQuery(document).ready(function() {

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
                    // 'board[]': {
                    //     required: true,
                    // },
                },
                messages: {
                    name: {
                        required: "Name Is Required.",
                    },
                    // 'board[]': {
                    //     required: "Select board.",
                    // },
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
