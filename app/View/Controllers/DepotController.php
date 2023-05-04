<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Retrait;
use App\Models\JournalCaisse;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DepotController extends Controller
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
        $depots = Depot::all()->Where('societe_id',$soce);
        return view('saas-1.depot.liste', compact('depots'));
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
        $depots = Depot::all()->Where('societe_id',$soce);
        return view ('saas-1.depot.create',compact('depots'));
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
            'nom'=>'required', 
            'caisse'=>'required',
            
        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

        $save=new Depot;
        $save->nom_prop=$request->nom;
        $save->montant=$request->caisse;
        $save->motif=$request->typ_enc;
        $save->provenance=$request->provenance;
        $save->logdep = Auth::user()->email ;
        $save->societe_id = $Soci->societe_id;
        $save->save();
        $save= new JournalCaisse;
        $save->prestation=$request->provenance;
        $save->operation = 'caisse';
        $save->depot=$request->caisse;
        $save->nom=$request->nom;
        $save->piece=$request->typ_enc;
        $save->societe_id = $Soci->societe_id;
        $save->save();
        return BACK()->with('message', "Le Depot a bien ete enregistré !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function voir(){
       $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
       $soce = $Soci->societe_id;     
       $depots=Depot::all()->Where('societe_id',$soce);
        return view('saas-1.depot.list_dep',compact('depots'));
    }

    public function voir1() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;     
        $depots=Depot::all()->Where('societe_id',$soce);
        return view('saas-1.depot.index',compact('depots'));
    }
  
    

    public function JournalEntree() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;     
        $journals=Depot::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.index',compact('journals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $depot=Depot::findOrFail($id);
        return view('saas-1/depot/edit',compact('depot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData=$request->validate([
            'nom'=>'required', 
            'caisse'=>'required',
            
        ]);
        $save=Depot::findOrFail($id);
        $save->nom_prop=$request->nom;
        $save->montant=$request->caisse;
        $save->motif=$request->typ_enc;
        $save->provenance=$request->provenance;
        $save->logdep = Auth::user()->email ;
        $save->save();
        return BACK()->with('message', "Le Depot a bien ete modifié !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depot $depot)
    {
        //
    }
}