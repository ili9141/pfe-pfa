<?php
namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    // Retrieve all majors
    public function index()
    {
        $majors = Major::all(['id', 'majorName']);
        return response()->json($majors);
    }

    // Retrieve a major by its ID
    public function show($id)
    {
        $major = Major::find($id, ['id', 'majorName']);
        if (!$major) {
            return response()->json(['message' => 'Major not found'], 404);
        }
        return response()->json($major);
    }
}
