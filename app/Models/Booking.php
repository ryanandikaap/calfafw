<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name',
        'treatment',
        'price',
        'booking_date',
        'booking_time',
        'gender',
        'hairstylist',
        'note',
        'bukti',
    ];
}
