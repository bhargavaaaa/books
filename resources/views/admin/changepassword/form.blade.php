@extends('admin.layouts.master')
@section('title')
{{$moduleName}}
@endsection
@section('content')

<!--
	Jinal Gajera
	17-04-20
 -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3>{{$moduleName}}</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}" ><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="breadcrumb-item active">{{$moduleName }}</li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Update Record</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>
    <div class="card-body">
		<form id="form" method="post" action ="{{ route('admin.updatepassword')}}" class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
		@csrf
			<div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<label for="old_password">Old Password<span class="requride_cls">*</span></label>
						<input type="password" name="old_password" class="form-control input-sm" id="old_password" placeholder="Enter Old Password" value="{{ old('old_password') }}">

						@if ($errors->has('old_password'))
							<span class="requride_cls"><strong>{{ $errors->first('old_password') }}</strong></span>
						@endif
                        @if ($message = Session::get('successmessage'))
                        <span class="requride_cls"><strong>{{ $message }}</strong></span>
                        @endif
					</div>
				</div>
			</div>

            <div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<label for="new_password">New Password<span class="requride_cls">*</span></label>
						<input type="password" name="new_password" class="form-control input-sm" id="new_password" placeholder="Enter New Password" value="{{ old('new_password') }}">
						@if ($errors->has('new_password'))
							<span class="requride_cls"><strong>{{ $errors->first('new_password') }}</strong></span>
						@endif
					</div>
				</div>
			</div>

            <div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<label for="confirm_password">Confirm Password<span class="requride_cls">*</span></label>
						<input type="password" name="confirm_password" class="form-control input-sm" id="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}">
						@if ($errors->has('confirm_password'))
							<span class="requride_cls"><strong>{{ $errors->first('confirm_password') }}</strong></span>
						@endif
					</div>
				</div>
			</div>
	    </div>
		<!-- /.card-body -->
		<div class="card-footer"><center>
			<a href=" {{ route('admin.home') }}" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-info">Submit</button>
		</div>
  </form>
  <!-- /.card-footer-->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->


@endsection
@section('script')
<script>

jQuery(document).ready(function() {

    $('#form').validate({
        rules:
        {
            old_password:{
                required:true,
                remote:{
                    type:'POST',
                    url:"{{ route('admin.checkoldpassword')}}",
                    data:{
                        old_password:function(){
                            return $("#old_password").val();
                        },
                    },
                },
            },
            new_password:{
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            },
        },
        messages:
        {
            old_password:{
                required:"Old Password Is Required",
                remote:"Old Password Is Wrong",
            },
            new_password:{
                required:"New Password Is Required",
                minlength:"Password Minimum 6 Characters"

            },
            confirm_password:{
                required:"Confirm Password Is Required",
                equalTo:"Password And Confirm Password Does Not Match",
            },
        },
        errorPlacement: function(error, element){
            if(element.is('select')) {
                error.insertAfter(element.next());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            $(':input[type="submit"]').prop('disabled', true);
            form.submit();
        }
    });
});
</script>
@endsection
