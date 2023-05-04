<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\InscriptionClientMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Image;
use Intervention\Image\Exception\NotReadableException;

class SocieteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $societes = Societe::all();
        return view ('saas.societe.index', compact('societes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $societes = Societe::all();
        return view ('saas.societe.create', compact('societes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_societe' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email','unique:societes', 'max:150'],
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
        

         

        $save = new Societe;
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
        $save->nom_module=0;
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
/*       
      
       $compte = new Compte;
       $compte->societe_id = $societ->id;
       $compte->nbre_user=$request->nombre;
       $compte->etat=0;
       $compte->deletable=0;
       $compte->save();
*/       
        $societ = Societe::all()->sortByDesc('id')->first();

        $user = new User;
        $user->name=$request->responsable;
        $user->email=$request->email;
        $user->password=Hash::make($numerooo);
        $user->societe_id=$societ->id;
        $user->save();
        return back()->with('message', "La Société a bien été créée !");
       /* $body_m = "Votre demande de souscription sur proges-pme.com a été prise en compte avec succes merci de suivre la procédure de régularisation pour activation de votre compte \n";	  
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
            //$societes = Societe::all();
            return redirect()->route('societe.index')->with('message', $message);
            
        }
        else
        {
            //$societes = Societe::all();
            return BACK()->with('error', 'Echec de souscription !!!');
        }
        
        */
    

        }
            
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\societe  $client
     * @return \Illuminate\Http\Response
     */
    public function voir($id)
    {
        $societe = Societe::findOrFail($id);
        return view('saas.societe.fiche', compact('societe'));
      
    }
    
    public function show($id)
    {
        $societe = Societe::findOrFail($id);
        return view('saas.societe.cli', compact('societe'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $societes = Societe::all();
        $societe= Societe::findOrFail($id);
        return view('saas.societe.edit', compact('societes', 'societe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
            'nom_societe'=>'required|max:100', 
            'email'=>'required|max:100', 
        ]);
        $save=Societe::find($id);
        $save->nom_societe=$request->nom_societe;
        $save->telephone=$request->tel;
        $save->email=$request->email;
        $save->site=$request->site_web;
        $save->email=$request->email;
        $save->responsable=$request->responsable;
        $save->adresse=$request->adresse;
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $image = Societe::find($request->id);
            // URL du fichier distant
            $rFile = "uploads/societe/".$image->image;
            // Ouvrir le fichier
            $check = @fopen($rFile, 'r');
            // Vérifier si le fichier existe
            if(!$check){
            
            }else{
                unlink("uploads/societe/".$image->image);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = '-img-societe-'.time() . '.' . $extension;
            $destinationPath = public_path('/uploads/societe');
            $resize_image = Image::make($file->getRealPath());
            $resize_image->resize(900,500)->save($destinationPath. '/' . $filename);
            $destinationPath = $request->file('image')->store('uploads/societe');
            $save->image = $filename;
        }
        
        $save->save();
        return back()->with('message', "La Societe a bien été modifie !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $fournisseur = Societe::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($fournisseur->etat == 0)
        {
            $message = "Societe supprimée avec succèss" ;
            $desc = str_replace('@','',"@DELETE-FORMATION") ;
           
            $fournisseur->delete();
        }
        else
        {
            $erreur = "Suppression Societe non autorisée" ;
            $desc = "ESSAYE-DEL-FORMATION" ;
        }
        
       

        if($message != '') 
        { return back()->with('mess', $message); }
        else 
        { return back()->with('error', $erreur); }
    }
}