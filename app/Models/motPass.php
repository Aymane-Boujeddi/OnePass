<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class motPass extends Model
{
    //
    protected $fillable = [
        'site_web',
        'identifiant_email',
        'motPassChiffre',
        'user_id'
    ];

    public function user(){
        $this->belongsTo(motPass::class);
    }

    
    
    
}
