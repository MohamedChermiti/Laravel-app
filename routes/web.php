<?php
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
 //med

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/posts/{post}', function ($slug) {
    $document = YamlFrontMatter::parseFile(

    );

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
