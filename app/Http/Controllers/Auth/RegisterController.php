<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Admin;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Major; // Import the Major model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Show the registration form and pass majors to the view
    public function showRegistrationForm()
    {
        $majors = Major::all(); // Fetch all majors from the database
        return view('auth.register', compact('majors'));  // Pass the $majors to the view
    }

    // Validation logic for registration form
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_role' => 'required|in:admin,professor,student',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|max:2048',
            // Add validation for major selection
            'major' => 'required_if:user_role,professor,student|exists:majors,id', // Ensure major is selected for professors and students
        ]);
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        // Create the user (generic fields shared by all roles)
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'cin' => $request->cin,
        ]);
        if ($user) {
            Log::info('User created successfully: ' . $user->id);
        } else {
            Log::error('Failed to create user');
        }
        // Process based on user role
        if ($request->user_role == 'admin') {
            Admin::create([
                'user_id' => $user->id,
                'lastname' => $user->lastname,
                'firstname' => $user->firstname,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'date_of_birth' => $user->date_of_birth,
                'cin' => $user->cin,
                'password_hash' => $user->password, // Store the hashed password
                'profile_picture_url' => $request->profile_picture ? $request->profile_picture->store('profile_pictures') : null,
            ]);
        } elseif ($request->user_role == 'professor') {
            Professor::create([
                'user_id' => $user->id,
                'lastname' => $user->lastname,
                'firstname' => $user->firstname,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'date_of_birth' => $user->date_of_birth,
                'cin' => $user->cin,
                'password_hash' => $user->password, // Store the hashed password
                'speciality' => $request->speciality,
                'major_id' => $request->major,  // Store selected major id
                'profile_picture_url' => $request->profile_picture ? $request->profile_picture->store('profile_pictures') : null,
            ]);
        } elseif ($request->user_role == 'student') {
            Student::create([
                'user_id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'password_hash' => $user->password, // Store the hashed password
                'date_of_birth' => $user->date_of_birth,
                'phone_number' => $user->phone_number,
                'cin' => $user->cin,
                'year' => $request->year,
                'major_id' => $request->major,  // Store selected major id
                'profile_picture_url' => $request->profile_picture ? $request->profile_picture->store('profile_pictures') : null,
            ]);
        }

        // Redirect after successful registration
        return redirect()->route('login');
    }
}
