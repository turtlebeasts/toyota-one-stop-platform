@extends('layouts.header')


@include('user.navbar')
@section('content')
    <div class="container bg-light mt-5 py-5">
        <div class="row">
            <div class="col-12">
                <h3>Sell a car</h3>
                @if ($resellVehicles->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> You have no cars on sale
                    </div>
                @endif
            </div>
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#sellModal">
                    + Sell a vehicle
                </button>

                @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                @endif
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

                <!-- Modal -->
                <div class="modal fade" id="sellModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Sell a vehicle</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('resell_vehicles.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="vehicle_name" class="form-label">Vehicle Name</label>
                                        <input type="text"
                                            class="form-control @error('vehicle_name') is-invalid @enderror"
                                            id="vehicle_name" name="vehicle_name" value="{{ old('vehicle_name') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="resell_price" class="form-label">Resell Price</label>
                                        <input type="number"
                                            class="form-control @error('resell_price') is-invalid @enderror"
                                            id="resell_price" name="resell_price" value="{{ old('resell_price') }}"
                                            min="0">
                                    </div>

                                    <div class="mb-3">
                                        <label for="condition" class="form-label">Condition</label>
                                        <input type="number" class="form-control @error('condition') is-invalid @enderror"
                                            id="condition" name="condition" value="{{ old('condition') }}" min="1"
                                            max="5">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                            id="photo" name="photo" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Sell</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vehicle Name</th>
                            <th>Resell Price</th>
                            <th>Condition</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Approved</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($resellVehicles->isEmpty())
                            <td colspan="8" class="text-center">
                                Nothing in the table
                            </td>
                        @else
                            @foreach ($resellVehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->vehicle_name }}</td>
                                    <td>₹ {{ $vehicle->resell_price }}</td>
                                    <td>{{ $vehicle->condition }}</td>
                                    <td>{{ $vehicle->description }}</td>
                                    <td>
                                        @if ($vehicle->photo)
                                            <img src="/storage/{{ $vehicle->photo }}" alt="Vehicle Photo" width="100">
                                        @else
                                            No Photo
                                        @endif
                                    </td>
                                    <td>{{ $vehicle->approved ? 'Approved' : 'Approval pending' }}</td>
                                    <td>{{ $vehicle->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $vehicle->id }}">
                                            Delete
                                        </button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $vehicle->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $vehicle->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $vehicle->id }}">
                                                            Delete
                                                            Confirmation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this vehicle listing?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="{{ route('resell_vehicles.destroy', $vehicle->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
