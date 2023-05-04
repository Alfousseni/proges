<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Psalaire;
use App\Models\Employer;
use App\Models\Societe;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Http\Request;

class PaiementSalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
       $soce= $Soci->societe_id;
       $Mois = Mois::all();
       $sals = Psalaire::all()->Where('societe_id',$soce);	
       return view('saas-1.salaire.add',compact('Mois','sals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }
    
  public function RecupMois(Request $request)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $moit = $request->mois;
        $year = $request->annee;
        $Mois = Mois::all();
        $Moii = Mois::all()->Where('id',$moit)->first();
        
        $Empl = Employer::all()->Where('societe_id',$soce);
        
        
        
        return view('saas-1.salaire.recup',compact('Mois','Empl','Moii','year'));
    }

    public function Liste()
    {     
       $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
       $soce= $Soci->societe_id;
       $sals = Psalaire::all()->Where('societe_id',$soce);	
       return view('saas-1.salaire.index',compact('sals'));
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $societe=Societe::all()->where('id',$Soci->societe_id)->first();
        $soce = $societe->id;
        			$ex = $request->annee;
			        $date = substr($ex,2);
			        $mois = $request->mois;
			        // generation du numero de produit//
			        $zer="00000";
			        $numero="OPSL".$soce.$date.$mois;
			        $nbre=Psalaire::all()->Where('societe_id',$soce)->Count();
			        $nbre++;
			        if($nbre<10) $zer=substr($zer,0,strlen($zer)-1);
			        else if($nbre<100) $zer=substr($zer,0,strlen($zer)-2);
			        else $zer=substr($zer,0,strlen($zer)-3);
			        $numero.=$zer.$nbre;
			        //fin	
            
            
                if($request->annee==''|| $request->mois==''){
                
                    return BACK()->with('message', "Insertion non reussi!!!! Des champs sont vides!!!!!");

                }elseif($request->annee!=''|| $request->mois!=''){
                   
		   
				   $nb = count($request->num_emp);
		                   $i=0; 
		 		for($i=0; $i<$nb; $i++){
                	            $verif = Psalaire::all()->where('mois_id',$request->mois)->where('annee_ex',$request->annee)->where('employer_id',$request->num_emp[$i])->first();
                	            
                	            if(isset($verif->employer_id)){
                	            }elseif(!isset($verif->employer_id)){
	                	    $save = new Psalaire;
		                    $save->code_op = $numero;
		                    $save->employer_id = $request->num_emp[$i];
		                    $save->mois_id = $request->mois;
		                    $save->annee_ex = $request->annee;
		                    $save->mode_paiement = $request->mode[$i];
		                    $save->montant = $request->montant[$i];
		                    $save->societe_id= $soce;
                		    $save->save();
                		    }
                           	  }
 
		  $Mois = Mois::all();
		  $sals = Psalaire::all()->Where('societe_id',$soce);	
    		  return view('saas-1.salaire.add',compact('Mois','sals'))->with('message', "Paiement des salaires effectué avec succés!!!");
 		    
                		    
    		}	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Psalaire  $psalaire
     * @return \Illuminate\Http\Response
     */
     
       public function voir($id)
    {
        if(isset($id)){  
            $num = $id;
            $salaire = Psalaire::all()->Where('id',$num)->first();
            return view('saas-1.salaire.fiche', compact('salaire'));  
        }
      
    }
  
     
    public function show($id)
    {
        if(isset($id)){  
             $num = $id;
             $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
             $soce= $Soci->societe_id;
             $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
             $sals = Psalaire::all()->Where('societe_id',$soce)->Where('id',$num)->first();
             return view('saas-1.salaire.in', compact('sals','Soci','Societ'));  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Psalaire  $psalaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Psalaire $psalaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Psalaire  $psalaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Psalaire $psalaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Psalaire  $psalaire
     * @return \Illuminate\Http\Response
     */
     public function destroy( $id)
    {
        $salaire = Psalaire::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($salaire->etat == 0)
        {
            $message = "Societe supprimée avec succèss" ;
            $desc = str_replace('@','',"@DELETE-FORMATION") ;
           
            $salaire->delete();
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