<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Torann\GeoIP\Facades\GeoIP;


class adressIP extends Model
{
    //
    protected $table = 'adress_ips'; 
    protected $fillable = [
        "adressIP",
        "nameAppareil",
        "etat",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public  static function verifierAppareil($Ip){
        return self::where('adressIP',$Ip)->where('etat','liste_blanche')->exists();
    }

    // composer require torann/geoip
    // php artisan vendor:publish --provider="Torann\GeoIP\GeoIPServiceProvider"

    public static  function verifierPays($Ip){
        $authorizedCountries = ['Morocco','Germany','United States'];
        $location = GeoIP::getlocation($Ip);

        $country = $location->country_name;
        return in_array($country,$authorizedCountries);
    }
}
