@extends('Layouts.app')
@section('content')
    <h1 style="text-align: center; ">Welcome to URL shortner application</h1>
    @auth
    <a href= {{route('urls') }}>
        <h2 style="display: inline-block;">URLS</h2>
        </a>
        <br>
        <a href= {{route('file.upload') }}>
            <h3 style="display: inline-block;">Upload your files</h3>
            </a>
            <br>
            <a href= {{route('profile') }}>
                <h3 style="display: inline-block;">Edit your profile</h3>
                </a>
            <br>
    @endauth

@endsection
