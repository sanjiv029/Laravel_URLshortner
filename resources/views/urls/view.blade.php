
@extends('Layouts.App')
@section('content')
   {{--  listing urls here --}}
    <h1 style="text-align: center;">URL Visitor</h1>
   <br>
    <h3>Analytics for url: {{$url->original_url}} </h3>
    <h3>Short url: {{$url->short_url}} </h3>
    <h4 style="color:rgb(26, 89, 89);">Visitor Count: {{$url->visitor_count}} </h4>
    <br>

    <br>
    <div>
        <table  style="color: rgb(0, 0, 0); border: 1px solid rgb(0, 107, 238); border-collapse: collapse; width: 70%; height: auto;">
            <h2>URL Table</h2>
            <tr>
                <th style="border: 1px solid black">ID</th>
                <th style="border: 1px solid black">IP Address</th>
                <th style="border: 1px solid black">User Agent</th>
                <th style="border: 1px solid black">Visited At</th>
            </tr>
            @foreach ($url->Visitors as $visitor )
                <tr>
                    <td style="border: 1px solid black">{{$visitor->id}}</td>
                    <td style="border: 1px solid black">{{$visitor->ip}} </td>
                    <td style="border: 1px solid black">{{$visitor->user_agent}} </td>
                    <td style="border: 1px solid black">{{$visitor->created_at}} </td>

                </tr>
            @endforeach


        </table>
    </div>
@endsection
