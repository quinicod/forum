@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
             <h1>Foros</h1>
        </div>
    </div><br>
    <div class="row">
        <div class="col">
            @forelse($forums as $f)
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-forum">
                    <a href="forums/{{ $f->slug }}"> {{$f->name}} </a>
                    <span class="pull-right"> {{ __("Posts") }}: {{ $f->post->count() }}  {{ __("Respuestas") }}: {{ $f->replies->count() }}</span>
                </div>
                <div class="panel-body">
                    {{$f->description}}
                </div>
            </div>
            @empty
                <div class="alert alert-danger">
                    No hay foros...
                </div>
            @endforelse
        </div>
    </div> <br><br>
    @if($forums->count())
        {{$forums->links()}} 
    @endif
    <h2>{{ __("Añadir un nuevo foro") }}</h2>
    <hr />
    @include('partials.errors')
    <form method="POST" action="forums">
            {{ csrf_field() }}
            <div class="form-group"> 
                <label for="name" class="col-md-12 control-label">{{ __("Nombre") }} </label>
                <input id="name" class="form-control" name="name" value="{{ old('name') }}"/>
            </div> 
            <div class="form-group">
                <label for="description" class="col-md-12 control-label">{{ __("Descripción") }} </label>
                <input id="description" class="form-control" name="description" value="{{ old('description') }}"/>
            </div>
            <button type="submit" name="addForum" class="btn btn-default"> {{ __("Añadir Foro") }} </button>
    </form>
</div>


@endsection