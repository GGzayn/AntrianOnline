<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Districts;
use App\Models\Antrian;

class Urbans extends Model
{
    use HasFactory;

    protected $fillable = [
        'urban',
        'district_id'
    ];

    public function district()
    {
        return $this->belongsTo(Districts::class);
    }
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }
}
