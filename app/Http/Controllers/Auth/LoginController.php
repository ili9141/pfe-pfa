<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Custom login logic (if you need more control)
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Redirect to the intended page or home
            return redirect()->intended($this->redirectTo);
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        // Store the user ID and user role in the session
        Session::put('user_id', $user->id);
        Session::put('user_role', $this->getUserRole($user)); // You can customize this logic based on your roles

        // Redirect to the index page after successful login
        return redirect()->route('index');
    }

    // Helper method to get the user's role
    protected function getUserRole($user)
    {
        // Assuming you have different roles (admin, professor, student)
        if ($user->admin) {
            return 'admin';
        } elseif ($user->professor) {
            return 'professor';
        } elseif ($user->student) {
            return 'student';
        }

        return 'guest'; // Fallback
    }
}
