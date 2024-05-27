@extends('layouts.homeheader')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('G:/car/t1.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }

        .submission-form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .submission-form label {
            font-weight: bold;
        }

        .submission-form input[type="text"],
        .submission-form input[type="number"],
        .submission-form select,
        .submission-form textarea,
        .submission-form input[type="file"],
        .submission-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, 0.95);
            color: #333;
        }

        .submission-form textarea {
            height: 100px;
        }

        .submission-form .submit-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .submission-form .submit-button:hover {
            background-color: #45a049;
        }

        .hidden {
            display: none;
        }

        #confirmationMessage {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <section class="hero" style="background-image: url('assets/t1.jpg');">
        <div class="container">
            <div class="hero-content">
                <h1>Services</h1>
                <p></p>

            </div>
        </div>
    </section>
    <h2>Submit Car Details</h2>

    <form id="carForm" class="submission-form" style="margin-bottom: 2rem" action="{{ route('login.view') }}#appointment"
        method="get">
        <label for="carModel">Car Model:</label><br>
        <input type="text" id="carModel" name="carModel" required><br>

        <label for="carYear">Car Year:</label><br>
        <input type="number" id="carYear" name="carYear" min="1900" max="2099" required><br>

        <label for="carRegistration">Car Registration:</label><br>
        <input type="text" id="carRegistration" name="carRegistration" required><br>

        <label for="serviceType">Service Type:</label><br>
        <select id="serviceType" name="serviceType" required>
            <option value="" disabled selected>Select Service Type</option>
            <option value="modification">Modification</option>
            <option value="repair">Repair</option>
            <option value="service">Service</option>
        </select><br>

        <label for="appointmentDate">Preferred Appointment Date:</label><br>
        <input type="date" id="appointmentDate" name="appointmentDate" required><br>

        <label for="appointmentTime">Preferred Appointment Time:</label><br>
        <input type="time" id="appointmentTime" name="appointmentTime" required><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location"><br>

        <label for="description">Service Description:</label><br>
        <textarea id="description" name="description"></textarea><br>

        <label for="uploadFile">Upload Files:</label><br>
        <input type="file" id="uploadFile" name="uploadFile" accept="image/*, .pdf"><br><br>
        <button type="submit" class="submit-button">Submit</button>
    </form>
@endsection
