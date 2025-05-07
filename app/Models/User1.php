<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'studentID';
    public $incrementing = false;
    protected $keyType = 'bigInteger';

    protected $fillable = [
        'studentID',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function returnSchedules()
    {
        return $this->hasMany(ReturnSchedule::class, 'studentID', 'studentID');
    }

    public function sentRequests()
    {
        return $this->hasMany(TravelRequest::class, 'sender_id', 'studentID');
    }

    public function receivedRequests()
    {
        return $this->hasMany(TravelRequest::class, 'receiver_id', 'studentID');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'studentID');
    }
}
