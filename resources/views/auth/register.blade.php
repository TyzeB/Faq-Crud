@extends('welcome')

@section('register')
<div class="form-container register-form">
    

    <form class="form" method="post" action="{{ route('register') }}">
        <h2>Register</h2>
        @csrf
        <div class="group-input">
            <label for="email">Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="group-input">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="group-input">
            <label for="password">Password</label>
            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="group-input">
            <label for="password">Confirm Password</label>
            <input id="password-confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      <input type="submit" name="submit" value="Register" />
    </form>
  </div>
@endsection
