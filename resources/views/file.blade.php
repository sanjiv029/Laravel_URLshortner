@extends('Layouts.App')
@section('content')
    <h1 style="text-align: center;">Upload your file</h1>

    <form action={{route('file.upload')}} method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload your file here: </label>
        <br>
        <br>
        @error('file')
            <span style="color:red"> {{$message}} </span>
        @enderror
        <br>
        <br>
        <input type="file" name="file">
        <br>
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
    @if(Session::has('path'))
    <div>
        <img src="{{Storage::url(Session::get('path')) }}" alt="Uploaded Image">
    </div>
    @endif
@endsection
