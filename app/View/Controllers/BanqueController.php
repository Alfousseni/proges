<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Societe;
use App\Models\Banque;
use App\Models\OpeBanque;
use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;


class BanqueController extends Controller
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
        $banques = Banque::all()->Where('societe_id',$soce);
        $banks = OpeBanque::all()->Where('societe_id',$soce);
        $Postes = Poste::all()->Where('societe_id',$soce);
        return view('saas-1.banque.index',compact('banks','banques','Postes'));
    }
   
   public function index1()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id; 
        $banks=Banque::all()->Where('societe_id',$soce);
        return view('saas-1.banque.index2',compact('banks'));
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
        $banks=Banque::all()->Where('societe_id',$soce);
        return view('saas-1.banque.index2',compact('banks'));
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
            'nom_banque'=>'required', 
            'gestionnaire'=>'required',
            'rib'=>'required',
          
            
        ]);
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        
    	$zeroo="000";
                $code="512";
                $nbr=Banque::all()->Where('societe_id',$soce)->Count();
                $nbr++;
                if($nbr<10) $zeroo=substr($zeroo,0,strlen($zeroo)-1);
                else if($nbr<100) $zeroo=substr($zeroo,0,strlen($zeroo)-2);
                else $zeroo=substr($zeroo,0,strlen($zeroo)-3);
                $code.= $zeroo.$nbr;
                
        $save=new Banque;
        $save->cmpt_compta=$code;
        $save->nom_banque=$request->nom_banque;
        $save->gestionnaire=$request->gestionnaire;
        $save->mail=$request->email;
        $save->tel=$request->tel;
        $save->adresse=$request->adresse;
        $save->rib=$request->rib;
        $save->societe_id=$Soci->id;
        $save->save();
        return BACK()->with('message', "La Banque a bien ete crée !");
        
        
    }

 public function store1(Request $request)
    {
        $validatedData=$request->validate([
            'operation'=>'required', 
            'montant'=>'required',
            
        ]);
        //$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $ex=date('Y');
        $date=substr($ex,2);
        $mois=date('m');
        $zero="00000";
        $numerooo="OPB".$soce.$date.$mois;
        $nombre=OpeBanque::all()->where('societe_id',$Soci->societe_id)->Count();
        $nombre++;
        if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
        else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
        else $zero=substr($zero,0,strlen($zero)-3);
        $numerooo.= $zero.$nombre;
        $trans = $numerooo;
        //fin 

        	
        //fin

        $save=new OpeBanque;
        $save->num_op = $trans;
        $save->operation=$request->operation;
        $save->libelle_operation=$request->libelle;
        //$save->operation=$request->operation;
        $save->type_op=$request->type;
        if($request->operation == 'Depot'){
        $save->credit=$request->montant;
        $save->debit=0;
        }
        if($request->operation == 'Retrait'){
        $save->credit=0;
        $save->debit=$request->montant;
        }
        $save->banque_id=$request->banque;
        $save->societe_id = $Soci->societe_id;
        $save->save();
         
        return BACK()->with('message', "Opération bancaire bien enregistré !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function show($numero)
    {
       if(isset($numero)){  
            $num = $numero;
            $banks=OpeBanque::all()->where('num_op',$num)->first();
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.banque.fiche', compact('banks','Soci','Societ'));  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id; 
        $banks=Banque::all()->Where('societe_id',$soce);;
        $bank=Banque::findOrFail($id);
        return view('saas-1.banque.edit',compact('bank','banks'));
    }
    public function edit1($id)
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id; 
        $banks=Banque::all()->Where('societe_id',$soce);;
        $bank=OpeBanque::findOrFail($id);
        return view('saas-1.banque.editer',compact('bank','banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $save=Banque::findOrFail($id);
        $save->nom_banque=$request->nom_banque;
        $save->gestionnaire=$request->gestionnaire;
        $save->mail=$request->email;
        $save->tel=$request->tel;
        $save->adresse=$request->adresse;
        $save->rib=$request->rib;
        $save->save();
        return BACK()->with('message', "La Banque a bien ete modifié!");
    }
    public function update1(Request $request,$id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id; 
        $save = OpeBanque::findOrFail($id);
        
        //$save->num_op = $trans;
        $save->operation=$request->operation;
        $save->libelle_operation=$request->libelle;
        //$save->operation=$request->operation;
        $save->type_op=$request->type;
        if($request->operation == 'Depot'){
        $save->credit=$request->montant;
        $save->debit=0;
        }
        if($request->operation == 'Retrait'){
        $save->credit=0;
        $save->debit=$request->montant;
        }
        $save->banque_id=$request->banque;
        $save->societe_id = $soce;
        $save->save();
         
        return BACK()->with('message', "Opération bancaire bien modifie !");
    }

    public function voir($numero){
       $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
       $soce = $Soci->societe_id;     
       $banks = OpeBanque::all()->Where('num_op',$numero)->Where('societe_id',$soce)->first();
        return view('saas-1.banque.list_op',compact('banks'));
    }
    
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $bank = OpeBanque::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($bank->validated == 0)
        {
            $message = "Operation supprimée avec succèss" ;
            $desc = str_replace('@','',"@DELETE-BANQUE") ;
            
            $bank->delete();
        }
        else
        {
            $erreur = "Suppression Operation non autorisée" ;
            $desc = "ESSAYE-DEL-BANQUE" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}