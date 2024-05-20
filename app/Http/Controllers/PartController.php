<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::all();
        return view('admin.part', compact('parts'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);

        // Upload the photo
        $photo = $request->file('photo');
        $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
        $photoPath = $photo->storeAs('part_photos', $photoName, 'public');

        // Create a new car instance
        $car = new Part;
        $car->name = $request->name;
        $car->price = $request->price;
        $car->description = $request->description;
        $car->photo = $photoPath;
        $car->save();

        // Redirect the user after adding the car
        return redirect()->back()->with('success', 'Part added to showroom!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $car = Part::findOrFail($id);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('part_photos', $photoName, 'public');
            $car->photo = $photoPath;
        }

        $car->name = $request->name;
        $car->price = $request->price;
        $car->description = $request->description;
        $car->save();

        return redirect()->back()->with('success', 'Model updated successfully.');
    }

    public function destroy($id)
    {
        $parts = Part::findOrFail($id);
        if ($parts->photo) {
            Storage::disk('public')->delete($parts->photo);
        }
        $parts->delete();

        return redirect()->back()->with('success', 'Part deleted successfully.');
    }

    public function stock(Request $request, Part $part)
    {
        $request->validate(['stock' => 'required|gt:0']);

        $part->stock = $request->stock;
        $part->save();

        return back()->with('success', 'Stock adjusted!');
    }
}
