@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Themes') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="pull-right">
                            <a href="/admin/themes/create" class="btn btn-outline-primary">Add New Theme</a>
                        </div>

                        <div>
                            <table class="table mt-4">
                                <tr>
                                    <th scope="col">ThemeID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>

                                @foreach($themes as $theme)
                                    <tr>
                                        <td>{{ $theme->id }}</td>
                                        <td>{{ $theme->name }}</td>

                                        <td>
                                            <a class="btn btn-info" href="/admin/themes/{{$theme->id}}">Details</a>
                                            <a class="btn btn-primary" href="/admin/themes/{{$theme->id}}/edit">Edit</a>
                                            <form action="/admin/themes/{{$theme->id}}" method="post">
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
