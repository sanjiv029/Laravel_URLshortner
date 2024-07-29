
@extends('Layouts.App')
@section('content')
    <h2>{{ $exception->getMessage() }}</h2>
    You cannot access or edit others URL.
@endsection
