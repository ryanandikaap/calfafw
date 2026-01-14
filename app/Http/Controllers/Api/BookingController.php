<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Booking::orderByDesc('id')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'treatment' => ['required', 'string', 'max:150'],
            'price' => ['required', 'integer', 'min:0'],
            'booking_date' => ['required', 'date'],
            'booking_time' => ['required'],
            'gender' => ['required', 'string', 'max:20'],
            'hairstylist' => ['nullable', 'string', 'max:150'],
            'note' => ['nullable', 'string'],
            'bukti' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $targetDir = public_path('uploads/bukti');

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $file->move($targetDir, $filename);
            $data['bukti'] = $filename;
        }

        $booking = Booking::create($data);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(
            Booking::findOrFail($id)
        );
    }
}
