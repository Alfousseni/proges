<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeDev;
use App\Models\DetailDevis;
use Illuminate\Support\Facades\Mail;
use App\Mail\InscriptionClientMail;

class DemanderController extends Controller
{
    
    public function DemanderDev(Request $request)
    {
       
        Mail::to('contact@jenmedias.com')
        ->send(new InscriptionClientMail($request->except('_token')));
        
        $validatedData=$request->validate([   
        ]);
            $save=new DemandeDev;
            $save->nom=$request->nom;
             $save->tel=$request->tel;
             $save->email=$request->email;
             $save->module=json_encode($request->nom_mod);
             $save->message=$request->message;
             $save->save();
     return back()->with(['message' => 'Merci de votre interet que vous portez à notre entreprise, un Email vous sera envoyé.i']);
    
}
}