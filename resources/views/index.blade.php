<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Crud</title>
</head>
<body>
    <div class="container border p-2 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <h3 style="margin-right: 825px">CRUD Operation</h3>
                    <a class="btn btn-danger rounded" href="logout" >Logout</a>
                </div><br>
                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <form action="" method="GET">
                    <div class="input-group">
                        <a href="{{ url('/add') }}"><button class="btn btn-primary" type="button">Add</button></a>
                        <input class="form-control rounded" style="margin-left:250px;" type="search" name="search" placeholder="Search here">
                        <button class="btn btn-primary">search</button>&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/list') }}"><button class="btn btn-primary" style="margin-right:250px" type="button">reset</button></a>
                    </div>
                </form>
                <table class="table border mt-3">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>gender</th>
                            <th>country</th>
                            <th>state</th>
                            <th>city</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->country_name}}</td>
                                <td>{{ $item->state_name }}</td>
                                <td>{{ $item->city_name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ url('edit/'.$item->id) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ url('delete/'.$item->id) }}">Delte</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{  $data->links()  }}
                </div>
                <style>
                    .w-5{width: 40px;height: 100px;}
                </style>
            </div>
        </div>
    </div>
</body>
</html>
