<?php

namespace App\Http\Controllers;

use App\Models\TypeProduit;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TypeProduitController extends Controller
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
        $types=TypeProduit::all()->Where('societe_id',$soce);
        return view('saas-1.type_prod.index',compact('types'));
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
        $types=TypeProduit::all()->Where('societe_id',$soce);
        return view('saas-1.type_prod.create',compact('types'));
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
            'nom' => 'required',

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $save = new TypeProduit;
        $save->nom_type = $request->nom;
        $save->societe_id = $Soci->societe_id;
        $save->save();
        return BACK()->with('message', "Le type de produit a bien été créé!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function show(TypeProduit $typeProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $type=TypeProduit::findOrFail($id);
        $types=TypeProduit::all()->Where('societe_id',$soce);
        return view('saas-1.type_prod.edit',compact('type','types'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'nom_type' => 'required',

        ]);
        $save =TypeProduit::findOrFail($id);
        $save->nom_type = $request->nom_type;
        $save->save();
        return BACK()->with('message', "Le type de produit a bien été modifié!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeProduit  $typeProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = TypeProduit::findOrFail($id);
        $mes = '' ;
        $erreur = '' ;
        if($type->deletable == 0)
        {
            $mes = "Type de produit supprimé avec succèss" ;
            $desc = str_replace('@','',"@DELETE-TYPE-PRODUIT") ;
            $type->delete();
        }
        else
        {
            $erreur = "Suppression type de produit non autorisée" ;
            $desc = "ESSAYE-DEL-TYPE-PRODUIT" ;
        }
        if($mes != '')
        { return back()->with('message', $mes); }
        else 
        { return back()->with('errors', $erreur); }
    }
}