<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<style>
  .login-card {
background: #322d70;
padding: 30px 12px;
}
@media only screen and (max-width: 575.98px){
.login-card .login-main {
    width: 329px;
    padding: 20px;
}
}
</style>
@section('title','Email') 
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/2.jpg') }}" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
                <div class="login-main">
                    <div>
                        <a class="logo text-start" href="">
                            <img class="img-fluid for-light center" src="{{ asset('assets/images/logo/logo.png') }}" alt="looginpage" style="height:90px;">
                        </a>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif 
                    <form class="theme-form" method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <h4>{{ __('Confirm Password') }}</h4>
                        <p>{{ __('Please confirm your password before continuing.') }}</p>
                        <div class="form-group">
                            <label class="col-form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group mb-0">
                            <div class="checkbox p-0">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                        <button class="btn btn-primary btn-block w-100" type="submit">{{ __('Confirm Password') }}</button>
                    </form>
                </div>
          </div>
        </div>
      </div>
      @include('includes.foot')
    </div>
  </body>
</html>