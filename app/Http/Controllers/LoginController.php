<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\DealerProfile;

class LoginController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email|unique:users,email',
        'password'   => [
            'required',
            'min:6',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
        ],
        'role_id'    => 'required',

        // Dealer conditional fields
        'city'  => 'required_if:role_id,2',
        'state' => 'required_if:role_id,2',
        'zip'   => 'required_if:role_id,2',
    ], [
        // Custom messages
        'first_name.required' => 'First name is required',
        'last_name.required'  => 'Last name is required',
        'email.required'      => 'Email is required',
        'email.email'         => 'Enter a valid email',
        'email.unique'        => 'Email already exists',

        'password.required'   => 'Password is required',
        'password.min'        => 'Password must be at least 6 characters',
        'password.regex'      => 'Password must contain uppercase, lowercase and number',

        'role_id.required'    => 'Please select a role',

        'city.required_if'    => 'City is required for dealer',
        'state.required_if'   => 'State is required for dealer',
        'zip.required_if'     => 'Zip is required for dealer',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role_id' => $request->role_id
    ]);

    // If dealer → create profile
    if ($request->role_id == 2) {
        DealerProfile::create([
            'user_id' => $user->id,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip
        ]);
    }

    return redirect('/login')->with('success', 'Registered successfully. Please login.');
}

public function login(Request $request)
{
    // ✅ Step 1: Validate fields
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email is required',
        'email.email'    => 'Enter a valid email',
        'password.required' => 'Password is required',
    ]);

    // ✅ Step 2: Check user
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Invalid email or password')->withInput();
    }

    // ✅ Step 3: Store session
    session(['user_id' => $user->id]);

    // ✅ Step 4: Role-based redirect
    if ($user->role->name == 'employee') {
        return redirect('/employee-dashboard');
    } elseif ($user->role->name == 'dealer') {
        return redirect('/dealer-dashboard');
    }

    return redirect('/login');
}

}
