<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)->get();
        return view('user.appointment', compact('appointments'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'type' => 'required|in:1,2',
            'car_id' => 'required|exists:cars,id'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Appointment::create($validated);

        return back()->with('success', 'Appointment scheduled');
    }

    public function destroy(Appointment $appointment)
    {
        Appointment::destroy($appointment->id);
        return back()->with('delete', 'Appointment canceled');
    }
}
