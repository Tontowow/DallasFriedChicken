<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    protected $table = 'maps';

    protected $fillable = [
        'destinasi_id',
        'latitude',
        'longitude',
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

}
