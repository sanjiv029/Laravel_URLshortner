@extends('Layouts.App')
@section('content')
    @if (Session::has('message'))
        <span style="color:green;">{{ Session::get('message') }}</span>
    @endif
    @if (Session::has('email'))
        <span style="color:rgb(254, 14, 14);">{{ Session::get('email') }}</span>
    @endif
    @error('email')
        <span style="color:rgb(254, 14, 14);">{{ $message }}</span>
    @enderror
    Please reset the password with the verification link sent to your email.
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token ?? '' }}"> <!-- Ensure token is passed correctly -->

        <label for="email">Email</label>
        <input type="email" name="email" value="{{ $email ?? old('email') }}"> <!-- Use old() to retain the email if there was an error -->

        <br>

        <label for="password">Password</label>
        <input type="password" name="password">

        <br>

        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation">

        <br>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reset Password</button>
    </form>
@endsection
