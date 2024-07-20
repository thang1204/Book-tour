<?php

namespace App\Models;

use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\TourGuide;
use App\Models\TourImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'hotel_id',
        'vehicle_id',
        'guide_id',
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

    public function tourDates()
    {
        return $this->hasMany(TourDate::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function firstImage()
    {
        return $this->hasOne(TourImage::class)->oldestOfMany();
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function guide()
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function Vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    
}
