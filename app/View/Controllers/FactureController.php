<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Client;
use App\Models\Societe;
use App\Models\User;
use App\Models\Vente;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailVente;
use Illuminate\Http\Request;
use PDF;

class FactureController extends Controller
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
            $ventes=vente::all()->Where('societe_id',$soce)->where('etat',1);
            $factures=Facture::all()->Where('societe_id',$soce)->where('etat',1);
            return view('saas-1.facture.index',compact('ventes','factures'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    
    public function show($id){
        $vente=Vente::findOrFail($id);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $clients=Client::all()->where('numero',$vente->num_client)->Where('societe_id',$soce);
        return view('saas-1.facture.bon',compact('vente','clients','Soci','Societ'));

    }

    public function facture($id){
        $vente=Vente::findOrFail($id);
        $clients=Client::all()->where('numero',$vente->num_client);
        $details=DetailVente::all()->where('num_com',$vente->num_com);
        $nns= $details->Count();
        return view('saas-1.facture.bvte',compact('vente','clients','details'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */

     public function regler($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
	    $cmds =  Vente::all()->Where('id',$id);
        return view('saas-1.facture.regul',compact('cmds'));
    }   

    public function regulariser(Request $request,$id)
    {
    	$validatedData=$request->validate([
            'montant'=>'required', 
          
        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
	$fac=  Vente::findOrFail($id);
	$fmnt = $fac->encaisser;
	$enc = $fmnt + $request->montant;
	$num = $fac->num_com; 
	
      	$save = Vente::findOrFail($id);
        $save->encaisser= $enc;
        $save->save();

        $sav = Facture::all()->where('num_com',$num)->Where('societe_id',$soce)->first();
        $sav->encaisser = $enc;
        $sav->save();

        $commandes = Vente::all()->where('etat',1)->Where('societe_id',$soce);
        return BACK()->with('message', "La régularisation a bien été faites avec succés!");
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}