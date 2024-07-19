<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllCheckList()
    {
        $checklists = Checklist::all();
        return response()->json($checklists);
    }

    public function createNewCheckList(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $checklist = Checklist::create([
            'name' => $request->name,
        ]);

        return response()->json($checklist, 201);
    }

    public function deleteCheckListByID($id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist) {
            return response()->json(['message' => 'Checklist not found'], 404);
        }

        $checklist->delete();
        return response()->json(['message' => 'Checklist deleted successfully']);
    }
}
