@extends('Layouts.App')
@section('content')
    <h2>Edit your url here.</h2>
    <form action={{route('urls.edit',$url->id)}} method="post">
        <br>
        @csrf
        <label style=" font-size: 20px;">Input your url: </label>
        <input type="text" name="url" value={{$url->original_url}} style="width:250px">
        @error('url')
            <span style="color:red"> {{$message}} </span>
        @enderror
        <br>
        <br>
        <button type="submit" class="button">Submit</button>
         <a href="{{ route('urls') }}" class="button1">Back</a>
    </form>
@endsection
