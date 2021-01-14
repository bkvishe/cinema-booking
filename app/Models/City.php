<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city';

    public function theaters()
    {
        return $this->hasMany(Theater::class, 'city_id', 'id');
    }

    public function films()
    {
        return $this->hasMany(Theater::class, 'city_id', 'id');
    }
}