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
        <table  style="color: rgb(0, 0, 0); border: 1px solid rgb(0, 107, 238); border-collapse: collapse; width: 70%; height: auto;">
            <h2>URL Table</h2>
            <tr>
                <th style="border: 1px solid black">ID</th>
                <th style="border: 1px solid black">Original Url</th>
                <th style="border: 1px solid black">Short Url</th>
                <th style="border: 1px solid black">Actions</th>
            </tr>
            @foreach ($urls as $url )
                <tr>
                    <td style="border: 1px solid black">{{$url->id}}</td>
                    <td style="border: 1px solid black">{{$url->original_url}} </td>
                    <td style="border: 1px solid black">{{$url->short_url}} </td>
                    <td style="border: 1px solid black"><a href={{route('urls.edit',['id'=>$url->id])}}>Edit</td>

                     <td style="border: 1px solid black">
                        <form action="{{route('urls.destroy',$url->id)}}" method="POST">
                            @csrf
                        <button type="delete">Delete</button>
                        </form>
                    </td>

                </tr>
            @endforeach


        </table>
    </div>
@endsection
