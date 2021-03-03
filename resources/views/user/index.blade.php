@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Administrative Users') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="pull-right">
                            <a href="/admin/users/create" class="btn btn-outline-primary"> Create New Admin User</a>
                        </div>

                        <div>
                            <table class="table mt-4">
                                <tr>
                                    <th scope="col">UserID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>

                                            @foreach($user->roles as $role)
                                                <label class="badge badge-success">{{ $role->name }}</label>
                                            @endforeach

                                        </td>
                                        <td>
                                            <a class="btn btn-info" href="/admin/users/{{$user->id}}">Show</a>
                                            <a class="btn btn-primary" href="/admin/users/{{$user->id}}/edit">Edit</a>
                                            <form action="/admin/users/{{$user->id}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" id="deletedBy" name="deletedBy" value="{{Auth::id()}}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
