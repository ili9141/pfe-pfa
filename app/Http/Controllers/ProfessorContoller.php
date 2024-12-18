<?php
namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    // Show all professors
    public function index()
    {
        $professors = Professor::all();
        return response()->json($professors);
    }

    // Show a single professor
    public function show($id)
    {
        $professor = Professor::find($id);
        return response()->json($professor);
    }

    // Create a new professor
    public function store(Request $request)
    {
        $professor = Professor::create($request->all());
        return response()->json($professor, 201);
    }

    // Update a professor
    public function update(Request $request, $id)
    {
        $professor = Professor::find($id);
        if ($professor) {
            $professor->update($request->all());
            return response()->json($professor);
        } else {
            return response()->json(['message' => 'Professor not found'], 404);
        }
    }

    // Delete a professor
    public function destroy($id)
    {
        $professor = Professor::find($id);
        if ($professor) {
            $professor->delete();
            return response()->json(['message' => 'Professor deleted successfully']);
        } else {
            return response()->json(['message' => 'Professor not found'], 404);
        }
    }
}
