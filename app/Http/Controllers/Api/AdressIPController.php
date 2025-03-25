<?php

namespace App\Http\Controllers\Api;

use App\Models\adressIP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\motPass;
use Torann\GeoIP\Facades\GeoIP;

class AdressIPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return adressIP::all();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(adressIP $adressIP)
    {
        //
        return $adressIP;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(adressIP $adressIP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, adressIP $adressIP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Ip = adressIP::find($id);
        if(!$Ip){
            return response()->json([
                'Error' => 'This Ip is not found'
            ],404);
        }
        $Ip->delete();
        return response()->json([
            'Success' => 'Ip deleted successfully'
        ],200);
    }


    public function getWhiteList(){
        $white = motPass::where('etat','liste_blanche')->get();
        return response()->json([
            'White list Ips' => $white
        ],201);
    }


    public function getBlackList(){
        $black = motPass::where('etat','liste_noir')->get();
        return response()->json([
            'Black list Ips' => $black
        ],201);
    }

    public function AjouterListeBlanche(Request $request){
        $validate = $request->validate([
            'ip' => ['required', 'numeric'],
            'user_id' => ['required','exist:users,id']
        ]);
        adressIP::create([
            'adressIP' => $request->ip,
            'nameAppareil' => $request->name_appareil,
            'etat' => 'liste_blanche',
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'message' => 'Your Ip has been confirmed'
        ],200);
    }


    public function ajouterListeNoir(Request $request){
        $validate = $request->validate([
            'ip' => ['required','numeric'],
            'user_id' => ['required', 'exist:users,id'],
            'name_appareil' => ['required','string']
        ]);
        adressIP::create([
            'adressIP' => $request->ip,
            'nameAppareil' => $request->name_appareil,
            'etat' => 'liste_noir',
            'user_id' => $request->user_id
        ]);
        return response()->json([
            'message' => 'This Ip is now banned'
        ],200);
    }

    public function verifierAppareil($Ip){
        return adressIP::where('adressIP',$Ip)->where('etat','liste_blanche')->exists();
    }

    // composer require torann/geoip
    // php artisan vendor:publish --provider="Torann\GeoIP\GeoIPServiceProvider"

    public function verifierPays($Ip){
        $authorizedCountries = ['Morocco','Germany','United States'];
        $location = GeoIP::getlocation($Ip);

        $country = $location->country_name;
        return in_array($country,$authorizedCountries);
    }

}
