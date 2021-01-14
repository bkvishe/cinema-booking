<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;

    protected $table = 'theater';

    public function screens()
    {
        return $this->hasMany(TheaterScreen::class, 'theater_id', 'id');
    }
}
