@extends('layouts.homeheader')

@section('content')
    <!-- Hero section -->
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1></h1>
                <p></p>

            </div>
        </div>
    </section>

    <!-- News section -->
    <section class="news">
        <div class="container">
            <h2>Latest News</h2>

            <iframe src="https://global.toyota/en/newsroom/" frameborder="0" width="100%" height="600"
                id="newsFrame"></iframe>
        </div>
    </section>


    <style>
        #newsFrame .header {
            display: none;
        }

        #newsFrame .footer {
            display: none;
        }

        #newsFrame .navbar {
            display: none;
        }
    </style>
@endsection
