<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota Car Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-CT0DAc4V6CzUVFxkzC5LpNKi3sdzK1qrR2qetB4VFX+2xZK+NIXPQ5lm6UBJXy9RuXPrpouBqgjZwR6EMZ9mYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="rt.css">
    <style>
        /* Global styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            font-weight: 600;
        }

        p {
            margin: 0;
            line-height: 1.6;
        }

        /* Navbar styles */
        .navbar {
            background-color: rgba(34, 34, 34, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            padding: 10px 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-nav li {
            margin-right: 20px;
        }

        .navbar-nav li:last-child {
            margin-right: 0;
        }

        .navbar-nav a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s;
            text-shadow: 0 0 10px #fff, 0 0 20px rgb(210, 210, 245);
        }

        .navbar-nav a:hover {
            color: rgb(164, 192, 230);
        }

        /* Hero section styles */
        .hero {
            background: url('t1.jpg') center/cover;
            height: 50vh;
            position: relative;
            overflow: hidden;
            background-position: center 20%;
            z-index: 1;
        }

        .hero-content {
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 2;
            margin-top: 159px;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .hero button {
            padding: 10px 20px;
            border: none;
            background-color: #f00;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .hero button:hover {
            background-color: #d00;
        }

        /* Features section styles */
        .features {
            background-color: #f9f9f9;
            padding: 80px 0;
            text-align: center;
        }

        .feature-item {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-item i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #f00;
        }

        .feature-item h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #333;
        }

        .feature-item p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #666;
        }


        /* Online Booking section styles */
        .online-booking {
            padding: 40px 0;
            text-align: center;
        }

        .booking-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            background-color: #f00;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #d00;
        }


        /* Featured Vehicles section styles */
        .featured-vehicles {
            padding: 80px 0;
            text-align: center;
        }

        .vehicle-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .vehicle-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .vehicle-item:hover {
            transform: translateY(-5px);
        }

        .vehicle-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .vehicle-item h3 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #333;
        }

        .vehicle-item p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #666;
        }

        .vehicle-item .btn {
            padding: 10px 20px;
            border: none;
            background-color: #f00;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .vehicle-item .btn:hover {
            background-color: #d00;
        }

        /* Footer styles */
        footer {
            background-color: #222;
            color: #fff;
            padding: 50px 0;
            text-align: center;
        }

        footer p {
            font-size: 1.2rem;
        }

        footer a {
            color: #f00;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #d00;
        }

        /* Login form */
        .login-form-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 320px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s ease-out;
            z-index: 3;
        }

        .login-form-container.active {
            opacity: 1;
            pointer-events: auto;
        }

        .login-form-container h2 {
            font-size: 22px;
            color: #0b0217;
            margin-bottom: 20px;
        }

        .login-form-container .form-group {
            margin-bottom: 20px;
        }

        .login-form-container .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333;
        }

        .login-form-container .form-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .login-form-container .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            background-color: #f00;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-form-container .btn:hover {
            background-color: #d00;
        }

        /* News section styles */
        .news {
            padding: 80px 0;
            text-align: center;
        }

        .news .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .news h2 {
            font-size: 2rem;
            margin-bottom: 40px;
        }

        .news-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .news-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .news-item:hover {
            transform: translateY(-5px);
        }

        .news-item h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .news-item p {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }

        .news-item .btn {
            padding: 10px 20px;
            border: none;
            background-color: #f00;
            color: #fff;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .news-item .btn:hover {
            background-color: #d00;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .feature {
            width: 300px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature h2 {
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .feature p {
            color: #666;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <img src="assets/logot.png" alt="Toyota Car Logo">
            </div>
            <ul class="navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/features">Features</a></li>
                <li><a href="/services">Services</a></li>
                <li><a href="/used-cars">Used Cars</a></li>
                <li><a href="/rentals">Rental Cars</a></li>
                <li><a href="/news">News</a></li>
            </ul>

            <form action="/logins" method="get">
                <button class="button" id="form-open">Login</button>
            </form>

        </div>
    </nav>

    @yield('content')
    <footer>
        <div class="container">
            <p>&copy; 2024 Toyota Car Website. All rights reserved. | Designed by <a href="#"
                    style="color: #ff9800;">Hrisikesh Gogoi</a></p>
        </div>
    </footer>

</body>

</html>
