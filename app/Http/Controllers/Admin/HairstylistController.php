<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hairstylist;
use Illuminate\Http\Request;

class HairstylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hairstylists = Hairstylist::orderBy('created_at', 'desc')->get();
        return response()->json($hairstylists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'specialization', 'experience']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/hairstylists'), $imageName);
            $data['image'] = '/uploads/hairstylists/' . $imageName;
        }

        $hairstylist = Hairstylist::create($data);

        return response()->json([
            'message' => 'Hairstylist created successfully',
            'hairstylist' => $hairstylist,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hairstylist = Hairstylist::findOrFail($id);
        return response()->json($hairstylist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hairstylist = Hairstylist::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'specialization', 'experience']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($hairstylist->image && file_exists(public_path($hairstylist->image))) {
                unlink(public_path($hairstylist->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/hairstylists'), $imageName);
            $data['image'] = '/uploads/hairstylists/' . $imageName;
        }

        $hairstylist->update($data);

        return response()->json([
            'message' => 'Hairstylist updated successfully',
            'hairstylist' => $hairstylist,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hairstylist = Hairstylist::findOrFail($id);

        // Delete image if exists
        if ($hairstylist->image && file_exists(public_path($hairstylist->image))) {
            unlink(public_path($hairstylist->image));
        }

        $hairstylist->delete();

        return response()->json([
            'message' => 'Hairstylist deleted successfully',
        ]);
    }
}
