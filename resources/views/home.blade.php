@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header mb-2 bg-dark text-white text-md-center">{{ __('Media Feed') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::check())
                        <div class="pull-right mb-4">
                            <a href="/posts/create" class="btn btn-outline-primary"> Create Post</a>
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <div class="card mt-2">
                            <div class="card-header">{{ $post->title }}</div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-subtitle mb-2 text-muted">{{ $post->author }}</h5>
                            <p style="white-space:pre-wrap;" class="card-text">{{ $post->message }}</p>
                            <p class="text-muted">
                                Posted by {{$post->user->name}} {{ $post->created_at->diffForHumans() }}.
                                @if($post->updated_at != $post->created_at)
                                    (Edited {{ $post->updated_at->diffForHumans() }})
                                @endif
                            </p>

                            @if(Auth::check() && ($post->user->id == Auth::id()))
                                <div>
                                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning"> Edit </a>
                                    <form class="mt-2" action="/posts/{{$post->id}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" id="deletedBy" name="deletedBy" value="{{Auth::id()}}">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            @elseif(Auth::check())
                                @foreach($roles as $role)
                                    @if($role == "Moderator")
                                        <div>
                                            <form class="mt-2" action="/posts/{{$post->id}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" id="deletedBy" name="deletedBy" value="{{Auth::id()}}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
