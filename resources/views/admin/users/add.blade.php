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
                        <form action="{{ route('users.store') }}" id="user_form" method="post" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="name">
                                            Name <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="requride_cls"><strong>{{ $errors->first('name') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="email">
                                            Email <span class="requride_cls">*</span>
                                        </label>
                                        <input type="email" name="email" class="form-control input-sm" id="email" placeholder="Email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="requride_cls"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <label for="role"> Role <span class="requride_cls">*</span>
                                        </label>
                                        <select id="role" name="role_id" class="form-control select2bs4">
                                            <option value=""></option>
                                            @foreach($roles as $key => $role)
                                            <option value="{{ $role->id }}">{{ $role->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role'))
                                        <span class="requride_cls"><strong>{{ $errors->first('role') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                <div class="col-sm-4">
                                        <label for="password">
                                            Password <span class="requride_cls">*</span>
                                        </label>
                                        <input type="text" name="password"  class="form-control input-sm" id="password" placeholder="Password" value="{{ $password ?? old('password') }}" readonly>
                                        @if ($errors->has('password'))
                                        <span class="requride_cls"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <center>
                                    <a href=" {{ route('users.index') }}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-info">Submit</button>
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
    $('#user_form').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    type: "POST",
                    url: "{{ route('users.checkUserEmail') }}",
                    data: {
                        email: function() {
                            return $('#email').val();
                        }
                    },
                },
            },
            role_id: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Name is Required.",
            },
            email: {
                required: "Email is Required.",
                email: "Email format is Invalid.",
                remote: "Email already Exists."
            },
            role_id: {
                required: "Role is Required.",
            }
        },
        errorPlacement: function(error, element) {
            error.css('color', 'red').appendTo(element.parent("div"));
        },
    });
</script>
@endsection