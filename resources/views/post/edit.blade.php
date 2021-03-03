@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Post') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/posts/{{ $post->id }}" method="post">

                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{ $post->title }}" placeholder="Title">

                                @error('title')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input name="author" type="text" class="form-control" id="author" value="{{ $post->author }}" placeholder="Author">

                                @error('author')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="5">{{ $post->message }}</textarea>

                                @error('message')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="/home" class="btn btn-outline-primary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
