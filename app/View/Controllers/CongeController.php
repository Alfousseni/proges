<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employer;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
 
class CongeController extends Controller
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
       $conges= Conge::all()->Where('societe_id',$soce);
       $employes= Employer::all()->Where('societe_id',$soce);
       return view('saas-1.conge.index',compact('conges','employes'));
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
    //liste des conges periodiques
    public function liste(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $journaux=Conge::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.conge.list-conge',compact('journaux','debut','fin'));
    }
    public function voirconge1($debut, $fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=Conge::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.conge.list',compact('journaux', 'Societ','debut','fin'));
    }
    public function voirconge2() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=Conge::all()->Where('societe_id',$soce);
        return view('saas-1.conge.list1',compact('journaux', 'Societ'));
    }
     // Fin liste des conges periodiques

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'employe' => 'required',
            'date_deb' => 'required',
            'date_fin' => 'required',
            'nbre_jr' => 'required',
            'type' => 'required',

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $save = new Conge;
        $save->employer_id = $request->employe;
        $save->date_deb= $request->date_deb;
        $save->date_fin= $request->date_fin;
        $save->nbre_jr= $request->nbre_jr;
        $save->type= $request->type;
       	$save->societe_id = $Soci->societe_id;
        $save->save();
        return BACK()->with('message', "Le conge a bien été créé!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
     public function voir($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $conges=Conge::all()->where('id',$num)->first();
            return view('saas-1.conge.fiche', compact('conges'));  
        }
      
    }
    
    public function show($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $conges=Conge::all()->where('id',$num)->first();
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.conge.cong', compact('conges','Soci','Societ'));  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $employes = Employer::all()->Where('societe_id',$soce);
        $conges= Conge::findOrFail($id);
        return view('saas-1.conge.edit', compact('conges','employes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,  $id)
    {
         $validatedData=$request->validate([
        
        
        ]);

                $save=Conge::find($id);
                $save->employer_id=$request->employe;
                $save->date_deb=$request->date_deb;
                $save->date_fin=$request->date_fin;
                $save->type=$request->type;
                $save->nbre_jr=$request->nbre_jr; 
                
                $save->save();
                return BACK()->with('message', "Le conge de l'employé a bien été modifié !");
          
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conge  $conge
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
    	{
        $conges= Conge::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($conges->validated == 0)
        {
            $message = "Congé supprimé avec succès" ;
            $desc = str_replace('@','',"@DELETE-CONGE") ;
            $conges->delete();
        }
        else
        {
            $erreur = "Suppression congé non autorisée" ;
            $desc = "ESSAYE-DEL-CONGE" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}