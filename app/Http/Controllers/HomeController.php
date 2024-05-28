<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\ResellVehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('home', compact('cars'));
    }
    public function features()
    {
        return view('features');
    }
    public function news()
    {
        return view('news');
    }
    public function services()
    {
        $cars = Car::all();
        return view('services', compact('cars'));
    }

    public function used_cars()
    {
        $cars = ResellVehicle::all();
        return view('used', compact('cars'));
    }

    public function rentals()
    {
        $cars = Rental::all();
        return view('rental', compact('cars'));
    }
}
