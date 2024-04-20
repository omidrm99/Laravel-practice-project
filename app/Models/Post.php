<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body,$slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function find($slug)
    {
        $path = resource_path("posts/{$slug}.html");
        if (!file_exists($path)) {
            throw new ModelNotFoundException();
        }
        return cache()->remember(
            "posts.{$slug}",
            5,
            fn() => file_get_contents($path)
        );
    }

    public static function all()
    {
        $files = File::files(resource_path("posts/"));
        return array_map(fn($file) => $file->getContents(), $files);
    }
}