@extends('layouts.header')


@include('user.navbar')
@section('content')
    <div class="container mt-5 pt-5 pb-5 shadow bg-dark text-light px-5">
        <div class="row">
            <div class="col-12">
                <h3 class="display-5">
                    Hello {{ auth()->user()->name }}
                </h3>
                <p class="text-secondary fs-4">Welcome to Toyota one stop platform application</p>
            </div>
        </div>
    </div>

    <div class="container shadow mt-5 bg-white py-5 px-5">
        <h3>Our showroom</h3>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($cars as $key => $car)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="3000">
                                <img src="storage/{{ $car->photo }}" class="d-block w-100" alt="{{ $car->name }}"
                                    style="height: 15rem">
                                <div class="carousel-caption d-none d-md-block rounded"
                                    style="background-color: rgba(0, 0, 0, 0.5)">
                                    <h5>{{ $car->name }}</h5>
                                    <p>{{ $car->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <h3 class="display-3">“Built for a Better World”</h3>
                <p>Demonstrating Toyota’s dedication to environmental sustainability and social responsibility, this slogan
                    aligns with the company’s efforts in producing eco-friendly vehicles and promoting a better future.</p>
            </div>
        </div>

        <div class="row mt-5">
            @foreach ($cars as $car)
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <img src="storage/{{ $car->photo }}" alt="{{ $car->name }}" class="img img-fluid">
                            <h5 class="mt-2">{{ $car->name }} <small>{{ $car->color }}</small></h5>
                            <p>Built-model: {{ $car->year }}</p>
                            <p>$ {{ $car->price }}</p>
                            <p>In-stock: {{ $car->stock }}</p>
                            <p>{{ $car->description }}</p>
                            <a href="{{ route('user.car', $car->id) }}" class="btn btn-dark">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5 bg-dark text-light pb-5">
            <div class="col-12 mt-5 mb-5">
                <h3>Shop for vehicle parts</h3>
            </div>
            @foreach ($parts as $part)
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-dark text-light">
                            <img src="storage/{{ $part->photo }}" alt="{{ $part->name }}" class="img img-fluid">
                            <h5 class="mt-2">{{ $part->name }}</h5>
                            <p>$ {{ $part->price }}</p>
                            <p>{{ $part->description }}</p>
                            <a href="{{ route('user.part', $part->id) }}" class="btn btn-dark">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5 shadow">
            <div class="col-sm-12 col-md-6">
                <div class="card border-0 shadow bg-black text-light py-5">
                    <div class="card-body">
                        <div class="mt-3">
                            <h3 class="text-secondary">BOOK AN <span class="text-danger">APPOINTMENT</span></h3>
                        </div>
                        <form action="{{ route('appointment.store') }}" method="post">
                            @csrf
                            <div class="mt-3">
                                <label for="type" class="form-label">Appointment type</label>
                                <select name="type" id="type" class="form-control bg-dark text-light" required>
                                    <option value="">-SELECT-</option>
                                    <option value="1">TEST DRIVE</option>
                                    <option value="2">SERVICE APPOINTMENT</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="type" class="form-label">Select a vehicle</label>
                                <select name="car_id" id="type" class="form-control bg-dark text-light" required>
                                    <option value="">-Vehicle-</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}">
                                            {{ $car->name }} ({{ $car->color }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="date" class="form-control bg-dark text-light"
                                    required>
                            </div>
                            <div class="mt-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" name="time" id="time" class="form-control bg-dark text-light"
                                    required>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-danger" type="submit">SCHEDULE</button>
                                @if (session('success'))
                                    <div class="alert alert-success mt-2">
                                        {{ session('success') }} <br>
                                        Navigate <a href="{{ route('appointment.index') }}">here</a> to check your
                                        appointment
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
                </div>
            </div>
            <div class="col-sm-12 col-md-6 py-5">
                <h3 class="display-5">TOYOTA appointments</h3>
                <p class="fs-5">
                    Whether you're looking to experience the thrill of a new Toyota with a test drive or need professional
                    maintenance and service for your current vehicle, we've got you covered. Please fill out the form below
                    to book your preferred time slot. Our dedicated team is here to ensure a smooth and convenient process,
                    tailored to your needs. Once you submit the form, a member of our team will contact you to confirm your
                    appointment and provide any additional information you might need.

                    <br><b>Thank you for choosing Toyota. We look forward to serving you!</b>
                </p>
            </div>

        </div>
    </div>
@endsection
