<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        
        $modules = Module::all()->Where('societe_id','=',$soce);
        return view ('BACK.module.create', compact('modules'));
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
            'nom'=>'required|max:100', 
            'caption'=>'required|max:150',
        ]);
        $save=new Module;
        $save->nom_module=$request->nom;
        $save->caption=$request->caption;
        $save->description=$request->description;
        $save->save();
        return BACK()->with('message', "Le Module a bien ete cree !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $module = Module::findOrFail($id) ;

        if($module->etat == 0)
        {
            $etat = 1 ;
            $desc = 'ACTIVATION' ;
            $message = 'Module Activée' ;
        }
        else
        {
            $etat = 0 ;
            $desc = 'DESACTIVATION' ;
            $message = 'Module Desactivée' ;
        }

        $module->etat = $etat ;
        $module->save() ;
        return back()->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $modules = Module::all()->Where('societe_id','=',$soce);
        $module=Module::findOrFail($id);
        return view('BACK.module.edit', compact('module', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $save= Module::find($id);
        $save->nom_module=$request->nom;
        $save->caption=$request->caption;
        $save->description=$request->description;
        $save->save();
        return BACK()->with('message', "Le Module a bien ete modifie !");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $module = Module::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($module->etat == 0)
        {
            $message = "Module supprimée avec succèss" ;
            $desc = str_replace('@','',"@DELETE-FORMATION") ;
           
            $module->delete();
        }
        else
        {
            $erreur = "Suppression module non autorisée" ;
            $desc = "ESSAYE-DEL-FORMATION" ;
        }
        
       

        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}