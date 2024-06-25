<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // INDICO I CAMPI FILLABLE
    protected $fillable = ['meeting_room_id', 'title', 'description', 'slug', 'start_date','end_date', 'cover_image'];

    public function meetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class);
    }
}
