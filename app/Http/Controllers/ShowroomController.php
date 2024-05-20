<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShowroomController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars', compact('cars'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);

        // Upload the photo
        $photo = $request->file('photo');
        $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
        $photoPath = $photo->storeAs('car_photos', $photoName, 'public');

        // Create a new car instance
        $car = new Car;
        $car->name = $request->name;
        $car->price = $request->price;
        $car->year = $request->year;
        $car->color = strtoupper($request->color);
        $car->description = $request->description;
        $car->photo = $photoPath;
        $car->save();

        // Redirect the user after adding the car
        return redirect()->back()->with('success', 'Car added to showroom!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $car = Car::findOrFail($id);

        // Upload the photo if provided
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('car_photos', $photoName, 'public');
            $car->photo = $photoPath;
        }

        // Update the car instance
        $car->name = $request->name;
        $car->price = $request->price;
        $car->year = $request->year;
        $car->color = $request->color;
        $car->description = $request->description;
        $car->save();

        // Redirect the user after updating the car
        return redirect()->back()->with('success', 'Model updated successfully.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        if ($car->photo) {
            Storage::disk('public')->delete($car->photo);
        }
        $car->delete();

        return redirect()->back()->with('success', 'Car deleted successfully.');
    }

    public function stock(Request $request, Car $car)
    {
        $request->validate(['stock' => 'required|gt:0']);

        $car->stock = $request->stock;
        $car->save();

        return back()->with('success', 'Stock adjusted!');
    }
}
