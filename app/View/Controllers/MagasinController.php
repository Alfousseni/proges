<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use App\Models\Societe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagasinController extends Controller
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
        
        $magasins=Magasin::all()->Where('societe_id','=',$soce);
        return view('saas-1.magasin.index',compact('magasins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $magasins=Magasin::all()->Where('societe_id','=',$soce);
        return view('saas-1.magasin.create',compact('magasins'));
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
            'nom_mag' => 'required',
            'tel' => 'required',
            'email' => 'required',

        ]);
        if($request->email!="")
        if($request->nom_mag=="" || $request->adresse=="" || $request->tel==""){
            return back()->with('message', "!!!!! Veuillez remplir les champs vides !!!!!");
        }

        // is the email valid?
        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){
                return back()->with('message', "!!!!! Email non valide !!!!!");
            }
        }
        if($request->responsable==""){
            return back()->with('message', "!!!!! le responsable est vide !!!!!"); 
        }

        if($request->nom_mag!="" && $request->adresse!="" && $request->tel!="" && $request->responsable!=""){
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce= $Soci->societe_id;
            $save = new Magasin;
            $save->nom_mag = $request->nom_mag;
            $save->tel = $request->tel;
            $save->email = $request->email;
            $save->responsable = $request->responsable;
            $save->adresse = $request->adresse;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            return BACK()->with('message', "Le magasin a bien été crée!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function show(Magasin $magasin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $magasins=Magasin::all()->Where('societe_id','=',$soce);
        $magasin=Magasin::findOrFail($id);
        return view('saas-1.magasin.edit',compact('magasin', 'magasins'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
            $save =Magasin::findOrfail($id);
            $save->nom_mag=$request->nom_mag;
            $save->tel = $request->tel;
            $save->email = $request->email;
            $save->responsable = $request->responsable;
            $save->adresse = $request->adresse;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            return BACK()->with('message', "Le magasin a bien été modifié!");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $magasin = Magasin::findOrFail($id);
        $mes = '' ;
        $erreur = '' ;
        if($magasin->deletable == 0)
        {
            $mes = "Magasin supprimé avec succèss" ;
            $desc = str_replace('@','',"@DELETE-MAGASIN") ;
            $magasin->delete();
        }
        else
        {
            $erreur = "Suppression magasin non autorisée" ;
            $desc = "ESSAYE-DEL-MAGASIN" ;
        }
        if($mes != '')
        { return back()->with('mes', $mes); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}