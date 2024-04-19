<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{

    public static function find($slug)
    {
        $path = resource_path("posts/{$slug}.html");
        if (!file_exists($path)) {
            throw new ModelNotFoundException();
        }
        return cache()->remember("posts.{$slug}", 5,
            fn() => file_get_contents($path));
    }

    public static function all()
    {
        $files = \Illuminate\Support\Facades\File::files(resource_path("posts/"));
        return array_map(fn($file) => $file->getContents(), $files);
    }
}