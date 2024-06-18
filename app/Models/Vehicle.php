<?php

namespace App\Models;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'model',
        'license_plate',
        'capacity',
        'driver_id'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
