<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Antrian;

class UserDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'antrian_id',
        'status_berkas',
        'status_baca',
        'status_pengiriman',
        'note'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    public function antrian()
    {
        return $this->belongsTo(Antrian::class);
    }
}
