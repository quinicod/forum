<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Reply extends Model
{
    protected $table = 'replies';
    protected $fillable = [
    'user_id', 'post_id', 'reply','attachment',
    ];
    // Para poder acceder al Foro desde esta tabla crearemos un atributo extra
    protected $appends = ['forum'];

    protected static function boot(){
        parent::boot();
        static::creating(function($reply){
            if(! App::runningInConsole()){
                $reply->user_id = auth()->id();
            }
        });
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }
    // Y aquí definimos el Atributo extra
    // Para hacer eso, la función debe comenzar por "get"
    // y finalizar por "Attribute" (y lo de en medio CamelCase)
    public function getForumAttribute() {
        return $this->post->forum;
    }
    public function pathAttachment()
    {
        return "images/replies/" . $this->attachment;
    }
}
