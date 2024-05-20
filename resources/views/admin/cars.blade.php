@extends('layouts.header')

@include('admin.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-light">
        <div class="row">
            <div class="col-12">
                <h6 class="display-6">
                    Cars in your showroom
                </h6>
                <p>Manage your cars</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addEmployee">
                    <i class="bi bi-car-front-fill"></i> Add cars
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addEmployeeLabel"><i class="bi bi-car-front-fill"></i>
                                    Add employee</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.car.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Model Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="text" class="form-control" id="year" name="year" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" class="form-control" id="color" name="color" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" id="photo" name="photo" required>
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
                            <th>Car</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td>
                                    @if ($car->photo)
                                        <img src="{{ asset('storage/' . $car->photo) }}" alt="car Photo" class="img-fluid">
                                    @else
                                        No Photo
                                    @endif

                                    <h6>Model: {{ $car->name }}</h6>
                                    <small>{{ $car->year }}</small>
                                    <small>{{ $car->color }}</small><br>
                                    <b>stock: {{ $car->stock }}</b>
                                    <p>{{ $car->description }}</p>
                                </td>
                                <td>
                                    <!-- Button trigger edit modal -->
                                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{ $car->id }}">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </button>

                                    <!-- Modal update -->
                                    <div class="modal fade" id="editModal-{{ $car->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                        {{ $car->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.car.update', $car->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" value="{{ $car->name }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="text" class="form-control" id="price"
                                                                name="price" value="{{ $car->price }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="year">Year</label>
                                                            <input type="text" class="form-control" id="year"
                                                                name="year" value="{{ $car->year }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="color">Color</label>
                                                            <input type="text" class="form-control" id="color"
                                                                name="color" value="{{ $car->color }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $car->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="photo">Photo</label>
                                                            <input type="file" class="form-control" id="photo"
                                                                name="photo">
                                                            @if ($car->photo)
                                                                <img src="{{ asset('storage/' . $car->photo) }}"
                                                                    alt="Car Photo" width="100" class="mt-3">
                                                            @endif
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
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $car->id }}">
                                        <i class="bi bi-trash3-fill"></i> Delete
                                    </button>

                                    <!-- Modal delete -->
                                    <div class="modal fade" id="deleteModal-{{ $car->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete
                                                        {{ $car->name }}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="text-danger">Are you sure you want to delete this model?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('admin.car.destroy', $car->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Add stock --}}
                                    <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal"
                                        data-bs-target="#stock-{{ $car->id }}">
                                        <i class="bi bi-file-earmark-plus-fill"></i> Add stock
                                    </button>

                                    <!-- Modal stock -->
                                    <div class="modal fade" id="stock-{{ $car->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add
                                                        {{ $car->name }} stock</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.car.stock', $car->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <label for="stock">Add to stock</label>
                                                        <input type="number" class="form-control" name="stock"
                                                            id="stock" value="{{ $car->stock }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-dark">Add</button>
                                                    </div>
                                                </form>
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
