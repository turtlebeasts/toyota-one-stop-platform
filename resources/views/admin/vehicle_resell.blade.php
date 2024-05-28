@extends('layouts.header')


@include('admin.navbar')
@section('content')
    <div class="container bg-light mt-5 py-5">
        <div class="row">
            <div class="col-12">
                <h3>Sell a car</h3>
                @if ($resellVehicles->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> You have no cars for sale
                    </div>
                @endif
            </div>

            <div class="col-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
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
                                    <td>
                                        Name: {{ $vehicle->user->name }}<br>
                                        Contact: {{ $vehicle->user->phone }}, {{ $vehicle->user->email }}
                                    </td>
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
                                        @if ($vehicle->approved)
                                            <button type="button" class="btn btn-success" disabled>
                                                Approve
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#approveModal{{ $vehicle->id }}">
                                                Approve
                                            </button>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="approveModal{{ $vehicle->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $vehicle->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $vehicle->id }}">
                                                                Approval
                                                                Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to approve this vehicle? After approval
                                                            this
                                                            vehicle will show up on the resell vehicle page.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <form
                                                                action="{{ route('admin.approve_resell', $vehicle->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn btn-success">Approve</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
