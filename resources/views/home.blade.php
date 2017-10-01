@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-center">New Category</h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('addCategory') }}" method="POST">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name">
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" value="Add" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <h1 class="text-center">New Social Media</h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('addSocialMedia') }}" method="POST">
                        <div class="form-group">
                            <label for="">Social Media</label>
                            <input type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category" id="">
                                @foreach(auth()->user()->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" value="Add" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <h1 class="text-center">Add Someone's Card</h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('addCard') }}" method="POST">
                        <div class="form-group">
                            <label for="">Number</label>
                            <input type="number" name="number">
                        </div>
                        {{ csrf_field() }}
                        <input type="submit" value="Add" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <h1 class="text-center">My Cards</h1>
            @foreach(auth()->user()->cards as $card)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>{{ $card->owner->name}}</h1>
                        @foreach($card->socialMedia() as $media)
                        <h3>{{ $media->name }}: {{ $media->username }}</h3>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <h1 class="text-center">My Social Media</h1>
            <div class="row">
                @foreach(auth()->user()->categories as $category)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1>{{ $category->name }} id:{{ $category->id }}</h1>
                                @foreach($category->socialMedia as $media)
                                <h2>{{ $media->name }}: {{ $media->username }}</h2>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
