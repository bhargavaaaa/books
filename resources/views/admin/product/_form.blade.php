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
                            <form action="{{ route('product.update', encrypt($product->id)) }}" method="POST"
                                enctype="multipart/form-data" id="form">
                                @csrf()
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label class="form-label">Name <span class="requride_cls">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                            value="{{ old('name', $product->product_name) }}" />
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
                                            <select class="select2 select2bs4 form-control" id="publication"
                                                name="publication[]" multiple>
                                                @foreach ($publications as $publication)
                                                    <option value="{{ $publication->id }}"
                                                        @if (in_array($publication->id, $publication_ids)) selected @else null @endif>
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
                                        <label for="school">school </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="school" name="school[]"
                                                multiple>
                                                @foreach ($schools as $school)
                                                    <option value="{{ $school->id }}"
                                                        @if (in_array($school->id, $school_ids)) selected @else null @endif>
                                                        {{ $school->school_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('school')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="school">Standard </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="standard" name="standard[]"
                                                multiple>
                                                @foreach ($standards as $standard)
                                                    <option value="{{ $standard->id }}"
                                                        @if (in_array($standard->id, $standard_ids)) selected @else null @endif>
                                                        {{ $standard->standard_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('standard')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="category">category </label>
                                        <td>
                                            <select class="select2 select2bs4 form-control" id="category" name="category[]"
                                                multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (in_array($category->id, $category_ids)) selected @else null @endif>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        @error('category')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="board">Image </label>
                                        <div>
                                            <input type="file" class="file-input" name="image" id="image"
                                                placeholder="Image" accept="image/png, image/jpg, image/jpeg" />
                                            <input type="hidden" class="file-input" name="old_image" id="old_image"
                                                value="{{ $product->product_photo }}" />
                                            @error('image')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label class="form-label">Cutout Price </label>
                                        <input type="number" class="form-control" name="cutout_price" id="cutout_price"
                                            placeholder="cutout price"
                                            value="{{ old('cutout_price', $product->cutout_price) }}" />
                                        @error('cutout_price')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label class="form-label">Sale Price <span
                                                class="requride_cls">*</span></label>
                                        <input type="number" class="form-control" name="sale_price" id="sale_price"
                                            placeholder="sale price"
                                            value="{{ old('sale_price', $product->sale_price) }}" />
                                        @error('sale_price')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6  mb-3 col-sm-12">
                                        <label for="status">
                                            Status <span class="requride_cls">*</span>
                                        </label>
                                        <div class="radio">
                                            <label for="active"><input type="radio" name="is_active" id="active" value="1"
                                                    {{ $product->is_active == 1 ? 'checked' : '' }}>Active</label>
                                            <label for="inactive"><input type="radio" name="is_active" id="inactive"
                                                    value="0" {{ $product->is_active == 0 ? 'checked' : '' }}>In
                                                Active</label>
                                        </div>
                                        @if ($errors->has('is_active'))
                                            <span
                                                class="requride_cls"><strong>{{ $errors->first('is_active') }}</strong></span>
                                        @endif
                                    </div>


                                    @if (isset($product->product_photo))
                                        <div class="col-md-2 mb-3 col-sm-12">
                                            <label for="board">Old Image </label>
                                            <div>
                                                <img src="{{ url('storage/app/prodcut/' . $product->product_photo) }}"
                                                    id="imgView" alt="Image Not load" height="100" width="100">
                                                <br>
                                                <a href="#" onclick="return removeImg()" id="removeImg">Remove Image</a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-12 mb-3 col-sm-12">
                                        <label for="description">Description</label>
                                        <textarea class="ckeditor form-control description" name="description"
                                            id="description">{!! $product->product_desc !!}</textarea>

                                        <span id='ckdescription' class="error"></span>
                                        @error('description')
                                            <span class="error">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-12 mb-3 col-sm-12">
                                        <table class='table table-bordered'>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Attribute Name</th>
                                                <th>Attribute Value</th>
                                                <th></th>
                                            </tr>

                                            @foreach ($attr as $key => $value)
                                                @php  $cnt = 1; @endphp
                                                <tr class="producttable">
                                                    <td><label class="sr_no">{{ $cnt++ }} </label></td>
                                                    <td>
                                                        <input type="text" name="attribute_name[]"
                                                            class="form-control input-sm attribute_name" id="attribute_name"
                                                            placeholder="Enter Enter Attribute Name"
                                                            value="{{ $key }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="attribute_value[]"
                                                            class="form-control input-sm attribute_value"
                                                            id="attribute_value" placeholder="Enter Attribute value"
                                                            value="{{ $value }}">
                                                    </td>
                                                    <td>
                                                        <button tabindex="1" type="button"
                                                            class="btn btn-success add btn-sm " onclick="">+</button>
                                                        <button tabindex="1" type="button"
                                                            class="btn btn-danger minus btn-sm">-</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>

                                    <div class="col-md-6 mb-3 col-sm-12">
                                        <label for="can_return">
                                            Can Return  <span class="requride_cls">*</span>
                                        </label>
                                        <div class="radio">
                                            <label for="can_not_return"><input type="radio" name="can_return" id="can_not_return" value="0" {{ ($product->can_return == 0) ? 'checked' : ''}}>Can Not Return</label>
                                            <label for="can_return"><input type="radio" name="can_return" id="can_return" value="1" {{ ($product->can_return == 1) ? 'checked' : ''}}>Can Return</label>
                                        </div>
                                        @if ($errors->has('can_return'))
                                            <span class="requride_cls"><strong>{{ $errors->first('can_return') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 col-sm-12 @if ($product->can_return == 0) d-none @endif" id="give_needed" >
                                    <label for="give_needed_item">
                                        Give Needed Item   <span class="requride_cls">*</span>
                                    </label>
                                    <div class="form-check-input">
                                        <input type="checkbox" class="checkbox" id="replacement" name="give_needed_item[]" value="1" @if ($product->give_needed_item == 1 || $product->give_needed_item == 3) checked @endif>
                                        <label class="form-check-label" for="replacement">Replacement</label>
                                        <input type="checkbox" class="checkbox" id="cashback" name="give_needed_item[]" value="2" @if ($product->give_needed_item == 2 || $product->give_needed_item == 3) checked @endif>
                                        <label class="form-check-label" for="cashback">Cashback</label>
                                    </div>
                                        <span class="requride_cls"><strong id="checkValid"></strong></span>
                                    @if ($errors->has('give_needed_item'))
                                        <span class="requride_cls"><strong>{{ $errors->first('give_needed_item') }}</strong></span>
                                    @endif
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
        function sr_change() {
            var count = $('.producttable').length;
            for (var i = 0; i < count; i++) {
                var cnt = i + 1;
                $("label.sr_no").eq(i).text(cnt);
            }
        }

        $('body').on('click', ".add", function() {
            var $tr = $(this).closest('.producttable');
            var $clone = $tr.clone();

            $clone.find(".unit_id").select2({
                placeholder: "Select ",
                allowClear: true,
                width: '100%'
            });

            $clone.find('input').val('');
            $clone.find('span:nth-child(3)').remove();
            $clone.find('select').val('').trigger('change');

            $tr.after($clone);
            sr_change();
        });

        $('body').on('click', '.minus', function(event) {
            if ($(".producttable").length > 1) {
                $(this).closest(".producttable").remove();
                sr_change();
            }
        });

        function removeImg(e) {
            $('#imgView').attr('src', '').hide(100);
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

            $('input:radio[name="can_return"]').on('change', function(){
                val = $(this).val();
                if($("#can_return").is(":checked")){
                    $("#give_needed").removeClass('d-none');
                } else {
                    $('.checkbox').prop('checked', false);
                    $("#give_needed").addClass('d-none');
                }
            });

           $('body').on('click',':input[type="submit"]',function(){
                $("#form").valid();
                if($("#can_return").is(":checked")){
                    if($('.checkbox:checkbox:checked').length < 1) {
                        $('#checkValid').text('Select Atleast One');
                        return false;
                    }else{
                        $('#checkValid').text('');
                        return true;
                    }
                }else {
                    $('#checkValid').text('');
                    return true;
                }
            });
        });
    </script>
@endsection
