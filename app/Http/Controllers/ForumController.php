<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::latest()->with(['post','replies'])->paginate(2);
        //dd($forums);
        return view('forums.index', compact('forums'));
    }

    public function show(Forum $forum)
    {
        $posts = $forum->post()->with(['owner'])->paginate(2);
        //dd($posts);

        return view('forums.forum', compact('forum','posts'));
    }

    public function store()
    {  
        $this->validate(request(),[ 
            'name' => 'required|max:100|unique:forums',// forums es la tabla dónde debe ser único 
            'description' => 'required|max:500', ], 
            [ 
                'name.required' => __("El campo NAME es requerido!!!") 
            ]);

        Forum::create(request()->all());
        // La siguiente línea nos devuelve a la url anterior (si es que existe), o a la raíz
        // y manda un mensaje, mediante una sesión flash, de éxito
        return back()->with('message', ['success', __("Foro creado correctamente")]);
    }
}
