<?php

namespace App\Models;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'phone',
        'email',
        'bio'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
