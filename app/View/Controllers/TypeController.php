<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Societe;
use App\Models\typecategorie;
use Illuminate\Http\Request;

class TypeController extends Controller
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
         $typecategories = Typecategorie::all()->Where('societe_id',$soce);
        return view('BACK.typecategorie.index', compact('typecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view ('BACK.typecategorie.create'); 
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
            
        ]);
        $save=new Typecategorie;
        $save->nom_type=$request->nom;
        $save->diminutif=$request->diminutif;
        
        
        
        $save->save();
        return BACK()->with('message', "Le Type categorie a bien ete cree !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\typecategorie  $typecategorie
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $typecategorie=Typecategorie::findOrFail($id);
       return view('BACK.typecategorie.show', compact('typecategorie'));
       if($typecategorie->etat==0)
       {
        $etat=1;
        $message='Client active';
       }
       else
        {
        $etat=0;
        $message='Client desactive';
       }
    $typecategorie->etat=$etat;
    $typecategorie->save();
    return BACK()->with('message', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\typecategorie  $typecategorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $typecategorie=Typecategorie::findOrFail($id);
         return view('BACK.typecategorie.edit', compact('typecategorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\typecategorie  $typecategorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $validatedData=$request->validate([
            'nom'=>'required|max:100', 
            
        ]);
        $save=Typecategorie::find($id);
       
            $save->nom_type=$request->nom;
        $save->diminutif=$request->diminutif;
       $save->save();
        return BACK()->with('message', "Le Typecategorie a bien ete modifie avec success !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typecategorie  $typecategorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $typecategorie=Typecategorie::findOrFail($id);
     $message='';
     $erreur='';
     if ($typecategorie->etat==1) 
            {
            $message="Client Supprime avec success";
            $typecategorie->delete();
             } 
            else{ $erreur="Suppression du client non autorise";}
            if ($message!='') 
            { return BACK()->with('message', $message);}
           else
           { return BACK()->with('erreur', $erreur);}
    }
}