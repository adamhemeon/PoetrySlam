@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Admin User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/admin/users" method="post">

                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email">

                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter Password">

                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" aria-describedby="password_confirmationHelp" placeholder="Confirm Password">

                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="roles">Select one or more roles:</label>
                                <select multiple name="roles[]" class="form-control" id="roles">
                                    @foreach($roles as $role)
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
