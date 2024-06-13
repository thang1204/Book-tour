<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address',
        'phone',
        'gender',
        'date_of_birth',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
