@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1 class="text-center text-mute"> {{ __("Respuestas al debate :name", ['name' => $post->title]) }} </h1>
        <h4>{{ __("Autor del debate") }}: {{ $post->owner->name }}</h4>
        
        <a href="../forums/{{ $post->forum->slug }}" class="btn btn-info pull-right"> {{ __ ("Volver al foro :name", ['name' => $post->forum->name]) }} </a>
        <div class="clearfix"></div>
        <br/>
        @forelse($replies as $reply)
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-reply">
                <p>{{ __("Respuesta de") }}: {{ $reply->autor->name }}</p>
            </div>
            <div class="panel-body">
                {{ $reply->reply }}
                @if($post->attachment)
                    <img src="{{ $reply->pathAttachment() }}" class="img-responsive img-rounded" /> 
                @endif
            </div>
        </div>
        @empty
        <div class="alert alert-danger">
            {{ __("No hay ninguna respuesta en este momento") }}
        </div>
        @endforelse
        @if($replies->count())
            {{ $replies->links() }}
        @endif
        @Logged()
            <h3 class="text-muted">{{ __("Añadir una nueva respuesta al post :name", ['name' => $post->name]) }}</h3>
            @include('partials.errors')
                <form method="POST" action="../replies" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    <div class="form-group">
                        <label for="reply" class="col-md-12 control-label">{{ __("Respuesta") }}</label>
                        <textarea id="reply" class="form-control" name="reply">{{ old('reply') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" name="addReply" class="btn btn-default">{{ __("Añadir respuesta") }}</button>
                </form>
            @else
            @include('partials.login_link', ['message' => __("Inicia sessión para responder")])
        @endLogged()
    </div>
</div>
@endsection