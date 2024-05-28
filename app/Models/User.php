<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cars()
    {
        return $this->hasManyThrough(Car::class, CarTranssaction::class, 'user_id', 'id', 'id', 'car_id');
    }

    public function parts()
    {
        return $this->hasManyThrough(Part::class, PartTransaction::class, 'user_id', 'id', 'id', 'part_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
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
    public function resell()
    {
        return $this->hasMany(ResellVehicle::class);
    }
}
