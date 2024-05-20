@extends('layouts.header')

@include('admin.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-light">
        <div class="row">
            <div class="col-12">
                <h6 class="display-6">
                    Employee
                </h6>
                <p>Manage your employees</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addEmployee">
                    <i class="bi bi-person-badge-fill"></i> Add employees
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addEmployeeLabel"><i class="bi bi-person-badge-fill"></i>
                                    Add employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if ($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" width="50"
                                            height="50">
                                    @else
                                        No Photo
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $user->id }}">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.employee.edit', $user->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $user->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" value="{{ $user->phone }}">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            @if ($user->photo)
                                                                <img src="{{ asset('storage/' . $user->photo) }}"
                                                                    alt="User Photo" width="100">
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="photo">Photo</label>
                                                            <input type="file" class="form-control" id="photo"
                                                                name="photo">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email address</label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" value="{{ $user->email }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-dark">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Button trigger delete modal --}}
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $user->id }}">
                                        <i class="bi bi-trash3-fill"></i> Delete
                                    </button>

                                    <!-- Modal delete -->
                                    <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                        {{ $user->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="text-danger">Are you sure you want to delete this user?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.employee.destroy', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
