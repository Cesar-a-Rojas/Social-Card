<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class APIController extends Controller
{

    function authenticate()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            return User::where('email', request('email'))->first()->api_token;
        }
        else
        {
            return "Authentication Failed";
        }
    }

    function register()
    {
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => str_random(60)
        ]);

        return "ok";
    }

    function index()
    {
        return "Hello ".Auth::guard('api')->user()->name;
    }
}
