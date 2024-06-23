<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'address', 'stars', 'phone', 'description'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

}
