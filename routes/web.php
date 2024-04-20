<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});


Route::get('posts/{post}', function ($slug) {
    return view('post', [
        'post' => post::find($slug)
    ]);
})->where('post', '[A-z_\-]+');