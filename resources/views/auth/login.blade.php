@extends('Layouts.App')
@section('content')
   <div class="container">
    <h1 style="text-align: center">Log In Page</h1>
    <form method="POST" action="{{route('login')}}">
        @csrf
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
        <a href="{{route('password.request')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Forget Your Password</a>
        <br><br>
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>
</div>
@endsection
