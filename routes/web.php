<?php
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/posts', function () {
    $files = File::files(resource_path("posts"));
    collect()
    $posts = [];
    foreach ($files as $file){
        $document = YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        );
    }
    return view('posts', [
        'posts' => $posts
    ]);
});*/

//This is another implementation of the route /posts using collection and mapping
Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/posts/{post}', function ($slug) {
    /*
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    if (! file_exists($path)){
        return redirect('/posts');
    }
    return view('post', [
        'post' => cache()->remember("posts.{slug}", now()->addDay(), function ()  use($path){
            return file_get_contents($path);
        })
    ]);*/
    return view('post', [
        'post' => Post::findorFail($slug)

    ]);
});
// ->where('post', '[A-z_\-]+')  to Set a regular expression requirement on the rout
