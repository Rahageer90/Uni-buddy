<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThesisRequest extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'sender_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function post()
    {
        return $this->belongsTo(ThesisPost::class, 'post_id');
    }
}
