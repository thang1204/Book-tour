<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'avatar', 'phone',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
