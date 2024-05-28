<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $rentals = Rental::all();
        return view('admin.rental', compact('cars', 'rentals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:cars,id',
            'price_per_day' => 'required|min:0'
        ]);

        Rental::create([
            'vehicle_id' => $request->vehicle_id,
            'price_per_day' => $request->price_per_day,
            'note' => $request->note
        ]);

        return back()->with('success', 'Vehicle added for rental service!');
    }

    public function destroy($id)
    {
        $vehicle = Rental::findOrFail($id);
        $vehicle->delete();

        return redirect()->back()->with('delete', 'Vehicle resell listing deleted.');
    }
}
