@extends('Layouts.app')
@section('content')
    <h1 style="text-align: center">Welcome to URL shortner application</h1>
    @auth
    <a href= {{route('urls') }}>
        <h2 style="text-align: center">URLS</h2>
        </a>
        <br>
        <br>
    @endauth

@endsection
