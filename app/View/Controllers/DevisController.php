<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\DevisSend;
use App\Models\Fournisseur;
use App\Models\DetailDevis;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\TmpDevis;
use App\Models\Produit;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DevisController extends Controller
{


     
    public function listedevis()
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;             
        
        $deviss=Devis::all()->Where('societe_id',$soce);
        return view('saas-1.devis.liste_devis', compact('deviss'));
    }

    public function devi()
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;             
        
        $frs = fournisseur::all()->Where('societe_id',$soce);
        $produits=Produit::All()->Where('societe_id',$soce);
        $tmps=TmpDevis::all()->Where('societe_id',$soce);
        return view('saas-1.devis.devis', compact('frs','produits','tmps'));
    }

    
    public function AjoutProduit(Request $request)
    {
        $validatedData = $request->validate([

        ]);
        if($request->refprod!="" && $request->nomprod!=""){
            $nd=TmpDevis::all()->where('refprod',$request->refprod)->count();
            if($nd!=0){
                return BACK()->with('message', "Le produit existe deja!");
            }else{
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
                $soce = $Soci->societe_id;  
                $save = new TmpDevis;
                $save->refprod=$request->refprod;
                $save->nomprod=$request->nomprod;
                $save->log_in= Auth::user()->email;
                $save->societe_id = $Soci->societe_id;

                $tmps=TmpDevis::all()->Where('societe_id',$soce);
                $produits=Produit::select('numero','nom_prod','qte')->Where('societe_id',$soce);  
                $save->save();
                return back()->with('message',"Produit ajouté avec succes");
            }
        }
    }

    public function supprod($refprod)
    {
        if(isset($refprod)){ 
            $ref = $refprod;
            $tmp=TmpDevis::all()->where('refprod',$ref);
            $nb=$tmp->count();
            if($nb!=0){
                foreach($tmp as $b){
                    $c=$b->delete();
                }
                return back()->with('message',"La Ligne de vente a été supprimé avec succés!!!");
            }
            else{
                return back()->with('message',"La Ligne de vente n'a pas été supprimé!!!");

            }
        }
    }

    public function detail($id)
    {
       $devis=Devis::findOrFail($id);
       $deviss=DevisSend::all()->where('devis_id',$devis->id);
       return view("saas-1.devis.devis_send",compact('devis','deviss'));
    }

    public function pdfdevis($id){
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            $devis=DevisSend::findOrfail($id);
            return view('saas-1.devis.dev',compact('devis','Societ'));
    }

    public function dev($id){
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            $devis=DevisSend::findOrfail($id);
            return view('saas-1.devis.pdev',compact('devis','Societ'));
    }

    public function ValiderDevis($id){
            $devis=DevisSend::FindorFail($id);
            $num=$devis->numDev;
            $up=$devis->update(['etat' => 0, 'deletable' => 3]);

            $autre=DevisSend::all()->where('numDev',$num)->where('id','<>',$devis->id);
            foreach($autre as $c){
                $c->update(['deletable' => 3]);
            } 



            $detail=DetailDevis::all()->where('num_dev',$num);
            foreach($detail as $a){
                $a->update(['etat' => 1]);
            } 

            $devi=Devis::all()->where('numero',$num);
            foreach($devi as $b){
                $b->update(['etat' => 1, 'deletable' => 3]);
            }      
            return back()->with('message','le devis a été validé avec success');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id; 
    	$deviss=DevisSend::all()->where('etat',0)->Where('societe_id',$soce);
        return view("saas-1.devis.liste_valide",compact('deviss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    { 
    	$devis=DevisSend::findOrFail($id);
        $dets=DetailDevis::all()->where('num_dev',$devis->numDev);
        return view("saas-1.devis.commande",compact('devis','dets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $societe=Societe::all()->where('id',$Soci->societe_id)->first();
        $soce=$societe->id;
        $ex=date('Y');
        $date=substr($ex,2);
        $mois=date('m');
        // generation du numero de commande//
        $zer="00000";
        $numero="CMD".$soce.$date.$mois;
        $nbre=Commande::all()->where('societe_id',$Soci->societe_id)->Count();
        $nbre++;
        if($nbre<10) $zer=substr($zer,0,strlen($zer)-1);
        else if($nbre<100) $zer=substr($zer,0,strlen($zer)-2);
        else $zer=substr($zer,0,strlen($zer)-3);
        $numero.=$zer.$nbre;
        //fin

        if($request->modep!="" || $request->frs!=""){
            $nb= count($request->ref);
            $i=0;
            for($i=0; $i<$nb; $i++){
                if( !isset($request->ref[$i]) ) $request->ref[$i] = '' ;
                if($request->prixu==''|| $request->qte==''){
                    return BACK()->with('message', "Insertion non reussi!!!! Des champs sont vides!!!!!");

                }else{ 
                    
                    $save = new DetailCommande;
                    $save->num_com=$numero;
                    $save->refprod=$request->ref[$i];
                    $save->nomprod=$request->nom[$i];
                    $qte=$request->qte[$i];
                    $save->quantite=$qte;
                    $prixu=$request->prixu[$i];
                    $save->prix_unitaire=$prixu;
                    $prixht=$save->prix_ht=$prixu*$qte;
                    $tva=($prixht*18)/100;
                    if($societe->exoneration=="Oui"){
                	$save->mtn_tva=0;
	                $save->prix_ttc=$prixht;
	            }else{
	                $save->mtn_tva=$tva;
	                $save->prix_ttc=$prixht+$tva;
	            }
                    
                    $save->log_in= Auth::user()->email ;
                    $save->societe_id = $Soci->societe_id;
                    $save->save();
                }
            }
            $commande = new Commande;
            $commande->num_com=$numero;
            $commande->numfour=$request->frs;
            $nbr=DetailCommande::select('refprod')->where('num_com',$numero)->count();
            $commande->nbre_prod=$nbr;
            $prixh=$commande->prix_ht=DetailCommande::select('prix_ht')->where('num_com',$numero)->sum('prix_ht');
            $tva=($prixh*18)/100;
            if($societe->exoneration=="Oui"){
                $commande->mtn_tva=0;
                $commande->prix_ttc=$prixh;

            }else{
                $commande->mtn_tva=$tva;
                $commande->prix_ttc=$prixh+$tva;
            }
            $commande->modep=$request->modep;
            $commande->paiement=$request->delai;
            $commande->livraison=$request->livraison;
            $commande->execution=$request->execution;
            $commande->societe_id = $Soci->societe_id;
            $commande->log_in= Auth::user()->email;
            $commande->save();
            return back()->with('message',"La Commande a été crée");
        }else{
            return back()->with('message', "Des champs sont vides !!!!!");
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depot  $depot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devis=DevisSend::findOrFail($id);
        $dets=DetailDevis::all()->where('num_dev',$devis->numDev);
        return view("saas-1.devis.commande",compact('devis','dets'));

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