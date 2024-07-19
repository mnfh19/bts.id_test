<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChecklistItem;

class ChecklistItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllChecklistItemByChecklistId($checklistId)
    {
        $items = ChecklistItem::where('checklistId', $checklistId)->get();
        return response()->json($items);
    }

    public function createNewChecklistItemInChecklist(Request $request, $checklistId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $item = ChecklistItem::create([
            'checklistId' => $checklistId,
            'itemName' => $request->itemName,
        ]);

        return response()->json($item, 201);
    }

    public function getChecklistItemInChecklistByChecklistId($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklistId', $checklistId)
                             ->where('checklistItemId', $checklistItemId)
                             ->first();

        if (!$item) {
            return response()->json(['message' => 'Checklist item not found'], 404);
        }

        return response()->json($item);
    }

    public function updateStatusChecklistItemByChecklistItemId(Request $request, $checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklistId', $checklistId)
                             ->where('checklistItemId', $checklistItemId)
                             ->first();

        if (!$item) {
            return response()->json(['message' => 'Checklist item not found'], 404);
        }

        $item->status = !$item->status;
        $item->save();

        return response()->json($item);
    }

    public function deleteItemByChecklistItemId($checklistId, $checklistItemId)
    {
        $item = ChecklistItem::where('checklistId', $checklistId)
                             ->where('checklistItemId', $checklistItemId)
                             ->first();

        if (!$item) {
            return response()->json(['message' => 'Checklist item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Checklist item deleted successfully']);
    }

    public function renameItemByChecklistItemId(Request $request, $checklistId, $checklistItemId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $item = ChecklistItem::where('checklistId', $checklistId)
                             ->where('checklistItemId', $checklistItemId)
                             ->first();

        if (!$item) {
            return response()->json(['message' => 'Checklist item not found'], 404);
        }

        $item->itemName = $request->itemName;
        $item->save();

        return response()->json($item);
    }
}
