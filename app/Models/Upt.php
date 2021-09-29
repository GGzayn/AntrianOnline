<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Districts;
use App\Models\Loket;

class Upt extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_upt',
        'upt'
    ];

    public function district()
    {
        return $this->hasMany(Districts::class);
    }
    public function loket()
    {
        return $this->hasMany(Loket::class);
    }
}
