@extends('Layouts.App')
@section('content')
    Create your  url here.

    <form action={{route('urls.create')}} method="post">
        <br>
        @csrf
        <label for="url">Input your url: </label>
        <input type="text" name="url">
        @error('url')
            <span style="color:red"> {{$message}} </span>
        @enderror
        <br>
        <br>
        <button type="submit" class="button">Submit</button>
        <a href="{{ route('urls') }}" class="button1">Back</a>
    </form>

@endsection
