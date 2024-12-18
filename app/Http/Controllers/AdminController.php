<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Create a new admin
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'date_of_birth' => 'required|date',
            'cin' => 'required|string|max:20',
            'email' => 'required|email|unique:admins',
            'profile_picture_url' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        $validatedData['password_hash'] = Hash::make($validatedData['password']);
        unset($validatedData['password']);

        Admin::create($validatedData);

        return response()->json(['message' => 'Admin created successfully'], 201);
    }

    // Get admin by email
    public function showByEmail($email)
    {
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }
        return response()->json($admin);
    }

    // Login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password_hash)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }

        Session::put('admin_id', $admin->id);

        return response()->json(['message' => 'Login successful', 'admin' => $admin]);
    }
}
