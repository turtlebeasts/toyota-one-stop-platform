@extends('layouts.homeheader')

@section('content')
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1>Amp Up Your Ownership</h1>
                <p>Access to all the tools and information for your Toyota—in one place.</p>
                <a href="#features" class="btn">Explore Now</a>
            </div>
        </div>
    </section>
    <!-- Featured Vehicles section -->
    <section class="featured-vehicles" id="features">
        <div class="container">
            <h2>Models</h2><br><br>
            <div class="vehicle-list">
                <!-- Sample vehicle listings -->
                @if ($cars->isEmpty())
                    No cars in showroom
                @else
                    @foreach ($cars as $car)
                        <div class="vehicle-item">
                            <img src="/storage/{{ $car->photo }}" alt="{{ $car->name }}">
                            <h3>{{ $car->name }}</h3>
                            <p>Price: ₹{{ $car->price }}</p>
                            <p>Year: {{ $car->year }}</p>
                            <p>Color: {{ $car->color }}</p>
                            {{-- <a href="details.html" class="btn">View Details</a> --}}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
