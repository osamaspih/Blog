<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use PhpParser\Node\Scalar\String_;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public String $title;
    public String $body;
    public String $date;
    public String $slug;

        public function __construct($title,$body,$date,$slug){
        $this->title =$title;
            $this->body =$body;
            $this->date =$date;
            $this->slug =$slug;
        }

    public static function find($slug)
    {
    return static::all()->firstWhere('slug',$slug);
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all',function (){
            return collect(File::files(resource_path("posts")))->map(function ($file) {
                $doc = YamlFrontMatter::parseFile($file);
                return new Post(
                    $doc->matter("title"),
                    $doc->body(),
                    $doc->matter("date"),
                    $doc->matter("slug"),
                );
            })->sortBy('date');
        });
    }
}



