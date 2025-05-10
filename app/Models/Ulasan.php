<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = "ulasan";
    protected $fillable = ["ulasan", "user_id", "destinasi_id"];
    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
