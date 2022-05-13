<!DOCTYPE html>
<html lang="en">
@include('includes.head')
@section('title','Login') 
  <body>
    <style>
      .login-card {
    background: #322d70;
    padding: 30px 12px;
    }
    </style>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7">
            <img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/2.jpg') }}">
        </div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <div class="login-main">
                <div class="p-b-15">
                  <img class="img-fluid for-light center" src="{{ asset('assets/images/logo/logo.png') }}" alt="looginpage" style="height:90px;">
              </div> 
                <form class="theme-form" method="POST" action="{{ route('login') }}">
                    @csrf
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="user@gmail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">{{ __('Password') }}</label>
                    <div class="form-input position-relative">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*******">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-muted" for="remember">{{ __('Remember Me') }}</label>
                        @if (Route::has('password.request'))
                                    <a class="btn btn-link pull-right" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                        @endif
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Login') }}</button>
                  </div>
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