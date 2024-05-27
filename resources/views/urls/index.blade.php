{{-- @dd(Session::all()) --}}
@extends('Layouts.App')
@section('content')
   {{--  listing urls here --}}
  <h4 style="font-size:1.5rem">Add your urls here.</h4>
   <br>
   <a href= {{route('urls.create') }}>

    <h3>Create a new url</h3>
    </a>
    <br>
    @if (Session::has('success'))
    <span style="color:green">{{Session::get('success')}} </span>
    @endif
    <br>
    <div>
        <table  style="border: 2px solid rgb(0, 0, 0); border-collapse: collapse; width: 80%; height: 120px;">
            <h2>URL Table</h2>
            <tr>
                <th style="border: 2px solid black">ID</th>
                <th style="border: 2px solid black">Original Url</th>
                <th style="border: 2px solid black">Short Url</th>
                <th style="border: 2px solid black">Actions</th>
            </tr>
            @foreach ($urls as $url )
                <tr>
                    <td style="border: 2px solid black; text-align:center">{{$url->id}}</td>
                    <td style="border: 1px solid black ; text-align:center">{{$url->original_url}} </td>
                    <td style="border: 1px solid black ; text-align:center">{{$url->short_url}} </td>
                    <td style="border: 1px solid black; text-align:center"><a href={{route('urls.edit',['id'=>$url->id])}}>Edit</td>
                    <td style="border: 1px solid black; text-align:center"><a href={{route('urls.view',['id'=>$url->id])}}>View</td>
                    <td style="border: 1px solid black; text-align:center;">
                        <form action="{{route('urls.destroy',$url->id)}}" method="POST">
                            @csrf
                        <button type="delete" style="color:red;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


        </table>
    </div>
   {{--  @dd(Session::all()) --}}
@endsection
