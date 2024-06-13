<?php

namespace App\Models;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'image',
    ];

    public function tours()
    {
        return $this->belongsTo(Tour::class);
    }
}
