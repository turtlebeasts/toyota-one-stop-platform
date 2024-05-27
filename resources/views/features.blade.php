@extends('layouts.homeheader')

@section('content')
    <!-- Hero section -->
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1>Explore the Features of Toyota</h1>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature">
            <a href="spare_parts.html">
                <h2>Spare Parts Ordering</h2>
                <p>Order genuine Toyota spare parts with ease.</p>
            </a>
        </div>
        <div class="feature">
            <a href="maintenance_records.html">
                <h2>Online Maintenance Records</h2>
                <p>Access and manage your Toyota's maintenance records online.</p>
            </a>
        </div>
        <div class="feature">
            <a href="car_insurance.html">
                <h2>Car Insurance</h2>
                <p>Get insurance coverage for your Toyota vehicle through our platform.</p>
            </a>
        </div>
        <!-- Add more features here -->
    </section>
@endsection
