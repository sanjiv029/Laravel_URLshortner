@extends('Layouts.App')
@section('content')
   <div class="container">
    <h1 style="text-align: center">Registration Page</h1>
    <form method="POST" action="{{route('auth.register')}}">
        @csrf
        <div class="form-group" style="padding-bottom: 20px">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            @error('name')
            <span style="color:red"> {{$message}} </span>
        @enderror
        </div>
        <div class="form-group" style="padding-bottom: 20px">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
            @error('email')
            <span style="color:red"> {{$message}} </span>
        @enderror
        </div>
        <div class="form-group"  style="padding-bottom: 20px">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password')
            <span style="color:red"> {{$message}} </span>
        @enderror
        </div>
        <div class="form-group" style="padding-bottom: 20px">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            @error('password_confirmation')
            <span style="color:red"> {{$message}} </span>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection
