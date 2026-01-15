<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::orderBy('created_at', 'desc')->get();
        return response()->json($treatments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description', 'price']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/treatments'), $imageName);
            $data['image'] = '/uploads/treatments/' . $imageName;
        }

        $treatment = Treatment::create($data);

        return response()->json([
            'message' => 'Treatment created successfully',
            'treatment' => $treatment,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $treatment = Treatment::findOrFail($id);
        return response()->json($treatment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $treatment = Treatment::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description', 'price']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($treatment->image && file_exists(public_path($treatment->image))) {
                unlink(public_path($treatment->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/treatments'), $imageName);
            $data['image'] = '/uploads/treatments/' . $imageName;
        }

        $treatment->update($data);

        return response()->json([
            'message' => 'Treatment updated successfully',
            'treatment' => $treatment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $treatment = Treatment::findOrFail($id);

        // Delete image if exists
        if ($treatment->image && file_exists(public_path($treatment->image))) {
            unlink(public_path($treatment->image));
        }

        $treatment->delete();

        return response()->json([
            'message' => 'Treatment deleted successfully',
        ]);
    }
}
