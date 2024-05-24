<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarTranssaction;
use App\Models\FeedBack;
use App\Models\Part;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $cars = Car::all();
        $parts = Part::all();
        return view("user.dashboard", compact('cars', 'parts'));
    }

    public function car(Car $car)
    {
        $car->load('feedbacks.user');
        return view('user.carpage', compact('car'));
    }

    public function cart(Car $car)
    {
        $user = auth()->user();
        CarTranssaction::create([
            'user_id' => $user->id,
            'car_id' => $car->id,
            'date' => Carbon::today(),
        ]);

        $car->stock = $car->stock - 1;
        $car->save();

        return back()->with('success', 'Car added');
    }

    public function feedback(Request $request, Car $car)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);
        FeedBack::create([
            'user_id' => auth()->user()->id,
            'car_id' => $car->id,
            'rating' => $request['rating'],
            'message' => $request['message']
        ]);

        return back()->with('success', 'Rating added');
    }

    public function services()
    {
        $services = Services::where('user_id', auth()->user()->id)->get();
        $cars = Car::all();
        return view('user.service', compact('services', 'cars'));
    }

    public function services_store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_description' => 'required',
            'date' => 'required',
            'location' => 'required',
        ]);

        Services::create([
            'user_id' => auth()->user()->id,
            'car_id' => $request->car_id,
            'service_description' => $request->service_description,
            'date' => $request->date,
            'location' => $request->location,
        ]);

        return back()->with('success', 'Service appointment created');
    }

    public function destroy($service)
    {
        Services::destroy($service);

        return back()->with('delete', 'Service appointment deleted');
    }
}
