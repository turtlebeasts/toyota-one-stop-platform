@extends('layouts.header')

@include('admin.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-white px-5">
        <div class="row">
            <div class="col-12">
                <h3>Applied services</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
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
                @if ($services->isEmpty())
                    <div class="alert alert-primary">
                        <i class="bi bi-exclamation-circle"></i> No services till now
                    </div>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Assign</th>
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
                                        <b>User: {{ $service->user->email }} ({{ $service->user->name }})</b>
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
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                            data-bs-target="#delete-{{ $service->id }}">
                                            <i class="bi bi-person-circle"></i>
                                            {{ $service->emp_id == null ? 'Assign' : 'Re-assign' }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="delete-{{ $service->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Assign task
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.services.assign', $service->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <h6>
                                                                {{ $service->emp_id == null ? 'Assign task' : 'Re-assign task' }}
                                                                to
                                                            </h6>

                                                            <select name="emp_id" class="form-control">
                                                                <option value="">-SELECT-</option>
                                                                @foreach ($employees as $e)
                                                                    <option value="{{ $e->id }}">
                                                                        {{ $e->name }}</option>
                                                                @endforeach
                                                            </select>

                                                            {{ $service->emp_id !== null ? 'Currently assigned to ' . $service->employee->name : '' }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-dark">Confirm</button>
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
                @endif
            </div>
        </div>
    </div>
@endsection
