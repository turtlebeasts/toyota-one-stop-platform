@extends('layouts.homeheader')

@section('content')
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1>Refurbished Vehicles</h1>
            </div>
        </div>
    </section>
    <!-- Featured Vehicles section -->
    <section class="featured-vehicles" id="features">
        <div class="container">
            <h2>Cars on sale</h2><br><br>
            <div class="vehicle-list">
                <!-- Sample vehicle listings -->
                @if ($cars->isEmpty())
                    No cars for sale
                @else
                    @foreach ($cars as $car)
                        <div class="vehicle-item">
                            <img src="/storage/{{ $car->photo }}" alt="{{ $car->name }}">
                            <h3>{{ $car->vehicle_name }}</h3>
                            <p>Price: ₹{{ $car->resell_price }}</p>
                            @php
                                $x = 0;
                                while ($x < $car->condition) {
                                    echo "<i class='bi bi-star-fill'></i> ";
                                    $x++;
                                }
                            @endphp
                            <p>Owner: {{ $car->user->name }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
