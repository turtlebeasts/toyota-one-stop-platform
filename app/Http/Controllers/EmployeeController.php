<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $users = User::where('type', '2')->get();
        return view("admin.employee", compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'photo' => 'nullable|image|max:700',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        $user = new User;
        $user->type = 2;
        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('photos', $photoName, 'public');
            $user->photo = $photoPath;
        }

        $user->email = $request->email;
        $user->password = Hash::make($request->phone);
        $user->save();

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function edit(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $user->id,
            'photo' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->phone);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::random(40) . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('photos', $photoName, 'public');
            $user->photo = $photoPath;
        }

        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function dashboard()
    {
        $services = Services::where('emp_id', auth()->user()->id)->get();
        return view('employee.dashboard', compact('services'));
    }

    public function mark_complete(Services $service)
    {
        $service->status = true;
        $service->save();

        return redirect()->back()->with('success', 'Task completed');
    }

    public function account_view()
    {
        return view('employee.password');
    }

    public function set_password(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if (Hash::check(trim($request->current_password), $user->password)) {
            $user->password = $request->password;
            $user->email_verified_at = Carbon::now();
            $user->save();
            Auth::login($user);
            return back()->with('success', 'Password Changed');
        } else {
            return back()->with('error', 'Invalid current password entered');
        }
    }
}
