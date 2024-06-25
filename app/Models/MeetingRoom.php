<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    use HasFactory;

    // INDICO I CAMPI FILLABLE
    protected $fillable = ['name', 'description', 'slug', 'num_of_places_available', 'cover_image'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
