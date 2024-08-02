<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ['car_id', 'user_id', 'start_date', 'end_date'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function returns()
    {
        return $this->hasMany(RentalReturn::class);
    }

    // public function returnsLog()
    // {
    //     return $this->hasMany(RentalReturn::class);
    // }
}
