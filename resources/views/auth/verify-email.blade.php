@extends('Layouts.App')
@section('content')
    @if (Session::has('Message'))
        <span style="color:green;">{{Session::get('message')}} </span>

    @endif
    Pleae verify the email with verification link sent to your email.
    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Verify</button>
    </form>

@endsection
