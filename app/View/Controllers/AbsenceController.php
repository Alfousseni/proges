<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employer;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
 
class AbsenceController extends Controller
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
       $absences= Absence::all()->Where('societe_id',$soce);
       $employes= Employer::all()->Where('societe_id',$soce);
       return view('saas-1.absence.index',compact('absences','employes'));
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
    //liste des absences periodiques
    public function liste(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $journaux=Absence::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.absence.list-abs',compact('journaux','debut','fin'));
    }
    public function voirabsence1($debut, $fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=Absence::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.absence.list',compact('journaux', 'Societ','debut','fin'));
    }
    public function voirabsence2() {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=Absence::all()->Where('societe_id',$soce);
        return view('saas-1.absence.list1',compact('journaux', 'Societ'));
    }
     // Fin liste des absences periodiques

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
            

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $save = new Absence;
        $save->employer_id = $request->employe;
        $save->date_deb= $request->date_deb;
        $save->date_fin= $request->date_fin;
        $save->nbre_jr= $request->nbre_jr;
        $save->motif= $request->motif;
       	$save->societe_id = $Soci->societe_id;
        $save->save();
        return BACK()->with('message', "L'Absence a bien été créé!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absence  $Absence
     * @return \Illuminate\Http\Response
     */
     public function voir($id)
    {
            $Absence=Absence::findOrFail($id);
            return view('saas-1.absence.fiche', compact('Absence'));  
      
    }
    
    public function show($id)
    {
            $absences=Absence::findOrFail($id);
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.absence.abs', compact('absences','Soci','Societ'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absence  $Absence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $employes = Employer::all()->Where('societe_id',$soce);
        $absences= Absence::findOrFail($id);
        return view('saas-1.absence.edit', compact('absences','employes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absence  $Absence
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request,  $id)
    {
         $validatedData=$request->validate([
        
        
        ]);

                $save=Absence::find($id);
                $save->employer_id=$request->employe;
                $save->date_deb=$request->date_deb;
                $save->date_fin=$request->date_fin;
                $save->motif=$request->motif;
                $save->nbre_jr=$request->nbre_jr; 
                
                $save->save();
                return BACK()->with('message', "L'Absence de l'employé a bien été modifié !");
          
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absence  $Absence
     * @return \Illuminate\Http\Response
     */
	public function destroy($id)
    	{
        $Absences= Absence::findOrFail($id);
        $message = '';
        $erreur = '';
        if($Absences->validated == 0)
        {
            $message = "Absence supprimée avec succès" ;
            $desc = str_replace('@','',"@DELETE-Absence") ;
            $Absences->delete();
        }
        else
        {
            $erreur = "Suppression absence non autorisée" ;
            $desc = "ESSAYE-DEL-Absence" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}