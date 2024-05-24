@extends('layouts.header')


@include('admin.navbar')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h6 class="display-6">Appointments</h6>

                        @if (session('delete'))
                            <div class="alert alert-danger">
                                {{ session('delete') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($appointments->isEmpty())
                            <p class="text-center mt-5">You do not have any appointments</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Appointment details</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>
                                                <b>User: {{ $appointment->user->name }}
                                                    ({{ $appointment->user->email }})
                                                </b><br>
                                                {{ $appointment->type == 1 ? 'Test Drive' : 'Service appointment' }}<br>
                                                Vehicle: {{ $appointment->car->name }}<br>
                                                Date & Time: {{ $appointment->date }} {{ $appointment->time }}<br>
                                                <img src="/storage/{{ $appointment->car->photo }}"
                                                    alt="{{ $appointment->car->name }}" class="img-fluid" width="250">
                                            </td>
                                            <td>
                                                @if ($appointment->status)
                                                    <p class="text-success">Approved / Completed</p>
                                                @else
                                                    <p class="text-warning">Pending</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($appointment->status)
                                                    <p class="text-success">Scheduled at <b>{{ $appointment->date }}
                                                            {{ $appointment->time }}</b></p>
                                                @else
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#delete-{{ $appointment->id }}">
                                                        Schedule
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete-{{ $appointment->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Cancel
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="text-dark">Are you sure you want to schedule
                                                                        this
                                                                        appointment?</p><br>
                                                                    <div class="alert alert-success">
                                                                        <b>Date & Time: {{ $appointment->date }}
                                                                            {{ $appointment->time }}</b><br>
                                                                        {{ $appointment->type == 1 ? 'Test Drive' : 'Service appointment' }}<br>
                                                                        Vehicle: {{ $appointment->car->name }}<br>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <form
                                                                        action="{{ route('admin.appointment.update', $appointment->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit"
                                                                            class="btn btn-success">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
