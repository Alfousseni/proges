<?php

namespace App\Http\Controllers;

use App\Models\Retrait;
use App\Models\JournalCaisse;
use App\Models\Depot;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class RetraitController extends Controller
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
        $retraits=Retrait::all()->Where('societe_id',$soce);
        $depot=Depot::all()->Where('societe_id',$soce)->sum('montant');
        $retrait=Retrait::all()->Where('societe_id',$soce)->sum('montant_ret');
        $montants= $depot - $retrait ;
        $retraits=Retrait::all()->Where('societe_id',$soce);
        return view('saas-1.retrait.liste',compact('retraits','montants'));

    }

    public function JournalSortie() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $retraits=Retrait::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.journalsortie',compact('retraits'));
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
        $retraits=Retrait::all()->Where('societe_id',$soce);
        $depot=Depot::all()->Where('societe_id',$soce)->sum('montant');
        $retrait=Retrait::all()->Where('societe_id',$soce)->sum('montant_ret');
        $montants= $depot - $retrait ;
        return view ('saas-1.retrait.create',compact('montants','retraits'));
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
        $soce= $Soci->societe_id;
        $depot=Depot::all()->Where('societe_id',$soce)->sum('montant');
        $retrait=Retrait::all()->Where('societe_id',$soce)->sum('montant_ret');
        $montants= $depot - $retrait ;
        if($montants < $request->montant){
            return back()->with('message',"Vous ne pouvez pas retirer ce montant, Veuillez verifier le montant disponible");
        }
        else{
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $save= New Retrait;
            $save->nom_ret=$request->nom;
            $save->montant_ret=$request->montant;
            $save->motif=$request->motif;
            $save->provenance=$request->provenance;
            $save->logdep = Auth::user()->email ;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            $save= new JournalCaisse;
            $save->prestation=$request->motif;
            $save->operation = 'caisse';
            $save->retrait=$request->montant;
            $save->nom=$request->nom;
            $save->piece=$request->provenance;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            return BACK()->with('message', "Le retrait a bien ete cree !");
        }
    }
    
    public function voir(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $retraits=Retrait::all()->Where('societe_id',$soce);
        return view('saas-1.retrait.list_ret',compact('retraits'));
    }

    public function voir1() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $retraits=Retrait::all()->Where('societe_id',$soce);
        return view('saas-1.retrait.index',compact('retraits'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\retrait  $retrait
     * @return \Illuminate\Http\Response
     */
    public function show(retrait $retrait)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\retrait  $retrait
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $retrait=Retrait::findOrFail($id);
        $depot=Depot::all()->Where('societe_id',$soce)->sum('montant');
        $retrai=Retrait::all()->Where('societe_id',$soce)->sum('montant_ret');
        $montants= $depot - $retrai ;
        return view('saas-1.retrait.edit', compact('retrait','montants','retrai')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\retrait  $retrait
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validatedData=$request->validate([
            'nom'=>'required|max:100', 
            'montant'=>'required|max:150',
            
        
        ]);
        $save =retrait::findorFail($id);
        $save->nom_ret=$request->nom;
    
    $save->montant_ret=$request->montant;
    
    $save->logdep = Auth::user()->email ;
        $save->save();

        return BACK()->with('message', "Le  retrait a bien été modifié!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\retrait  $retrait
     * @return \Illuminate\Http\Response
     */
    public function destroy(retrait $retrait)
    {
        //
    }
}