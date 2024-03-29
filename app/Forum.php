<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Forum extends Model
{
    protected $table = 'forums';

    protected $fillable = ['name','description','slug'];

    protected static function boot() 
    { 
        parent::boot();
        static::creating(function($forum) {
            if( ! App::runningInConsole() ){ 
                $forum->slug = str_slug($forum->name , "-");
            }
        });
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function replies()
    { 
        return $this->hasManyThrough(Reply::class, Post::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }



}
