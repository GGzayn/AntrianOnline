<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cities;
use App\Models\Antrian;

class Provinces extends Model
{
    use HasFactory;

    protected $fillable = [
        'province',
    ];

    public function city()
    {
        return $this->hasMany(Cities::class);
    }
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
