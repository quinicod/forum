<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['title','description','forum_id','user_id','slug','attachment'];

    protected static function boot()
    { 
        parent::boot();
        static::creating(function($post)
        { 
            if( ! App::runningInConsole() ) {
                $post->user_id = auth()->id();
                $post->slug = str_slug($post->title , "-");
            }
        });

        static::deleting(function($post)
        { 
            if( ! App::runningInConsole() ){
                if($post->replies()->count()) { 
                    foreach($post->replies as $reply) { 
                        if($reply->attachment) { 
                            Storage::delete('replies/' . $reply->attachment); 
                        } 
                    }
                    $post->replies()->delete(); 
                }
                if($post->attachment) {
                    Storage::delete('posts/' . $post->attachment);
                } 
            } 
        });
    }


    public function forum()
    {
        return $this->belongsTo(Forum::class,'forum_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    //función para las imagenes
    public function pathAttachment()
    {
        return "images/posts/" . $this->attachment;
    }

    public function isOwner() {
        return $this->owner->id === auth()->id();
    }
}
