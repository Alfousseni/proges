<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

class MouvementController extends Controller
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
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $mouvements = Mouvement::all()->Where('societe_id',$soce);
        return view('saas-1.mouvement.index', compact('mouvements','Societ'));
    }

    public function create()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $mouvements = Mouvement::all()->Where('societe_id',$soce);
        
        return view ('saas-1.mouvement.mvmt', compact('mouvements')); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function create1()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $users=User::all()->Where('societe_id',$soce)->sortBy('name');
       
        return view ('saas-1.mouvement.mvmts', compact('users')); 
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $user=User::findOrFail($id);
        $mouvements= Mouvement::all()->Where('societe_id',$soce)->where('editorial',$user->email)->sortBy('created_at');
        return view('saas-1.mouvement.onsms', compact('mouvements','user')) ; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mouvement  $mouvement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
         $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $user = User::findOrFail($id); 
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $mouvements = mouvement::all()->where('editorial',$user->email)->Where('societe_id',$soce)->sortBy('created_at');
        return view('saas-1.mouvement.indexms', compact('mouvements','user', 'Societ')) ; 
     
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mouvement  $mouvement
     * @return \Illuminate\Http\Response
     */
    public function edit(mouvement $mouvement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mouvement  $mouvement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mouvement $mouvement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mouvement  $mouvement
     * @return \Illuminate\Http\Response
     */
    public function destroy(mouvement $mouvement)
    {
        //
    }
}