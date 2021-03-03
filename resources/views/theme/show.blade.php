@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Theme Details for {{ $theme->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <strong>Name:</strong> {{ $theme->name }}
                        </div>
                        <div>
                            <strong>CDN Url:</strong> {{ $theme->cdn_url }}
                        </div>

                        <a class="btn btn-primary" href="/admin/themes/{{$theme->id}}/edit">Edit</a>
                        <form action="/admin/themes/{{$theme->id}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" id="deletedBy" name="deletedBy" value="{{Auth::id()}}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="/admin/themes" class="mt-sm-3 btn btn-secondary btn-sm">Back to Themes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
