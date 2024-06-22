@extends('Layouts.App')
@section('content')
    <h1 style="text-align: center;">Upload your Profile</h1>
    @if(Session::has('success'))
    <div style="color: green">
        {{ Session::get('success') }}
    </div>
    @endif
    <form action={{route('profile')}} method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Enter your name  </label>
        @error('name')
            <span style="color:red"> {{$message}} </span>
        @enderror
        <br>
        <br>
        <input type="text" value="{{auth()->user()->name}}" name="name">
        <br>
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
@endsection
