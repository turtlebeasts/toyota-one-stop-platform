<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'note',
        'price_per_day'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'vehicle_id');
    }
}
