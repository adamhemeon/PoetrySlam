@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Admin User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/admin/users/{{ $user->id }}" method="post">

                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}" placeholder="Enter Name">

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Enter Email">

                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="roles">Select one or more roles:</label>
                                <select multiple name="roles[]" class="form-control" id="roles">
                                    @foreach($roles as $role)
{{--                                        @if(in_array($role, $user->roles))--}}
{{--                                            {{ $selected = "selected" }}--}}
{{--                                        @else--}}
{{--                                            {{ $selected = "" }}--}}
{{--                                        @endif--}}
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('roles')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/admin/users" class="btn btn-outline-primary">Cancel</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
