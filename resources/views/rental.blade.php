@extends('layouts.homeheader')

@section('content')
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1>Rental Vehicles</h1>
            </div>
        </div>
    </section>
    <!-- Featured Vehicles section -->
    <section class="featured-vehicles" id="features">
        <div class="container">
            <h2>Cars on rent</h2><br><br>
            <div class="vehicle-list">
                <!-- Sample vehicle listings -->
                @if ($cars->isEmpty())
                    No cars for sale
                @else
                    @foreach ($cars as $car)
                        <div class="vehicle-item">
                            <img src="/storage/{{ $car->car->photo }}" alt="{{ $car->car->name }}">
                            <h3>{{ $car->car->name }}</h3>
                            <p>Price: ₹{{ $car->price_per_day }}</p>
                            <p>Description: {{ $car->note }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
