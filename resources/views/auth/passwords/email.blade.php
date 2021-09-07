<!DOCTYPE html>
<html lang="en">
@include('includes.head')
@section('title','Login') 
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/2.jpg') }}" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
                <div>
                    <a class="logo text-start" href="">
                        <img class="img-fluid for-light center" src="{{ asset('assets/images/logo/logo.png') }}" alt="looginpage" style="height:90px;">
                    </a>
                </div>
                <div class="login-main">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif 
                    <form class="theme-form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h4>Reset Password</h4>
                        <p>Enter your email</p>
                        <div class="form-group">
                            <label class="col-form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="user@gmail.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                        </div>
                        <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Send Password Reset Link') }}</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      @include('includes.foot')
    </div>
  </body>
</html>