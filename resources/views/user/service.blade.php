@extends('layouts.header')

@include('user.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-white px-5">
        <div class="row">
            <div class="col-12">
                <h3>Applied services</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <form action="{{ route('services.store') }}" method="post">
                    @csrf
                    <div class="mt-3">
                        <label for="car_id">Select Vehicle</label>
                        <select name="car_id" id="car_id" class="form-control">
                            <option value="">-SELECT-</option>
                            @foreach ($cars as $car)
                                <option value="{{ $car->id }}">{{ $car->name }} ({{ $car->color }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="service_description">Define your service</label>
                        <textarea name="service_description" id="service_description" cols="3" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="location">Add the location</label>
                        <input type="text" name="location" id="location" class="form-control">
                    </div>
                    <div class="mt-3">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                    <div class="mt-3">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('delete'))
                            <div class="alert alert-danger">
                                {{ session('delete') }}
                            </div>
                        @endif
                        @if ($errors->all())
                            <ul class="alert alert-danger mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-8">
                @if ($services->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> You haven't applied for any services
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        <img src="/storage/{{ $service->car->photo }}" class="img-fluid"
                                            alt="{{ $service->car->name }}" width="300"><br>
                                        <b>Vehicle {{ $service->car->name }} ({{ $service->car->color }})</b>
                                        <p>Service description: <br>{{ $service->service_description }}</p>
                                    </td>
                                    <td>
                                        @if ($service->status)
                                            <p class="text-success">Completed</p>
                                        @else
                                            <p class="text-warning">Pending</p>
                                            {{ $service->emp_id !== null ? 'Currently assigned to ' . $service->employee->name : '' }}
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-{{ $service->id }}">
                                            Cancel
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $service->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cancel
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">Are you sure you want to cancel this
                                                            appointment?</p><br>
                                                        <div class="alert alert-danger">
                                                            Vehicle: {{ $service->car->name }}
                                                            ({{ $service->car->color }})
                                                            <br>
                                                            Description: {{ $service->service_description }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('services.destroy', $service->id) }}"
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
                @endif
            </div>
        </div>
    </div>
@endsection
