<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'returnSchedule';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'studentID',
        'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat',
        'toDest',
        'prefVehicle'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'studentID', 'studentID');
    }

    public function travelRequests()
    {
        return $this->hasMany(TravelRequest::class, 'travel_schedule_id');
    }
}
