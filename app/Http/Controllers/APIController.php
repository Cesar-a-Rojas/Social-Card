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

    function index()
    {
        return "This is index";
    }
}
