<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Major;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = Admin::where('email', $request->email)->first()
            ?? Professor::where('email', $request->email)->first()
            ?? Student::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session(['user_type' => class_basename($user)]);
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        $majors = Major::all();  // Fetch all majors from the database
        return view('auth.register', compact('majors'));  // Pass the $majors variable to the view
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email|unique:professors,email|unique:students,email',
            'password' => 'required|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validation for profile picture
        ]);

        $user = null;
        $role = $request->user_role;

        // Handle profile picture upload
        $profilePictureUrl = null;
        if ($request->hasFile('profile_picture')) {
            $profilePictureUrl = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create the user based on the selected role
        if ($role == 'admin') {
            $user = Admin::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'cin' => $request->cin,
                'profile_picture_url' => $profilePictureUrl,  // Save the profile picture URL
            ]);
        } elseif ($role == 'professor') {
            $user = Professor::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'cin' => $request->cin,
                'profile_picture_url' => $profilePictureUrl,  // Save the profile picture URL
            ]);
        } elseif ($role == 'student') {
            $user = Student::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone_number' => $request->phone_number,
                'date_of_birth' => $request->date_of_birth,
                'cin' => $request->cin,
                'profile_picture_url' => $profilePictureUrl,  // Save the profile picture URL
            ]);
        }

        // If user creation is successful, log them in
        if ($user) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Unable to register user']);
    }
}
