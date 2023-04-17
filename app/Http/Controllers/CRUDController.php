<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crudoperation;
use App\Models\{User,country,state,city};
use Illuminate\Support\Facades\DB;
use Hash;
// use Kyslik\ColumnSortable\Sortable;

class CRUDController extends Controller
{
    //Fetch data + pagination + (Column sorting with kyslik/column-sortable)
    function getData(Request $req){
        $search = $req['search'] ?? "";
        // if($search != ""){
            if($search != ""){
                // $data = User::where('name','LIKE',"%$search%")->orwhere('email','LIKE',"%$search%")->paginate(4); //searching with paginate
                $data = DB::table('users')
                ->leftjoin('countries', 'users.country', '=', 'countries.id')
                ->leftjoin('states', 'users.state', '=', 'states.id')
                ->leftjoin('cities', 'users.city', '=', 'cities.id')
                ->select('users.id','users.name','users.mobile','users.email','users.gender','countries.name as country_name','states.name as state_name','cities.name as city_name')
                ->where('users.name','LIKE',"%$search%")->orwhere('users.email','LIKE',"%$search%")->paginate(4);
            }else{
                $data = DB::table('users')
                ->leftjoin('countries', 'users.country', '=', 'countries.id')
                ->leftjoin('states', 'users.state', '=', 'states.id')
                ->leftjoin('cities', 'users.city', '=', 'cities.id')
                ->select('users.id','users.name','users.mobile','users.email','users.gender','countries.name as country_name','states.name as state_name','cities.name as city_name')
                ->paginate(4);
            }

        return view('index',compact('data')); // only fetch data
    }

    //open form page
    function addData(){
        $countries = country::all();
        return view('addDataForm',compact('countries'));
    }

    // data save into database
    function saveData(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'mobile'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'password'=>'min:6',
            'confirm_password'=>'required_with:password|same:password|min:6'
        ]);
        $tname = new User();
        $tname->name = $req->name;
        $tname->email = $req->email;
        $tname->mobile = $req->mobile;
        $tname->gender = $req->gender;
        $tname->country = $req->country;
        $tname->state = $req->state;
        $tname->city = $req->city;
        $tname->password = Hash::make($req->password);
        $tname->confirm_password = Hash::make($req->confirm_password);
        $tname->save();
        return redirect('/list');
    }

    //go to update form
    function editData(Request $req,$id){
        $data = User::where('id','=',$id)->first();
        $countries = country::get(['name','id']);
        $states = state::get(['name','id']);
        $cities = city::get(['name','id']);

        return view('editData',compact('data','countries','states','cities'));
    }

    //save updated data to db
    function updateData(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'state'=>'required',
            'city'=>'required',
            'password'=>'required',
            'confirm_password'=>'required_with:password|same:password|min:6'
        ]);

        $id = $req->id;
        $name = $req->name;
        $email = $req->email;
        $mobile = $req->mobile;
        $gender = $req->gender;
        $country = $req->country;
        $state = $req->state;
        $city = $req->city;
        $password = Hash::make($req->password);
        $confirm_password = Hash::make($req->confirm_password);

        User::where('id','=',$id)->update([
            'name'=>$name,
            'email'=>$email,
            'mobile'=>$mobile,
            'gender'=>$gender,
            'country'=>$country,
            'state'=>$state,
            'city'=>$city,
            'password'=>$password,
            'confirm_password'=>$confirm_password
        ]);

        return redirect('/list');
    }

    //delete data to db
    function deleteData($id){
        User::where('id','=',$id)->delete();
        return redirect('/list');
    }

    function fetchstateedit(Request $req){
        $result['states'] = state::where('country_id',$req->country_id)->get(['name','id']);
        return response()->json($result);
    }

    //fetch city data to dropdown
    function fetchcityedit(Request $req){
        $result['cities'] = city::where('state_id',$req->state_id)->get(['name','id']);
        return response()->json($result);
    }
}
