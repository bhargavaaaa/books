@extends('layouts.app')
{{-- @section('moduleName', "$moduleName Add") --}}
@section('content')

    <div class="row">
        <div class="col-12 col-lg order-1 order-lg-0">
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title">{{ $moduleName }} Update</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="{{ route('project.update') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf()
                        <div class="row g-3">
                            <input type="hidden" class="form-control" name="project_id" id="id"
                                value="{{ $project->id }}" />

                            <div class="col-md-5 mb-3 col-sm-12">
                                <label class="form-label">Project Name <span class="requride_cls">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ $project->name }}" />
                                @error('name')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-7 mb-3 col-sm-12">
                                <label for="technology">Technology <span class="requride_cls">*</span></label>
                                <td>
                                    <select class="select2_single select2 bs4 form-control" id="technology"
                                    name="technology[]" multiple>
                                    @foreach ($technologies as $technology)
<option value="{{ $technology->id }}" {{ in_array($technology->id, $projectTechnology) ? 'selected' : '' }}>
                                                {{ $technology->name }}</option>
                                    @endforeach
                                    </select>
                                </td>
                                @error('technology')
                                    <span class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @if (auth()->user()->haspermission('activeinactive.project'))
                        <div class="row g-3">
                            <div class="col-md-7 mb-3 col-sm-12">

                                <label for="status">
                                    Status <span class="requride_cls">*</span>
                                </label>
                                <div class="radio">
                                    <label><input type="radio" @if(old('status',$project->status) != ''){{ old('status', $project->status) == 0 ? 'checked' : '' }} @else checked @endif  name="status" value="0"> Opened</label>

                                    <label><input type="radio" @if(old('status',$project->status) != ''){{ old('status', $project->status) == 1 ? 'checked' : '' }} @endif  name="status" value="1"> Closed</label>

                                    <label><input type="radio" @if(old('status',$project->status) != ''){{ old('status', $project->status) == 2 ? 'checked' : '' }} @endif  name="status" value="2"> Reopened</label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="requride_cls"><strong>{{ $errors->first('status') }}</strong></span>
                                @endif
                                @error('status')
                                <span class="error">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        @endif

                        <center class="mt-4">

                            <button class="btn btn-icon btn-icon-end btn-primary m-1" type="submit">
                                Update
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

            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    'technology[]': {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Project Name Is Required.",
                    },
                    status: {
                        required: "Project Status Is Required.",
                    },
                    'technology[]': {
                        required: "Select Technology.",
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
