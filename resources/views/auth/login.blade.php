@extends('layouts.app')

@section('title', 'login')
    


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #fcf8ef; color: rgb(70, 46, 15);">{{ __('Login') }}</div>

                <div class="card-body" style="background-color: #fcf8ef;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3" style="color: rgb(70, 46, 15);">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6" style="color: rgb(70, 46, 15);">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: rgb(252, 200, 228);">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="color: rgb(70, 46, 15);">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6" style="color: rgb(70, 46, 15);">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: rgb(252, 200, 228);">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">
                                    {{ __('Login') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
