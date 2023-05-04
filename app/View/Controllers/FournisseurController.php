<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\Pays;
use App\Models\Produit;
use App\Models\TypeProduit;
use App\Models\User;
use App\Models\Societe;
use App\Models\TransactionVente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FournisseurController extends Controller
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
        $payss=Pays::all()->sortBy('nom_fr_fr');
        $types=TypeProduit::all()->Where('societe_id',$soce)->sortBy('nom');
        $fournisseurs = Fournisseur::all()->Where('societe_id',$soce);
        return view('saas-1.fournisseur.index', compact('fournisseurs','payss','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;             
        
        $payss=Pays::all()->sortBy('nom_fr_fr');
        $types=TypeProduit::all()->Where('societe_id',$soce)->sortBy('nom_type');
        return view ('saas-1.fournisseur.create',compact('payss','types')); 
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
        ]);
	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;             
        
        //generation du numero de fournisseur
        $exe=date('Y');
        $date=substr($exe,2);
        $zero="0000";
        $numerooo="FNS".$soce.$date;
        $nombre=Fournisseur::all()->Where('societe_id',$soce)->count();
        $nombre++;
        if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
        else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
        else $zero=substr($zero,0,strlen($zero)-3);
        $numerooo.=$zero.$nombre;
        //fin

        //generation du code fournisseur
        $zeroo="000";
        $code="401";
        $nbr=Fournisseur::all()->Where('societe_id',$soce)->Count();
        $nbr++;
        if($nbr<10) $zeroo=substr($zeroo,0,strlen($zeroo)-1);
        else if($nbr<100) $zeroo=substr($zeroo,0,strlen($zeroo)-2);
        else $zeroo=substr($zeroo,0,strlen($zeroo)-3);
        $code.= $zeroo.$nbr;
        //fin

        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){
                return back()->with('message',"!!!! Email non valide !!!!");
            }
        }
        
        if($request->nom=="" || $request->prenom=="" || $request->adresse=="" || $request->tel=="" || $request->pays=="" || $request->ville=="" || $request->email==""){
            return back()->with('message',"!!!! Veuillez remplir les champs vides !!!!");
        }
        
        if($request->nom!="" && $request->email!="" && $request->prenom!="" && $request->adresse!="" && $request->tel!="" && $request->pays!=""){
            $gt = Fournisseur::all()->where('email',$request->email)->where('compagnie',$request->company)->where('site',$request->url);	
            $nb = $gt->count();  
            if($nb!=0){
                return back()->with('message', "Insertion non réussi !!!! L'entreprise renseigné existe déja !!!!");
            }
            elseif($nb==0){
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
                $save= new Fournisseur;
                $save->numero=$numerooo;
                $save->codefrs=$code;
                $save->specialite=json_encode($request->specialite);
                $save->nom=$request->nom;
                $save->prenom=$request->prenom;
                $save->compagnie=$request->company;
                $save->email=$request->email;
                $save->adresse=$request->adresse;
                $save->pays=$request->pays;
                $save->ville=$request->ville;
                $save->codep=$request->code;
                $save->tel=$request->tel;
                $save->site=$request->site;
                $save->info=$request->info;
                $save->editorial= Auth::user()->email;
                $save->societe_id = $Soci->societe_id;
                $save->save();
                return back()->with('message', "Le Fournisseur a bien ete cree !");
            }
        }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */

    public function voir($numero){
        if(isset($numero)){  
            $frs = $numero;
            $fournisseur = fournisseur::all()->where('numero',$frs)->first();
            return view('saas-1.fournisseur.fiche', compact('fournisseur'));
        }
    }
    
    public function show($numero)
    {
        if(isset($numero)){  
            $frs = $numero;
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $soce = $Soci->societe_id;
            $fournisseur = fournisseur::all()->where('numero',$frs)->Where('societe_id',$soce)->first();
            return view('saas-1.fournisseur.frs', compact('fournisseur','Soci','Societ'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $payss=Pays::all()->sortBy('nom_fr_fr');
        $fournisseur=Fournisseur::findOrFail($id);
        return view('saas-1.fournisseur.edit', compact('fournisseur', 'payss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
          
        ]);
        
        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){
                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }
            
                $save=Fournisseur::find($id);
                $save->nom=$request->nom;
                $save->prenom=$request->prenom;
                $save->compagnie=$request->company;
                $save->email=$request->email;
                $save->adresse=$request->adresse;
                $save->pays=$request->pays;
                $save->ville=$request->ville;
                $save->codep=$request->code;
                $save->tel=$request->tel;
                $save->site=$request->site;
                $save->info=$request->info;
                $save->editorial= Auth::user()->email;
                $save->save();
                return BACK()->with('message', "Le Fournisseur a bien ete modifie !");
            
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($fournisseur->validated == 0)
        {
            $message = "Fournisseur supprimée avec succèss" ;
            $desc = str_replace('@','',"@DELETE-FORMATION") ;
           
            $fournisseur->delete();
        }
        else
        {
            $erreur = "Suppression Client non autorisée" ;
            $desc = "ESSAYE-DEL-FORMATION" ;
        }
        
       

        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }

    //liste de toutes les fournisseurs
    
    public function voirliste2()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $fournisseurs = Fournisseur::all()->Where('societe_id',$soce);
        return view ('saas-1.fournisseur.voir', compact('fournisseurs')); 
    }
    public function liste2()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $fournisseurs = Fournisseur::all()->Where('societe_id',$soce);
        return view('saas-1.fournisseur.list', compact('fournisseurs','Societ'));
        
    }
            // fin liste de toutes les fournisseurs

    
}