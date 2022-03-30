<?php
namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Prophecy\Promise\ReturnPromise;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;
    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     */
    public function __construct($title, $excerpt, $date, $body,$slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function all() {
        $files = File::files(resource_path("posts/"));
        return array_map(function($file) {
            return $file->getContents();
        },$files);
    }


    /**
     * @throws Exception
     */
    public static function find ($slug) {
        if (! file_exists($path = resource_path("posts/{$slug}.html"))){
            //return redirect('/posts');
            throw new ModelNotFoundException();
        }
        return cache()->remember("posts.{$slug}", now()->addDay(), fn() =>file_get_contents($path));
            //return file_get_contents($path);
    }

}
