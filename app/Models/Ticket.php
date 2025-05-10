<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destinasi_id',
        'nama',
        'jumlah',
        'tanggal',
        'total_harga',
        'status',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinasi()
{
    return $this->belongsTo(Destinasi::class, 'destinasi_id'); // Pastikan kolom foreign key benar
}

}
