<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
        'created_at',
        'updated_at',
    ];

    public function tickets()
{
    return $this->hasMany(Ticket::class, 'destinasi_id');
}
public function ulasan()
{
    return $this->hasMany(Ulasan::class); // Asumsikan tabel ulasan menggunakan model Review
}
public function maps()
{
    return $this->hasMany(Map::class, 'destinasi_id');
}

}
