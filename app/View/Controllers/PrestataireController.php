<?php

namespace App\Http\Controllers;

use App\Models\Prestataire;
use App\Models\Societe;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\InscriptionClientMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Image;
use Intervention\Image\Exception\NotReadableException;
use Illuminate\Http\Request;

class PrestataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $prestataires = Prestataire::all()->Where('societe_id',$soce);
        return view('saas-1.prestataire.index', compact('prestataires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $validatedData=$request->validate([   
           'nom' => 'required',
          'prenom' => 'required',
          'email' => 'required', 'unique:prestataires',
          'tel' => 'required',
           
        ]);

      
        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){

                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }

         
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
           	$soce = $Soci->societe_id;
                $save=new Prestataire;
                //generation du numero de client
                $exe=date('Y');
                $date=substr($exe,2);
                $zero="0000";
                $numerooo="PRT".$soce.$date;
                $nombre=Prestataire::all()->Where('societe_id',$soce)->Count();
                $nombre++;
                if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
                else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
                else $zero=substr($zero,0,strlen($zero)-3);
                $numerooo.= $zero.$nombre;
                //fin

                 

                $save->code_prestataire=$numerooo; 
                $save->nom=$request->nom;
                $save->prenom=$request->prenom;
                $save->email=$request->email;
                $save->tel=$request->tel;
                $save->adresse=$request->adresse;
                $save->type=$request->type;
                $save->entreprise=$request->entreprise;
                $save->societe_id = $Soci->societe_id;
                $save->etat= 0;
                $save->deletable= 0;
                
              
		  
                $save->save();
                
		
                return BACK()->with('message', "Le prestataire a bien été créé !");
             
    }

	  public function voirliste4()
	    {
	        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	        $soce= $Soci->societe_id;
	        $prestataires = Prestataire::all()->Where('societe_id',$soce);
	        return view ('saas-1.prestataire.voir', compact('prestataires')); 
	    }
	    public function liste4()
	    {
	        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	        $soce= $Soci->societe_id;
	        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
	        $prestataires = Prestataire::all()->Where('societe_id',$soce);
	        return view('saas-1.prestataire.list', compact('prestataires','Societ'));
	        
	    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
      public function voir($id)
    {
        if(isset($id)){  
            $num = $id;
            $prestataires = Prestataire::all()->where('id',$num)->first();
            return view('saas-1.prestataire.fiche', compact('prestataires'));  
        }
      
    }
    
    public function show($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $prestataires = Prestataire::all()->where('id',$num)->first();
            $Soci = User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.prestataire.in', compact('prestataires','Soci','Societ'));  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $prestataires = Prestataire::findOrFail($id);
        return view('saas-1.prestataire.edit', compact('prestataires'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $validatedData=$request->validate([   
           'nom' => 'required',
          'prenom' => 'required',
          'email' => 'required', 'unique:prestataires',
          'tel' => 'required',
           
        ]);
        
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        
        
        
        $save = Prestataire::find($id);
       
        $save->nom=$request->nom;
        $save->prenom=$request->prenom;
        $save->type=$request->type;
        $save->entreprise=$request->entreprise;
        $save->tel=$request->tel;
        $save->email=$request->email;
        $save->adresse=$request->adresse;
        
        $save->save();
        
        	
        return back()->with('message', "Le prestataire a bien été modifié !");
    }
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestataire  $prestataire
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {
        
        $prestataire= Prestataire::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($prestataire->etat == 0)
        {
            $message = "Prestataire supprimé avec succès" ;
            $desc = str_replace('@','',"@DELETE-PRESTATAIRE") ;
            $prestataire->delete();
        }
        else
        {
            $erreur = "Suppression prestataire non autorisée" ;
            $desc = "ESSAYE-DEL-PRESTATAIRE" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
   
    }
}