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
    <div class="container" style="margin-left:450px;margin-top:10px">
        <div class="row">
            <div class="col-md-4">
                <form class="form-control form-control-lg" action="{{ url('edit') }}" method="POST">
                    <h2 class="text-center">Edit Data Form</h2>
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <input type="hidden" id="stateoldid" value="{{ $data->state }}">
                    <input type="hidden" id="cityoldid" value="{{ $data->city }}">
                    <input class="form-control" type="text" name="name" placeholder="Enter Name" value="{{ $data->name }}">
                    <span class="text-danger">@error('name') {{ $message }}@enderror</span><br>
                    <input class="form-control" type="email" name="email" placeholder="Enter email" value="{{ $data->email }}">
                    <span class="text-danger">@error('email') {{ $message }}@enderror</span><br>
                    <input class="form-control" type="tel" name="mobile" placeholder="Enter mobile" value="{{ $data->mobile }}">
                    <span class="text-danger">@error('mobile') {{ $message }}@enderror</span><br>
                    <select class="form-control" name="gender" value="{{ $data->gender }}">
                        <option disabled selected>Select Gender</option>
                        <option value="male" {{($data->gender === 'male') ? 'selected' : ''}}>Male</option>
                        <option value="female" {{($data->gender === 'female') ? 'selected' : ''}}>Female</option>
                    </select>
                    <span class="text-danger">@error('gender') {{ $message }}@enderror</span><br>
                    <select class="form-control" name="country" id="country">
                        <option value="" disabled>Select Country</option>
                        @foreach($countries as $country)
                        @if($data->country == $country->id)
                        <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                        @else
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <span class="text-danger" style="font-size: 14px">@error('country') {{ $message }}@enderror</span><br>
                    <select class="form-control" name="state" id="state" >
                        <option value="" >Select State</option>
                        @foreach($states as $state)
                        @if($state->id == $data->state)
                        <option value="{{ $state->id }}" selected>{{ $state->name }}</option>
                        @else
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <span class="text-danger" style="font-size: 14px">@error('state') {{ $message }}@enderror</span><br>
                    <select class="form-control" name="city" id="city">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                        @if($city->id == $data->city)
                        <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                        @else
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endif
                        @endforeach
                    </select>
                    <span class="text-danger" style="font-size: 14px">@error('city') {{ $message }}@enderror</span><br>
                    <input class="form-control" type="password" name="password" placeholder="Enter password">
                    <span class="text-danger" style="font-size: 14px">@error('password') {{ $message }}@enderror</span><br>
                    <input class="form-control" type="confirm_password" name="confirm_password" placeholder="Confirm password">
                    <span class="text-danger" style="font-size: 14px">@error('confirm_password') {{ $message }}@enderror</span><br>

                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a href="{{ url('/list') }}" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#country').change(function(){
                var countryId = this.value;
                $('#state').html('');
                $.ajax({
                    url:'fetchstateedit',
                    type:'POST',
                    dataType:'json',
                    data: {country_id:countryId,_token:"{{ csrf_token() }}"},
                    success:function(response){
                        $('#state').html('<option value="">Select State</option>');
                        $.each(response.states,function(key,val){
                            $('#state').append('<option value="'+val.id+'" >'+val.name+'</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                })
            })

            $('#state').change(function(){
                var stateId = this.value;
                $('#city').html('');

                $.ajax({
                    url:'fetchcityedit',
                    type:'POST',
                    dataType:'json',
                    data:{state_id:stateId,_token:"{{ csrf_token() }}"},
                    success:function(response){
                        $('#city').html('<option value="">Select city</option>');
                        $.each(response.cities,function(index,val){
                            $('#city').append('<option value="'+val.id+'">'+val.name+'</option>');
                        });
                    }
                })
            });
        })
    </script>
</body>
</html>
