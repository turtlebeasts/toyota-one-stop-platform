<?php

namespace App\Http\Controllers;

use App\Models\ResellVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResellController extends Controller
{
    public function index()
    {
        $resellVehicles = ResellVehicle::where('user_id', auth()->user()->id)->get();
        return view('user.sell_cars', compact('resellVehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_name' => 'required|string|max:255',
            'resell_price' => 'required|integer|min:0',
            'condition' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = $request->file('photo');
        $filename = Str::random(40) . '.' . $photo->getClientOriginalExtension();
        $path = $photo->storeAs('photos', $filename, 'public');

        ResellVehicle::create([
            'user_id' => auth()->user()->id,
            'vehicle_name' => $request['vehicle_name'],
            'resell_price' => $request['resell_price'],
            'condition' => $request['condition'],
            'description' => $request['description'],
            'photo' => $path,
        ]);

        return redirect()->back()->with('success', 'Vehicle resell listing created successfully.');
    }

    public function destroy($id)
    {
        $vehicle = ResellVehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->back()->with('delete', 'Vehicle resell listing deleted.');
    }
}
