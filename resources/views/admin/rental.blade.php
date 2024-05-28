@extends('layouts.header')

@include('admin.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-light">
        <div class="row">
            <div class="col-12">
                <h6 class="display-6">
                    Rental service
                </h6>
                <p>Manage your car rents</p>
            </div>
            <div class="col-12">
                <h3>Sell a car</h3>
                @if ($rentals->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> You have no cars for rent
                    </div>
                @endif
            </div>
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#rentalModal">
                    Rent a car
                </button>

                <!-- Modal -->
                <div class="modal fade" id="rentalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rent</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.rental.store') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="car">Select a car</label>
                                        <select name="vehicle_id" id="car" class="form-control">
                                            <option value="">-SELECT-</option>
                                            @foreach ($cars as $car)
                                                <option value="{{ $car->id }}">{{ $car->name }}
                                                    ({{ $car->color }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price">Price per day</label>
                                        <input type="number" name="price_per_day" id="price" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="note">Add a description</label>
                                        <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
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
            @foreach ($rentals as $car)
                <div class="col-sm-12 col-md-3">
                    <div class="card border-0">
                        <div class="card-body">
                            <img src="/storage/{{ $car->car->photo }}" alt="{{ $car->car->name }}" class="img-fluid">
                            <h6>{{ $car->car->name }} ({{ $car->car->color }})</h6>
                            <p>Per day rent: ₹ {{ $car->price_per_day }}</p>
                            <p>Description : {{ $car->note }}</p>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $car->id }}">
                                Delete
                            </button>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $car->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $car->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $car->id }}">
                                                Delete
                                                Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this rental service?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.rental.destroy', $car->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
