<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hairstylist extends Model
{
    protected $fillable = [
        'name',
        'title',
        'photo',
    ];
}
