<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalReturn extends Model
{
    protected $table = 'returns';  // Explicitly specify the table name

    protected $fillable = ['rental_id', 'return_date', 'total_cost'];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    

}

