<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Welcome</title>
</head>
<body>
    <div class="container" style="margin-left:450px;margin-top:30px">
        <div class="row">
            <div class="col-md-4">
                {{-- <a class="btn btn-primary" href="">Data</a> --}}
                <form class="form-control form-control-lg" action="{{ url('loginuser') }}" method="POST">
                    <h1 class="text-center">Login page</h1><br>
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @csrf
                    <input class="form-control" type="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                    <span class="text-danger" style="font-size: 14px">@error('email') {{ $message }}@enderror</span><br>
                    <input class="form-control" type="password" name="password" placeholder="Enter password">
                    <span class="text-danger" style="font-size: 14px">@error('password') {{ $message }}@enderror</span><br>

                    <button class="btn btn-primary" type="submit">Login</button>
                    <a href="{{ url('/') }}" class="btn btn-danger">Back</a><br>
                    <a href="{{ url('/register') }}" >register here!!</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
