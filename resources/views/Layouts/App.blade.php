<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            background: linear-gradient(to right,#aab1ee, #0088ff);
            margin: 70px;
            padding: 5px;
        }

        .navbar {
            font-size: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            text-decoration: none;
            color: inherit;
            margin: 0 20px;
        }

        .transparent-button {
            background-color: transparent;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0;
            font: inherit;
            outline: none;
        }

        .transparent-button:hover,
        .transparent-button:focus {
            opacity: 0.8;
        }

        .button {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            color: rgb(0, 0, 0);
            background-color: #ffffff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0cfd08;
        }
        .delete {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            color: rgb(0, 0, 0);
            background-color: #ffffff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .delete:hover {
            background-color: #b30000;
        }
    </style>
</head>
<body>
<nav class="navbar">
   <div>
       <a href="{{ route('home') }}">Home</a>
   </div>
   <div>
        @guest
        <a href="{{ route('auth.register') }}">Register Now</a>
        <a href="{{ route('login') }}" style="padding-left: 40px;">Log In</a>
        @endguest

        @auth
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            {{auth()->user()->name}}
            <button type="submit" style="color: #c90c0c;" class="transparent-button">Log Out</button>
        </form>
        @endauth
    </div>
</nav>

<br>
<br>
@yield('content')
<br>
<br>
</body>
</html>
