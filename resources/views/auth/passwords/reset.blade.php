@extends('layouts.app')

@section('title')
    Reset Password
@endsection
@section('content')

<style>
    body
     {
        /* background-image: linear-gradient(rgba(255,255,255,.1), rgba(255,255,255,.1)), url(/assets/background.jpg) !important;
         background-position: center !important;
         background-repeat: no-repeat !important;
         background-size: cover !important;*/

         background-color: #373330 !important;

     }
 </style>


    <div class="card-body">
        <p class="login-box-msg">Reset your password</p>
        @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
        @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                         @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="row">
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                            </div>
                            <!-- /.col -->
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
