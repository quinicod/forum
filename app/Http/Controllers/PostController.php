<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $replies = $post->replies()->with('autor')->paginate(2);

        return view('forums.reply', compact('replies','post'));
    }

    
    public function store(PostRequest $post_request) 
    {
        $post_request->merge(['user_id' => auth()->id()]);
        if($post_request->hasFile('file') && $post_request->file('file')->isValid()){
            $filename = uploadFile('file', 'posts');
            $post_request->merge(['attachment' => $filename]);
        }
        Post::create($post_request->input()); // Esto coge todos los datos que vienen vía Post y los inserta 
        return back()->with('message', ['success', __('Post creado correctamente')]);
    }

    public function destroy(Post $post)
    {
        if( ! $post->isOwner())
            abort(401);
        $post->delete();
        return back()->with('message', ['success', __('Post y respuestas eliminados correctamente')]);
    }
}
