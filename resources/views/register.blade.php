@extends('layouts.header')

@section('content')
    <div class="container mt-5 pb-5 pt-5 shadow bg-secondary text-light">
        <div class="row">
            <div class="col-sm-12 col-md-4"></div>
            <div class="col-sm-12 col-md-4">
                <h4 class="display-4">User registration</h4>
                <form action="{{ route('user.register') }}" method="POST">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-dark mt-3">Register</button>
                    <div class="alert alert-primary mt-3 mb-3">
                        <p>Have an account? Go back to <a href="/">login</a></p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->all())
                        <ul class="alert alert-danger mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>
            </div>
            <div class="col-sm-12 col-md-4"></div>
        </div>
    </div>
@endsection
