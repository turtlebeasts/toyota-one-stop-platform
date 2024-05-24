@extends('layouts.header')

@section('content')
    <div class="container mt-5 pb-5 pt-5 shadow bg-secondary">
        <div class="row">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                <img src="assets/logot.png" alt="totya logo" width="100" class="img-responsive">
                <h3 class="display-3 text-center text-light">
                    TOYOTA
                </h3>
                <p class="text-center text-secondary-subtle">ONE STOP PLATFORM</p>
            </div>

            <div class="col-sm-12 col-md-4"></div>
            <div class="col-sm-12 col-md-4">
                <p class="text-center">
                    Access your dashboards from the following logins
                </p>
                @if ($errors->all())
                    <ul class="alert alert-danger mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger mt-2">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="col-sm-12 col-md-4"></div>
            <div class="col-sm-12 col-md-4"></div>
            <div class="col-sm-12 col-md-4 d-flex justify-content-between">

                {{-- Admin modal --}}
                <a href="#" class="btn bg-secondary-subtle text-dark" data-bs-toggle="modal"
                    data-bs-target="#adminModal">Admin</a>

                <!-- Admin Modal -->
                <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="adminModalLabel">Admin login</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#employeeModal">Employee</a>

                <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="adminModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="adminModalLabel">Employee login</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('employee.login') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#userModal">User</a>

                <!-- Admin Modal -->
                <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="adminModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="adminModalLabel">User login</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('user.login') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <p>Don't have an account? register <a href="register">here</a></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4"></div>
        </div>
    </div>
@endsection
