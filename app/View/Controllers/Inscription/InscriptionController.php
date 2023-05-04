<?php

namespace App\Http\Controllers\Inscription;

use Illuminate\Http\Request;
use App\Models\Societe;
use App\Models\User;
use App\Models\compte;
use App\Http\Controllers\Controller;
use App\Mail\InscriptionClientMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Image;
use Intervention\Image\Exception\NotReadableException;
class InscriptionController extends Controller
{
    

    public function devis(Request $request)
    {
        $request->validate([
            'nom_societe' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email','unique:societes', 'max:100'],
        ],
       );
         
        if($request->nom_societe=="" || $request->adresse=="" || $request->tel=="" || $request->email==""){
            return back()->with('message', "!!!! Des champs sont vides !!!!");
        }

        // is the email valid?

        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){

                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }
       
        // is the sex selected?
        if($request->responsable==""){
            return back()->with('message', "!!!! le responsable est vide !!!!");
        }
            else{
        
        $save=new Societe;
        $exe=date('Y');
        $date=substr($exe,2);
        $zero="00000";
        $numerooo="SOC$date";
        $nombre=Societe::all()->Count();
        $nombre++;
        if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
        else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
        else $zero=substr($zero,0,strlen($zero)-3);
        $numerooo.= $zero.$nombre;
        $save->nom_societe=$request->nom_societe;
        $save->caption=$numerooo;
        $save->tel=$request->tel;
        $save->adresse=$request->adresse;
        $save->email=$request->email;
        $save->site=$request->site_web;
        $save->responsable=$request->responsable;
        $save->nombre_user=$request->nombre;
        $save->exoneration=$request->exo;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = '-img-societe-'.time() . '.' . $extension;
            $destinationPath = public_path('/uploads/societe');
            $resize_image = Image::make($file->getRealPath());
            $resize_image->resize(900,500)->save($destinationPath. '/' . $filename);
            $destinationPath = $request->file('image')->store('uploads/societe');

            $save->logo = $filename;

        } else{
            $save->logo ='';
        }
       $save->save();
       
       $societ = Societe::all()->sortByDesc('id')->first();

       $compte = new compte;
       $compte->societe_id = $societ->id;
       $compte->nbre_user=$request->nombre;
       $compte->etat=0;
       $compte->deletable=0;
       $compte->save();
       

        $user= new User;
        $user->name=$request->responsable;
        $user->email=$request->email;
        $user->password=md5($numerooo);
        $user->current_team_id= $societ->id ;
        
        $user->save();

        $site_local = "http://127.0.0.1:8000/" ;
        $site_ligne = "https://proges-pme.com/" ;
        $body_m = "Votre demande de souscription sur proges-pme.com a été prise en compte avec succes merci de suivre la procédure de régularisation pour activation de votre compte \n";	  
        $body_l ="Pour activer votre compte, veuillez effectuer le paiement de votre redevance sur nos moyens de paiements possibles.";
        $body_d = "Si vous rencontrez des difficultés, contactez-nous à ".env('MAIL_USERNAME') ;
				   
            $maildetails = [
                'title' => 'Bienvenue dans PROGES-PME',
                'body_m' => $body_m,
                'body_l' => $body_l,
                'body_d' => $body_d,
                'nom' => $request->nom
            ];

        Mail::to($request->email)->send(new InscriptionClientMail($maildetails));
        $message = 'Votre demande de souscription a été prise en compte. Vous receverez un message dans votre adresse '.$request->email.' pour votre confirmation';

        if($save->id != 0)
        {
            return back()->with('message', $message);
        }
        else
        {
            return back()->with('erreur', 'Echec de souscription !!!');
        }
        
   
    }

}
 }