<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Slider::query()->orderByDesc('id');

        if (request()->filled('status')) {
            $query->where('status', (string) request('status'));
        }

        return response()->json($query->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            Slider::findOrFail($id)
        );
    }
}
