<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function addSocialMedia()
    {
        auth()->user()->socialMedia()->create([
           'name' => request('name'),
           'username' => request('username'),
            'category_id' => request('category')
        ]);
        return back();
    }

    function addCategory()
    {
        auth()->user()->categories()->create([
           'name' => request('name')
        ]);

        return back();
    }

    function addCard()
    {
        $category = Category::find(request('number'));
        auth()->user()->cards()->create([
           'owner_id' => $category->user->id,
            'category_id' => $category->id
        ]);

        return back();
    }
}
