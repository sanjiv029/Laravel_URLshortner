{{-- @dd(Session::all()) --}}
@extends('Layouts.App')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />

   {{--  listing urls here --}}
  <h4 style="font-size:1.5rem">Add your urls here.</h4>
   <br>
   <a href= {{route('urls.create') }}>

    <h3>Create a new url</h3>
    </a>
    <br>
    @if (Session::has('success'))
    <span style="color:green">{{ Session::get('success') }}</span>
    @endif

    @if (Session::has('error'))
    <span style="color:red">{{ Session::get('error') }}</span>
    @endif

<br>
    <br>
Total Urls: {{ $count }}
    <div>
        <table  style="border: 2px solid rgb(0, 0, 0); border-collapse: collapse; width: 80%; height: 120px;">
            <h2>URL Table</h2>
            <tr>
                <th style="border: 2px solid black">Index</th>
                <th style="border: 2px solid black">ID</th>
                <th style="border: 2px solid black">Original Url</th>
                <th style="border: 2px solid black">Short Url</th>
                <th style="border: 2px solid black">Actions</th>
            </tr>
            @forelse ($urls as $url)
            <tr>
                <td style="border: 2px solid black; text-align:center">{{ $loop->iteration }}</td>
                <td style="border: 2px solid black; text-align:center">{{ $url->id }}</td>
                <td style="border: 1px solid black; text-align:center">{{ $url->original_url }}</td>
                <td style="border: 1px solid black; text-align:center">{{ $url->short_url }}</td>
                <td style="border: 1px solid black; text-align:center"><a href="{{ route('urls.edit', ['id' => $url->id]) }}" class="button">Edit</a></td>
                <td style="border: 1px solid black; text-align:center"><a href="{{ route('urls.view', ['id' => $url->id]) }}" class="button">View</a></td>
                <td style="border: 1px solid black; text-align:center;">
                    <form action="{{ route('urls.destroy', $url->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </td>
            </tr>
             @empty
            <tr>
                <td colspan="6" style="text-align: center; border: 1px solid black;">No URLs found</td>
            </tr>
            @endforelse

    </table>
    <div>
        {{$urls->links('pagination::custom')}}
    </div>
    </div>
   {{--  @dd(Session::all()) --}}
@endsection
