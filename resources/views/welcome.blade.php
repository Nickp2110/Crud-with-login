<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="nav justify-content-center" style="margin-top: 250px">
        <h1>Welcome</h1>
        <div class="container-fluid" style="margin-left: 550px">
            <a class="btn btn-outline-success" href="{{ url('/') }}">Dashboard</a>
            <a class="btn btn-outline-success" href="{{ url('/login') }}">Login</a>
            <a class="btn btn-outline-success" href="{{ url('/register') }}">Register</a>
        </div>
    </nav>
</body>
</html>
