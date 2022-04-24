@extends('admin.layouts.master')
@section('title')
{{ $moduleName ?? '' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-12 col-lg order-1 order-lg-0">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">{{ $moduleName }} Create</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="{{ route('publication.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf()
                        <div class="row g-3">
                            <div class="col-md-5 mb-3 col-sm-12">
                                <label class="form-label">Name <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-7 mb-3 col-sm-12">
                                <label for="board">board </label>
                                <td>
                                    <select class="select2 select2bs4 form-control" id="board"
                                        name="board[]" multiple>
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
                            <div class="col-md-5 mb-3 col-sm-12">
                                <label for="board">Image </label>
                                <input type="file" class="form-control" name="image" id="image" placeholder="Image" value="{{ old('image') }}" />
                                @error('board')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3 col-sm-12">
                                <label for="description">Description <span class="requride_cls">*</span></label>
                                <textarea class="ckeditor form-control description" name="description"
                                    id="description"></textarea>

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
                            <a href="{{ url()->previous() }}" class="btn btn-default m-1" onclick="history.back()">Cancel</a>
                        </center>
                </div>
            </div>

            </form>
        </div>
    </div>
    </div>


@endsection

@section('script')
    <script>
        jQuery(document).ready(function() {

            $("#form").submit(function(e) {
            var totalcontentlength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
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
