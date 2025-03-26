<?php

namespace App\Http\Controllers\Api;

use App\Models\motPass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MotPassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return motPass::all();
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
        $Validate = $request->validate([
            "site_web" =>"string|required",
            "identifiant_email"=>"string|required",
            "motPassChiffre"=>"string|required",
            "user_id"=>"required|exists:users,id",
        ]);
        motPass::create([
            "site_web"=>$request->site_web,
            "identifiant_email" =>$request->identifiant_email,
            "motPassChiffre"=>$request->motPassChiffre,
            "user_id"=>$request->user_id,
        ]);
        return response()->json(["message"=>"the new password saved successfully!"],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(motPass $motPass)
    {
        //
        return $motPass;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(motPass $motPass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $Validate = $request->validate([
            "site_web" =>"string|required",
            "identifiant_email"=>"string|required",
            "motPassChiffre"=>"string|required",
            "user_id"=>"required|exists:users,id",
        ]);
        $Password = motPass::find($id);
        if(!$Password)
        {
            return response(["errorMessage"=>"Password was not found!"],404);
        }
        $Password::update([
            "site_web"=>$request->site_web,
            "identifiant_email" =>$request->identifiant_email,
            "motPassChiffre"=>$request->motPassChiffre,
            "user_id"=>$request->user_id,
        ]);
        return response()->json(["message"=>"the password updated successfully!"],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $Password=motPass::find($id);
        if(!$Password)
        {
            return response(["errorMessage"=>"couldn't find password!"]);
        }
        $Password->delete();
        return response()->json(["message","Password deleted successfully!"],200);

    }
}
