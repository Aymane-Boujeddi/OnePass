<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\AdressIp;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/valider-ip', function (Request $request) {
    $ip = $request->query('ip');

    $device = AdressIp::where('adressIP', $ip)->first();

    if ($device) {
        $device->etat = 'liste_blanche';
        $device->save();

        return "L'appareil a été autorisé.";
    }

    return "Aucune demande trouvée pour cette IP.";
});
