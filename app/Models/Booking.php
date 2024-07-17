<?php

namespace App\Models;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id',
        'start_date',
        'number_of_adults',
        'number_of_children',
        'total_price',
        'booking_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->order_code = Str::random(10);
        });
    }
}
