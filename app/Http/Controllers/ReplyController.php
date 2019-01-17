<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidReply;
use App\reply;

class ReplyController extends Controller
{
    public function store()
    { 
        $this->validate(request(),
            [ 'reply' => ['required', new ValidReply],
            'file' => 'image' 
            ]
        );
        if(request()->hasFile('file') && request()->file('file')->isValid()) {
            $filename = uploadFile('file', 'replies');
            request()->merge(['attachment' => $filename]);
        }

        Reply::create(request()->input());

        return back()->with('message', ['success', __('Respuesta añadida correctamente')]);
    }

    public function pathAttachment() {
        return "/images/replies/" . $this->attachment;
    }
}
