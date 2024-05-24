<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'time',
        'price',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
