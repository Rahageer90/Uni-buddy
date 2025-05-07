<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelRequest extends Model
{
    protected $table = 'travelRequests';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'travel_schedule_id',
        'status',
        'message',
        'is_read'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'studentID');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'studentID');
    }

    public function schedule()
    {
        return $this->belongsTo(ReturnSchedule::class, 'travel_schedule_id');
    }
}
