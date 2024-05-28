<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CarTranssaction;
use App\Models\ResellVehicle;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    public function appointment()
    {
        $appointments = Appointment::all();
        return view('admin.appointment', compact('appointments'));
    }

    public function update(Appointment $appointment)
    {
        $appointment->status = true;
        $appointment->save();

        return back()->with('success', 'Appointment scheduled');
    }

    public function buyer()
    {
        $transactions = CarTranssaction::paginate(5);
        return view('admin.car_transaction', compact('transactions'));
    }

    public function services()
    {
        $services = Services::all();
        $employees = User::where('type', 2)->get();
        return view('admin.service', compact('services', 'employees'));
    }

    public function assign(Request $request, Services $service)
    {

        $request->validate([
            'emp_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!User::where('id', $value)->where('type', 2)->exists()) {
                        $fail('The selected user is invalid or does not have the correct type.');
                    }
                },
            ],
        ]);

        $service->emp_id = $request['emp_id'];
        $service->save();

        return back()->with('success', 'Appointment scheduled');
    }

    public function resell()
    {
        $resellVehicles = ResellVehicle::all();
        return view('admin.vehicle_resell', compact('resellVehicles'));
    }

    public function approve_resell(ResellVehicle $vehicle)
    {
        $vehicle->approved = true;
        $vehicle->save();

        return back()->with('success', 'Vehicle approved for resell');
    }
}
