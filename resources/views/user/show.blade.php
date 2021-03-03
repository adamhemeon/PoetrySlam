@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Details') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <strong>Name:</strong> {{ $user->name }}
                        </div>
                        <div>
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div>
                            <strong>Roles:</strong> |
                            @foreach($user->roles as $role)
                                {{ $role->name }} |
                            @endforeach
                        </div>

                            <a href="/admin/users" class="mt-sm-3 btn btn-secondary btn-sm">Back to Users</a>
                    </div>

                    <div class="card-footer">{{ __('Recent Posts') }}

                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->author}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->updated_at}}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
