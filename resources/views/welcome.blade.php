@extends('Layouts.app')
@section('content')
    <h1 style="text-align: center">Welcome to URL shortner application</h1>
    <a href= {{route('urls') }}>
        <h3>URLS</h3>
        </a>
@endsection
