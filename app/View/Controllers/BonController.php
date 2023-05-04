<?php

namespace App\Http\Controllers;

use App\Models\bon;
use App\Models\User;
use App\Models\Societe;
use App\Models\DetailCommande;
use Illuminate\Support\Facades\Auth;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use PDF;

class bonController extends Controller
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
        
        $bons = bon::all()->Where('societe_id',$soce);
        return view('saas-1.bon.index', compact('bons'));
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
     * @param  \App\Models\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function show($num_com){
        if(isset($num_com)){  
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);

            $num = $num_com;
            $bon=Bon::all()->where('num_com',$num)->first();
            $frs=Fournisseur::all()->where('numero',$bon->numfour)->Where('societe_id','=',$Soci->societe_id);
            return view('saas-1.bon.bon',compact('bon','frs','Societ'));
        }
    }

    public function bondecommande($num_com){
        if(isset($num_com)){  
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);

            $num = $num_com;
            $bon=Bon::all()->where('num_com',$num)->first();
            $frs=Fournisseur::all()->where('numero',$bon->numfour)->Where('id','=',$Soci->societe_id);
            return view('saas-1.bon.bvte',compact('bon','frs','Societ'));
        }
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function edit(bon $bon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bon $bon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bon  $bon
     * @return \Illuminate\Http\Response
     */
    public function destroy(bon $bon)
    {
        //
    }
}