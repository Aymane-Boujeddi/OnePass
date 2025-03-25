<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class adressIP extends Model
{
    //
    protected $fillable = [
        "adressIP",
        "nameAppareil",
        "etat",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
