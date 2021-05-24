@extends('layouts.app')

@section('content')


        <div class="overlay1"></div>
        <div class="login-box overlay2">

          <!-- /.login-logo -->
          <div class="card shadow p-3">
            <center><h1 class="bg-orange text-white p-2">SISTEM PENJUALAN SPAREPART V1</h1></center>
            <div class="card-body login-card-body">
              <p class="login-box-msg">Masuk untuk menggunakan sistem</p>

              <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="email" class=" col-form-label ">{{ __('Email') }}</label>

                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">



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
                <label for="password" class=" col-form-label ">{{ __('Password') }}</label>

                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

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
                <div class="form-group mb-0 justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>

                    {{-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Reset Password?') }}
                        </a>
                    @endif --}}

            </div>

              </form>




            </div>
            <!-- /.login-card-body -->
          </div>
        </div>


@endsection
