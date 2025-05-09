<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamedNotification extends Model
{
    protected $fillable = ['user_id', 'notification_id'];


    /**
     * Relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
