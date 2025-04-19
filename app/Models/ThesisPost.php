<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisPost extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'posted_by', 'department', 'thesis_topic', 'thesis_field', 'details'
    ];

    /**
     * Get the user that posted this thesis post.
     * 
     * This defines the inverse of the one-to-many relationship between ThesisPost and User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    /**
     * Get the requests associated with this thesis post.
     * 
     * This defines the one-to-many relationship between ThesisPost and ThesisRequest.
     */
    public function requests()
    {
        return $this->hasMany(ThesisRequest::class, 'post_id');
    }

    /**
     * Retrieve a collection of all requests for this thesis post.
     * 
     * If you want to fetch requests alongside a thesis post, you can use this method.
     */
    public function allRequests()
    {
        return $this->requests()->get(); // Directly retrieves all associated requests
    }
}
