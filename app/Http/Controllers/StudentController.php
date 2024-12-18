<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Get all students
    public function index()
    {
        return response()->json(Student::all());
    }

    // Create a new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'profile_picture_url' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:50',
            'year' => 'nullable|integer',
            'major' => 'nullable|string|max:255',
        ]);

        $validatedData['password_hash'] = Hash::make($validatedData['password']);
        unset($validatedData['password']); // Remove plain password

        $student = Student::create($validatedData);

        return response()->json($student, 201);
    }

    // Get student by ID
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // Update student data
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validatedData = $request->validate([
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:students,email,' . $id,
            'date_of_birth' => 'nullable|date',
            'phone_number' => 'nullable|string|max:20',
            'cin' => 'nullable|string|max:50',
            'year' => 'nullable|integer',
            'major' => 'nullable|string|max:255',
        ]);

        $student->update($validatedData);

        return response()->json($student);
    }

    // Delete student by ID
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }

    // Get student by email
    public function getStudentByEmail($email)
    {
        $student = Student::where('email', $email)->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }
}

