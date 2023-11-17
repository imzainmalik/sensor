<!DOCTYPE html>
<html>
<head>
    <title>RezySave</title>
</head>
<body>

    <h1>Name : {{ $user['name'] }}</h1>
    <p>Email : {{ $user['email'] }}</p>
    
    <a href="{{ route('user.cofigure_password' , [$user->id]) }}"  class="btn btn-primary"> Configure Password</a>

    <p>Thank you</p>
</body>
