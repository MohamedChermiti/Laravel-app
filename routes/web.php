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

//This is another implementation of the route /posts using array_map
Route::get('/posts', function () {
    $posts = collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($document) => new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug
        ));

    return view('posts', [
        'posts' => $posts
    ]);
});


Route::get('/posts/{post}', function ($slug) {

    return view('post', [
        'post' => Post::find($slug)
    ]);
    /*
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    if (! file_exists($path)){
        //abort(404);
        return redirect('/posts');
    }
    $post = cache()->remember("posts.{slug}", now()->addDay(), function ()  use($path){
        return file_get_contents($path);
    });

    return view('post', [
        'post' => $post
    ]);*/
})->where('post', '[A-z_\-]+'); //Set a regular expression requirement on the rout
