@extends('layouts.header')


@include('employee.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-dark text-light px-5">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5">
                    Hello {{ auth()->user()->name }}
                </h3>
                <p class="text-secondary fs-4">Welcome to Toyota team dashboard</p>
            </div>
        </div>
    </div>

    <div class="container shadow mt-5 bg-white py-5 px-5">
        <h3>Works assigned for you</h3>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                @if ($services->isEmpty())
                    <div class="alert alert-light">
                        No works assigned for you
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
                                        <img src="/storage/{{ $service->car->photo }}" alt="{{ $service->car->name }}"
                                            class="img-fluid"><br>
                                        <b>{{ $service->car->name }}: </b>
                                        <p>{{ $service->service_description }} </p>
                                        <b>Location: {{ $service->location }}</b>
                                        <p>
                                            <i class="bi bi-person-circle"></i> {{ $service->user->name }}<br>
                                            <i class="bi bi-telephone-fill"></i> {{ $service->user->phone }}
                                        </p>
                                    </td>
                                    <td>
                                        @if ($service->status)
                                            <p class="text-success"><i class="bi bi-check"></i> Completed</p>
                                        @else
                                            <p class="text-warning"><i class="bi bi-clock-history"></i> Pending</p>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $service->id }}">
                                            Mark as complete
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $service->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mark as complete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to mark it as complete? Once changed it cannot
                                                        be undone!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('employee.mark_complete', $service->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Yes</button>
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
