@extends('Layouts.App')
@section('content')
    Edit your url here.
    <form action={{route('urls.edit',$url->id)}} method="post">
        <br>
        @csrf
        <label>Input your url: </label>
        <input type="text" name="url" value={{$url->original_url}} >
        @error('url')
            <span style="color:red"> {{$message}} </span>
        @enderror
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
@endsection
