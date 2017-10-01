<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Category;
use App\Card;

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
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'api_token' => str_random(60)
        ]);

        return "ok";
    }

    function index()
    {
        return Auth::guard('api')->user()->with(['socialMedia', 'categories', 'cards'])->get();
    }

    function userCategories()
    {
        return Auth::guard('api')->user()->categories()->with('socialMedia')->get();
    }

    function userSocialMedia()
    {
        return Auth::guard('api')->user()->socialMedia;
    }

    function userCards()
    {
        return Card::with('owner')->where('user_id', Auth::guard('api')->user()->id->get());
    }

    function addSocialMedia()
    {
        Auth::guard('api')->user()->socialMedia()->create([
            'name' => request('name'),
            'username' => request('username'),
            'category_id' => request('category')
        ]);
        return "ok";
    }

    function addCategory()
    {
        Auth::guard('api')->user()->categories()->create([
            'name' => request('name')
        ]);

        return "ok";
    }

    function addCard()
    {
        $category = Category::find(request('number'));
        Auth::guard('api')->user()->cards()->create([
            'owner_id' => $category->user->id,
            'category_id' => $category->id
        ]);

        return "ok";
    }
}
