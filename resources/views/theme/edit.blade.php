@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Theme') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/admin/themes/{{ $theme->id }}" method="post">

                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ $theme->name }}" placeholder="Enter Name">

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cdn_url">CDN Url</label>
                                <input name="cdn_url" type="text" class="form-control" id="cdn_url" value="{{ $theme->cdn_url }}" placeholder="Enter the CDN url">

                                @error('cdn_url')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/admin/themes" class="btn btn-outline-primary">Cancel</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
