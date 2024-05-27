<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{Config('app.name')}} </title>
</head>
<body style="background:linear-gradient(to right ,#e75151, #a8c0ff); margin:70px; padding:5px;">
<nav >
   <a href="{{ route('home')}}" style="text-align:left; padding-right:50px">
    Home </a>
    @guest
    <a href="{{ route('auth.register')}}" style="text-align: right">
        Register Now </a>
        <a href="{{ route('auth.login')}}" style="text-align: right; padding-left:40px">
            Log In </a>
    @endguest
</nav>
<br><br>

@yield('content')
</body>
<br><br>




</html>
