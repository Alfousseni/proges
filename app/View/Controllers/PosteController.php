<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
 
 
 class PosteController extends Controller
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
       $Postes = Poste::all()->Where('societe_id',$soce);
       return view('saas-1.poste.index',compact('Postes'));
        
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

    //liste de toutes les postes
    
    public function voirliste3()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $postes = Poste::all()->Where('societe_id',$soce);
        return view ('saas-1.poste.voir', compact('postes')); 
    }
    public function liste3()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $postes = Poste::all()->Where('societe_id',$soce);
        return view('saas-1.poste.list', compact('postes','Societ'));
        
    }
            // fin liste de toutes les postes

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'nom' => 'required',
            'niveau' => 'required',
            'contrat' => 'required',
            'salaire' => 'required',

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $save = new Poste;
        $save->nom_post = $request->nom;
        $save->niveau= $request->niveau;
        $save->Service= $request->service;
        $save->contrat= $request->contrat;
        $save->salaire= $request->salaire;
        $save->Detail= $request->detail;
        $save->societe_id = $Soci->societe_id;
        $save->save();
        return BACK()->with('message', "Le Poste a bien été créé!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
     public function voir($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $postes=Poste::all()->where('id',$num)->first();
            return view('saas-1.poste.fiche', compact('postes'));  
        }
      
    }
    
    public function show($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $postes=Poste::all()->where('id',$num)->first();
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.poste.po', compact('postes','Soci','Societ'));  
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postes=Poste::findOrFail($id);
        return view('saas-1.poste.edit', compact('postes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
         $validatedData=$request->validate([
        
        
        ]);

                $save=Poste::find($id);
                $save->nom_post =$request->nom;
                $save->service =$request->service;
                $save->niveau=$request->niveau;
                $save->Salaire=$request->salaire;
                $save->Detail=$request->detail;
                $save->contrat=$request->contrat;
                
                $save->save();
                return BACK()->with('message', "Le poste a bien ete modifie !");
          
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postes= Poste::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($postes->validated == 0)
        {
            $message = "Poste supprimé avec succès" ;
            $desc = str_replace('@','',"@DELETE-POSTE") ;
            $postes->delete();
        }
        else
        {
            $erreur = "Suppression poste non autorisée" ;
            $desc = "ESSAYE-DEL-POSTE" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}