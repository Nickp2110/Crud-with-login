<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,country,state,city};
use Hash;
use Session;

class AuthController extends Controller
{
    //
    function welcome(){
        return view('welcome');
    }
    function login(){
        return view('/auth.login');
    }
    function register(){
        //fetch country data to dropdown
        $countries = country::get(['name','id']);
        return view('/auth.register',compact('countries'));
        // return view('/auth.register');
    }
    function registeruser(Request $req){
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
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->gender = $req->gender;
        $user->country = $req->country;
        $user->state = $req->state;
        $user->city = $req->city;
        $user->password = Hash::make($req->password);
        $user->confirm_password = Hash::make($req->confirm_password);
        $res = $user->save();
        if ($res) {
            return back()->with('success','registered successfully');
        }else{
            return back()->with('fail','something wrong');
        }
    }

    function loginuser(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        $user = User::where('email','=',$req->email)->first();
        if($user){
            if(Hash::check($req->password,$user->password)){
                $req->session()->put('loginId',$user->id);
                return redirect('/dashboard');
            }else{
                return back()->with('fail','Password not matched');
            }
        }else{
            return back()->with('fail','Email id is not registered');
        }
    }

    function dashboard(){
        $user = array();
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();
        }
        $userdata = compact('user');
        return redirect('/list')->with('userdata');

    }

    function logout(){
        $user = array();
        if(Session::has('loginId')){
            $user = User::where('id','=',Session::get('loginId'))->first();
            Session::pull('loginId');
            return redirect('/');
        }else{
            "failed";
        }
    }

    //fetch state data to dropdown
    function fetchstate(Request $req){
        $data['states'] = state::where('country_id',$req->country_id)->get(['name','id']);
        return response()->json($data);
    }

    //fetch city data to dropdown
    function fetchcity(Request $req){
        $data['cities'] = city::where('state_id',$req->state_id)->get(['name','id']);
        return response()->json($data);
    }
}
