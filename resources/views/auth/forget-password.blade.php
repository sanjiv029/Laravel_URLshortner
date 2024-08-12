@extends('Layouts.App')
@section('content')
    @if (Session::has('Message'))
        <span style="color:green;">{{Session::get('message')}} </span>
    @endif
    @if (Session::has('email'))
        <span style="color:rgb(254, 14, 14);">{{Session::get('email')}} </span>
    @endif
    @error('email')
         <span style="color:rgb(254, 14, 14);">{{$message}} </span>
    @enderror
    Pleae reset the password with verification link sent to your email.
    <form action="{{route('password.email')}}" method="post">
        @csrf
        <label for="">Email</label>
        <input type="email" name="email">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reset Link Send</button>
    </form>

@endsection
