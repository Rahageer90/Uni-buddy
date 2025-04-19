<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisPost extends Model
{
    use HasFactory;


    protected $fillable = [
        'posted_by', 'department', 'thesis_topic', 'thesis_field', 'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

   
    public function requests()
    {
        return $this->hasMany(ThesisRequest::class, 'post_id');
    }

    
    public function allRequests()
    {
        return $this->requests()->get(); 
    }
}
