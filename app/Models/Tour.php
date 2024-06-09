<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\TourImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'price',
        'number_of_participants',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function firstImage()
{
    return $this->hasOne(TourImage::class)->oldestOfMany();
}
}
