@extends('layouts.header')


@include('employee.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 px-5">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-danger">Change account password</h6>
                        <p class="text-danger">You can change your password for security reasons or reset it if you
                            forget it. Your Toyota Employee Account password is used to access the Employee dashboard, for
                            performing critical actions on this account, which may reflect on your work profile.</p>
                        <form action="{{ route('employee.set_password') }}" method="POST">
                            @csrf
                            <div class="mt-3">
                                <label for="c_password" class="form-label">Current Password</label>
                                <input type="text" name="current_password" id="c_password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="text" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-danger">I confirm to change my password</button>
                            </div>
                            @if ($errors->all())
                                <ul class="alert alert-danger mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-2">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection
