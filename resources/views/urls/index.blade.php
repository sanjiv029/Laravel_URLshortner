@extends('Layouts.App')
@section('content')
   {{--  listing urls here --}}
   Add your urls here.
   <br>
   <a href= {{route('urls.create') }}>
    <h3>Create a new url</h3>
    </a>
    <br>
    <div>
        <table style="color: rgb(106, 84, 84)">
            <h2>URL Table</h2>
            <tr>
                <th>ID</th>
                <th>Original Url</th>
                <th>Short Url</th>
            </tr>
            @foreach ($urls as $url )
                <tr>
                    <td>{{$url->id}}</td>
                    <td>{{$url->original_url}} </td>
                    <td>{{$url->short_url}} </td>
                    <td><a href={{route('urls.edit',['id'=>$url->id])}}>Edit</td>
                </tr>
            @endforeach


        </table>
    </div>
@endsection
