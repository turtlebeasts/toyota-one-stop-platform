<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'year',
        'color',
        'description',
        'stock',
        'photo'
    ];

    public function feedbacks()
    {
        return $this->hasMany(FeedBack::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function transaction()
    {
        return $this->hasMany(CarTranssaction::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'vehicle_id');
    }
}
