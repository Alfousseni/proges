<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produit;
use App\Models\Client;
use App\Models\User;
use App\Models\Societe;
use App\Models\TmpVente;
use App\Models\DetailVente;
use App\Models\Stock;
use App\Models\Facture;
use App\Models\Mouvement;
use App\Models\TransactionVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	$soce = $Soci->societe_id;
        $ventes=vente::all()->Where('societe_id',$soce)->where('etat',0);
        return view('saas-1.vente.index',compact('ventes'));
    }

    public function index2(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	$soce = $Soci->societe_id;
        $ventes=vente::all()->Where('societe_id',$soce)->where('etat',1);
        $factures=Facture::all()->Where('societe_id',$soce)->where('etat',1);
        return view('saas-1.vente.index2',compact('ventes','factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trans(){
        return view('saas-1.vente.add_trans');
    }

    public function transact(Request $request)
    {
        $validatedData = $request->validate([

        ]);
        //genreration du numero de transaction
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	    $soce = $Soci->societe_id;
        $zero="00000";
        $numerooo="TRTVTE".$soce;
        $nombre=TransactionVente::all()->Where('societe_id',$soce)->Count();
        $nombre++;
        if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
        else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
        else $zero=substr($zero,0,strlen($zero)-3);
        $numerooo.= $zero.$nombre;
        $trans = $numerooo;
        //fin 

        $ex=date('Y');
        $date=substr($ex,2);
        $mois=date('m');
        // generation du numero de produit//
        $zer="00000";
        $numero="VTE".$soce.$date.$mois;
        $nbre=Vente::all()->Where('societe_id',$soce)->Count();
        $nbre++;
        if($nbre<10) $zer=substr($zer,0,strlen($zer)-1);
        else if($nbre<100) $zer=substr($zer,0,strlen($zer)-2);
        else $zer=substr($zer,0,strlen($zer)-3);
        $numero.=$zer.$nbre;
        //fin

        if(($trans !="")){
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

            $save = new TransactionVente;
            $save->num_trans=$numerooo;
            $save->numcmd=$numero;
            $save->login= Auth::user()->email ;
            $tran=date('Y-m-d h:m:i');
            $save->date_cloture=$tran;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            $transs=TransactionVente::all()->Where('societe_id',$soce)->sortByDesc('id')->take(1);
	        $soce = $Soci->societe_id;
            $clients=Client::all()->Where('societe_id',$soce);
            $tmps=TmpVente::all()->Where('societe_id',$soce);
            $produits=Produit::all()->Where('societe_id',$soce)->sortBy('nom_prod');
            return view('saas-1.vente.create',compact('clients','tmps','produits','transs'));
		}
            
    }

    public function AjoutProduit(Request $request)
    {
        $validatedData = $request->validate([

        ]);
        
        if($request->refprod!="" && $request->nomprod!=""){
            $nd=TmpVente::all()->where('num_com',$request->num_com)->where('refprod',$request->refprod)->count();
            if($nd!=0){
                return BACK()->with('message', "Le produit existe deja dans le panier!");
            }else{
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

                $save = new TmpVente;
                $save->num_com=$request->num_com;
                $save->refprod=$request->refprod;
                $save->nomprod=$request->nomprod;
                $save->log_in= Auth::user()->email ;
                $save->societe_id = $Soci->societe_id;

		$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	        $soce = $Soci->societe_id;
                $clients=Client::all()->Where('societe_id',$soce);
                $tmps=TmpVente::all()->Where('societe_id',$soce);
                $produits=Produit::select('numero','nom_prod','qte');
                $transs=TransactionVente::all()->Where('societe_id',$soce)->sortByDesc('id')->take(1);  
                $save->save();
                return back()->with('message', "Produit ajouté au panier");
            }
        }
        else{
            return back();
        }
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
        
        $numc=$request->numc;
        if($request->modep!="" || $request->client!=""){
            $nb= count($request->ref);
            $i=0;
            for($i=0; $i<$nb; $i++){
                if( !isset($request->ref[$i]) ) $request->ref[$i] = '' ;
                if($request->prixu==''|| $request->qte==''){
                    return BACK()->with('message', "Insertion non reussi!!!! Des champs sont vides!!!!!");

                }
                
                else{ 
                
                    $stor = Stock::all()->where('reference',$request->ref[$i])->first();
                   
                    $qtes = $stor->qte_stock;
                    $qte= $request->qte[$i];
                    
                    if($qtes >= $qte ){
                   // $qter = $qtes - $qte;
                    $save = new DetailVente;
                    $save->num_com=$numc;
                    $save->refprod=$request->ref[$i];
                    $save->nomprod=$request->nom[$i];
                    $save->quantite=$qte;
                    $prixu=$request->prixu[$i];
                    $save->prix_unitaire=$prixu;
                    $prixht=$save->prix_ht=$prixu*$qte;
                    $tva=($prixht*18)/100;
                    if($societe->exoneration=="Oui"){
                	$save->mtn_tva=0;
	                $save->prix_ttc=$prixh;
	            }else{
	                $save->mtn_tva=$tva;
	                $save->prix_ttc=$prixht+$tva;
	            }
                    
                    $save->log_in= Auth::user()->email ;
                    $save->societe_id = $Soci->societe_id;
                    $save->save();
                    
                    // $up = Stock::where('reference', $request->ref[$i])->update(['qte_stock' => $qter]);
                     }
                     elseif($qtes < $qte )
                    { 
                    
                     return BACK()->with('message','vente impossible stock limité ');
                    }
                }
            }
            $detail=DetailVente::all();
            foreach($detail as $det){
                $societe=Societe::all()->where('id',$det->societe_id)->first();
            }
            $nbr=DetailVente::select('refprod')->where('num_com',$numc)->count();
            
           
            
            $vente = new Vente;
            $prixh=$vente->prix_ht= DetailVente::select('prix_ht')->where('num_com',$numc)->sum('prix_ht');
            $tva=($prixh*18)/100;
            $vente->num_com=$numc;
            $vente->num_client=$request->client;
            $vente->nbre_prod=$nbr;
            $vente->encaisser=$request->caisse;
            
            if($societe->exoneration=="Oui"){
                $vente->mtn_tva=0;
                $vente->prix_ttc=$prixh;

            }else{
                $vente->mtn_tva=$tva;
                $vente->prix_ttc=$prixh+$tva;
            }
            $vente->paiement=$request->modep;
            $vente->delai=$request->delai;
            $vente->echeance=$request->echeance;
            $vente->log_in= Auth::user()->email;
            $vente->societe_id = $Soci->societe_id;
            $tp=TmpVente::where('num_com',$numc)->delete();
            $vente->save();
            
           
            
            return back()->with('message',"La vente a été crée");
        }else{
            return back()->with('message', "Des champs sont vides !!!!!");
        }

    }

    public function validervente($num_com)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        if(isset($num_com)){  
            $numc = $num_com;
            
            $vente=Vente::all()->where('num_com',$numc);
            foreach($vente as $a){
                $a->update(['etat' => 1]);
            } 
            $tmp=TmpVente::all()->where('num_com',$numc);
            foreach($tmp as $b){
                $b->update(['etat' => 1, 'deletable' => 3]);
            }
            $trans=TransactionVente::all()->where('numcmd',$numc);
            foreach($trans as $c){
                $c->update(['etat' => 1, 'deletable' => 3]);
            }
            $detail=DetailVente::all()->where('num_com',$numc);
            foreach($detail as $d){
                $d->update(['etat' => 1, 'deletable' => 3]);
            }
          
            
            
            $ref = "";
	        $qte = "";
	        $client = "";
            $nom="";


	        $sec = Vente::all()->where('etat',1)->where('num_com',$numc);  
	        $nec = $sec->count();    
	        if($nec!=0){
                foreach($sec as $e){
		            $client = $e->num_client; 
                }
	        }
            
            $sed =DetailVente::all()->where('etat',1)->where('num_com',$numc); 
	        $ned = $sed->count();
	        if($ned!=0){
                foreach($sed as $f){
		            $ref = $f->refprod; 
		            $qte = $f->quantite; 
		            $pachat = $f->prix_unitaire;
                    $nom=$f-> nomprod;
		            $vec = Stock::all()->where('reference',$ref);
                    $qte_s="";
                    foreach($vec as $g){
                        $qte_s = $g->qte_stock;
                        $qtes = $qte_s-$qte;
                        $up = $g->update(['qte_stock' => $qtes]);
                    }
                    
                }

			}
               
		$sek = New Mouvement;  
                $sek->reference=$ref;
                $sek->numcmd=$numc;
                $sek->prix_achat=$pachat;
                $sek->qte_stock=$qte;
                $sek->numdest=$client;
                $sek->prix_vente=null;
                $sek-> editorial= Auth::user()->email;
                $sek->societe_id = $Soci->societe_id;
                $sek->save();
		

            $exe= date('Y');
            $mois= date('m');
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	    $soce = $Soci->societe_id;
            // generation du numero de facture//
            $zero="00000";
            $numerooo="FACLI".$soce.substr($exe,2).$mois; 
            $nombre=Facture::all()->Where('societe_id',$soce)->count() ;
            $nombre++;
            if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
            else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
            else $zero=substr($zero,0,strlen($zero)-3);
            $numerooo.=$zero.$nombre;
     
            // fin de generation du numero de facture//
     
     
     
            $je = Vente::all()->where('num_com',$numc);
            $jh= $je->count();
            if($jh!=0){
                $toti="";
                $ft =Facture::all()->Where('societe_id',$soce)->sortByDesc('id')->take(1);
                $nf = $ft->count();
                if($nf!=0){
                    foreach($ft as $h){
                        $tot = $h['tot'];
                        $toti = $tot + 1;
                    }
                }
     
                $sql = New Facture;
                $sql->numfac=$numerooo;
                $sql->num_com=$numc;
                $conv="";
                foreach($je as $j){
                    $sql->num_client=$j->num_client;
                    $sql->nbre_prod=$j->nbre_prod;
                    $sql->encaisser=$j->encaisser;
                    $sql->prix_ht=$j->prix_ht;
                    $sql->mnt_tva=$j->mtn_tva;
                    $sql->prix_ttc=$j->prix_ttc;
                    $sql->paiement=$j->paiement;
                    $delai =$j->delai;
                    $date =$j->created_at;
                    $conv= date("Y-m-d", strtotime($date.  + $delai. ' days') );  
                    $sql->livraison=$conv;
                    $sql->echeance=$j->echeance;
                    $sql->societe_id = $Soci->societe_id;
                    $sql->log_in=Auth::user()->email;
                    $sql->etat=1;
                } 
                $sql->save();
                $poste =$j->num_client; 
                $empl = Client::where('numero', $poste)->update(['etat' => 1]);
                $cmd =$f->refprod; 
                $cp =Produit::where('numero', $cmd)->update(['validated' => 1]);
                $dat = Vente::where('num_com', $numc)->update(['livraison' => $conv]);
                $cmd =$f->refprod;
                
            }
            return back()->with('message',"!!!! Validation Reussi !!!!");
        }
        else{
            return back()->with('message',"!!!! La Validation a echoué !!!!");
         
        }
            
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     * 
     */

    public function show($id){
        $vente=Vente::findOrFail($id);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $clients=Client::all()->where('numero',$vente->num_client)->Where('societe_id',$soce);
        return view('saas-1.vente.bon',compact('vente','clients','Soci','Societ'));

    }

    public function factureVente($id){
        $vente=Vente::findOrFail($id);
        $clients=Client::all()->where('numero',$vente->num_client);
        $details=DetailVente::all()->where('num_com',$vente->num_com);
        $nns= $details->Count();
        return view('saas-1.vente.bvte',compact('vente','clients','details'));
    }


    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     * 
     */

   
    public function modifievnteeffective($id)
    {
        $vente=Vente::findOrFail($id);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	   $soce = $Soci->societe_id;
        $transs=TransactionVente::all()->where('numcmd',$vente->num_com)->Where('societe_id',$soce)->sortByDesc('id')->take(1);
        $clients=Client::all()->Where('societe_id',$soce);
        $tmps=DetailVente::all()->where('num_com',$vente->num_com)->Where('societe_id',$soce);
        $produits=Produit::all()->Where('societe_id',$soce)->sortBy('nom_prod');
        return view('saas-1.vente.edit-1
        ',compact('clients','tmps','produits','transs','vente'));
		    
    }
    public function update1(Request $request,$id)
    {

        $validatedData = $request->validate([

        ]);
        $numc=$request->numc;
        if($request->modep!="" || $request->client!=""){
            $nb= count($request->ref);
            $i=0;
            for($i=0; $i<$nb; $i++){
                if( !isset($request->ref[$i]) ) $request->ref[$i] = '' ;
               

                else{ 
                    $save = DetailVente::find($id);
                    $save->num_com=$numc;
                    $save->refprod=$request->ref[$i];
                    $save->nomprod=$request->nom[$i];
                    $qte=$request->qte[$i];
                    $save->quantite=$qte;
                    $prixu=$request->prixu[$i];
                    $save->prix_unitaire=$prixu;
                    $prixht=$save->prix_ht=$prixu*$qte;
                    $save->mtn_tva=0;
                    $save->prix_ttc=$prixht;
                    $save->log_in= Auth::user()->email ;
                    $save->save();
                }
            }
            $commande =  Vente::find($id);
            $commande->num_com=$numc;
            $commande->num_client=$request->client;
            $nbr=DetailVente::select('refprod')->where('num_com',$numc)->count();
            $commande->nbre_prod=$nbr;
            $commande->encaisser=$request->caisse;
            $prixh=$commande->prix_ht=DetailVente::select('prix_ht')->where('num_com',$numc)->sum('prix_ht');
            $commande->mtn_tva=0;
            $commande->prix_ttc=$prixh;
            $commande->paiement=$request->modep;
            $commande->livraison=$request->livraison;
            $commande->echeance=$request->echeance;
            $commande->log_in= Auth::user()->email;
            $commande->save();
            return view('saas-1.commande.add_trans')->with('message', "!!!! Modification reussi !!!!!");
        }
}
public function edit($id)
{
    $vente=Vente::findOrFail($id);
    $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
    $soce = $Soci->societe_id;
    $transs=TransactionVente::all()->where('numcmd',$vente->num_com)->Where('societe_id',$soce)->sortByDesc('id')->take(1);
    $clients=Client::all()->Where('societe_id',$soce);
    $tmps=DetailVente::all()->where('num_com',$vente->num_com)->Where('societe_id',$soce);
    $produits=Produit::all()->Where('societe_id',$soce)->sortBy('nom_prod');
    return view('saas-1.vente.edit',compact('clients','tmps','produits','transs','vente'));
        
}

    public function update(Request $request,$id)
    {

        $validatedData = $request->validate([

        ]);
        $numc=$request->numc;
        
            $nb= count($request->ref);
            $i=0;
            for($i=0; $i<$nb; $i++){
                $save = DetailVente::find($id);
                    $save->num_com=$numc;
                    $save->refprod=$request->ref[$i];
                    $save->nomprod=$request->nom[$i];
                    $qte=$request->qte[$i];
                    $save->quantite=$qte;
                    $prixu=$request->prixu[$i];
                    $save->prix_unitaire=$prixu;
                    $prixht=$save->prix_ht=$prixu*$qte;
                    $save->mtn_tva=0;
                    $save->prix_ttc=$prixht;
                    $save->log_in= Auth::user()->email ;
                    $save->save();
                }
            $commande = Vente::findOrFail($id);
            $commande->num_com=$numc;
            $commande->num_client=$request->client;
            $nbr=DetailVente::select('refprod')->where('num_com',$numc)->count();
            $commande->nbre_prod=$nbr;
            $prixh=$commande->prix_ht=DetailVente::select('prix_ht')->where('num_com',$numc)->sum('prix_ht');
            $commande->mtn_tva=0;
            $commande->prix_ttc=$prixh;
            $commande->paiement=$request->modep;
            $commande ->delai=$request->delai;
           // $date =$i->updated_at;
            // $conv= date("Y-m-d", strtotime($date.  + $delai. ' days') );  
            // $commande->livraison=$conv;
           // $commande->livraison=$request->livraison;
            $commande->echeance=$request->echeance;
            $commande->log_in= Auth::user()->email;
            $commande->save();
            return back()->with('message', "!!!! Modification reussi !!!!!");
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vente)
    {
        //
    }

    public function supprod($refprod)
    {
        if(isset($refprod)){ 
            $ref = $refprod;
            $tmp=TmpVente::all()->where('refprod',$ref);
            $nb=$tmp->count();
            if($nb!=0){
                foreach($tmp as $b){
                    $c=$b->delete();
                }
                $detail=DetailVente::where('refprod',$ref)->delete();
                return back()->with('message',"La Ligne de vente a été supprimé avec succés!!!");
            }
            else{
                return back()->with('message',"La Ligne de vente n'a pas été supprimé!!!");

            }
        }
    }

    Public function supvente($num_com){
        if(isset($num_com)){
            $num = $num_com;
            $trans =TransactionVente::all()->where('numcmd',$num);
            $nb=$trans->count();
            if($nb!=0){
                foreach($trans as $a){
                $cmd=$a->numcmd;
                }
                $b= TransactionVente::where('numcmd',$cmd)->delete();
                $tmp=TmpVente::where('num_com',$cmd)->delete();
                $detail=DetailVente::where('num_com',$cmd)->delete();
                $vente=Vente::where('num_com',$cmd)->delete();
	        }return back()->with('message',"La vente a été supprimé avec succés!!!");
        }
        else{
            return back()->with('error',"La vente  n'a pas été supprimé!!!");

        }
    
    }
}