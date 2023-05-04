<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use App\Models\Societe;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Stock;
use App\Models\Mouvement;
use App\Models\TmpCommande;
use App\Models\DetailCommande;
use App\Models\bon;
use App\Models\TransactionCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //liste des Commandes en cours
    public function index()
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        //$Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $commandes=Commande::all()->where('etat',0)->where('societe_id',$Soci->societe_id);
        
        return view('saas-1.commande.index',compact('commandes'));
    }
    //fin

    //liste des Commandes livrés
    public function index2()
    {
    	$Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $commandes=Commande::all()->where('etat',1)->where('societe_id',$Soci->societe_id);
        return view('saas-1.commande.index2',compact('commandes'));
    }
    //fin


    public function trans()
    {
        return view('saas-1.commande.add_trans');
    }

    public function transact(Request $request)
    {
        
        $validatedData = $request->validate([

        ]);

        //genreration du numero de transaction
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $zero="00000";
        $numerooo="TRCMD".$soce;
        $nombre=TransactionCommande::all()->where('societe_id',$Soci->societe_id)->Count();
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
        $numero="CMD".$soce.$date.$mois;
        $nbre=Commande::all()->where('societe_id',$Soci->societe_id)->Count();
        $nbre++;
        if($nbre<10) $zer=substr($zer,0,strlen($zer)-1);
        else if($nbre<100) $zer=substr($zer,0,strlen($zer)-2);
        else $zer=substr($zer,0,strlen($zer)-3);
        $numero.=$zer.$nbre;
        //fin

        if(($trans !="")){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

            $save = new TransactionCommande;
            $save->num_trans=$numerooo;
            $save->numcmd=$numero;
            $save->login = Auth::user()->email;
            $tran=date('Y-m-d h:m:i');
            $save->date_cloture=$tran;
            $save->societe_id = $Soci->societe_id;
            $save->save();
            $tras=TransactionCommande::all()->Where('societe_id',$soce)->sortByDesc('id')->take(1);
		    
            $fournisseurs=fournisseur::all()->where('societe_id',$Soci->societe_id);
            $tmps=TmpCommande::all()->where('societe_id',$Soci->societe_id);
            $produits=Produit::all()->where('societe_id',$Soci->societe_id)->sortBy('nom_prod');
            return view('saas-1.commande.create',compact('fournisseurs','tmps','produits','tras'))->with('vous pouvez effectuer votre commande');
		}
        else{
            return back()->with('message',"la creation a echoué");		
        }           
    }

    public function AjoutProduit(Request $request)
    {
        $validatedData = $request->validate([

        ]);
        
        if($request->refprod!="" && $request->nomprod!=""){
            $nd=TmpCommande::all()->where('num_com',$request->num_com)->where('refprod',$request->refprod)->count();
            if($nd!=0){
                return BACK()->with('message', "Le produit existe deja dans le panier!");
            }else{
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
                $soce=$Soci->societe_id;
                $save = new TmpCommande;
                $save->num_com=$request->num_com;
                $save->refprod=$request->refprod;
                $save->nomprod=$request->nomprod;
                $save->log_in= Auth::user()->email ;
                $save->societe_id = $Soci->societe_id;

                $fournisseurs=fournisseur::all();
                $tmps=TmpCommande::all()->where('societe_id',$Soci->societe_id);
                $produits=Produit::select('numero','nom_prod','qte')->where('societe_id',$Soci->societe_id);
                $transs=TransactionCommande::all()->Where('societe_id',$soce)->sortByDesc('id')->take(1);
                $save->save();
                return back()->with('message',"produit ajouté avec succes");
            }
        }
        else{
            return back();
        }
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
        $validatedData = $request->validate([

        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $societe=Societe::all()->where('id',$Soci->societe_id)->first();
        $numc=$request->numc;
        if($request->modep!="" || $request->fournisseur!=""){
            $nb= count($request->ref);
            $i=0;
            for($i=0; $i<$nb; $i++){
                if( !isset($request->ref[$i]) ) $request->ref[$i] = '' ;
                if($request->prixu==''|| $request->qte==''){
                    return BACK()->with('message', "Insertion non reussi!!!! Des champs sont vides!!!!!");

                }else{ 
                    
                    $save = new DetailCommande;
                    $save->num_com=$numc;
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
            $commande->num_com=$numc;
            $commande->numfour=$request->fournisseur;
            $nbr=DetailCommande::select('refprod')->where('num_com',$numc)->count();
            $commande->nbre_prod=$nbr;
            $prixh=$commande->prix_ht=DetailCommande::select('prix_ht')->where('num_com',$numc)->sum('prix_ht');
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
            $tp=TmpCommande::where('num_com',$numc)->delete();
            $commande->save();
            return back()->with('message',"La Commande a été crée");
        }else{
            return back()->with('message', "Des champs sont vides !!!!!");
        }

    }

    public function validercommande($num_com)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

        if(isset($num_com)){  
            $numc = $num_com;
            $commande=Commande::all()->where('num_com',$numc);
            foreach($commande as $a){
                $a->update(['etat' => 1]);
            } 
            $tmp=TmpCommande::all()->where('num_com',$numc);
            foreach($tmp as $b){
                $b->update(['etat' => 1, 'deletable' => 3]);
            }
            $trans=TransactionCommande::all()->where('numcmd',$numc);
            foreach($trans as $c){
                $c->update(['etat' => 1, 'deletable' => 3]);
            }
            $detail=DetailCommande::all()->where('num_com',$numc);
            foreach($detail as $d){
                $d->update(['etat' => 1, 'deletable' => 3]);
            }
            
            $ref = "";
	        $qte = "";
	        $fournisseur = "";
            $nom="";


	        $sec = Commande::all()->where('etat',1)->where('num_com',$numc);  
	        $nec = $sec->count();    
	        if($nec!=0){
                foreach($sec as $e){
		            $fournisseur = $e->numfour; 
                }
	        }
            
            $sed =DetailCommande::all()->where('etat',1)->where('num_com',$numc); 
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
                        $qtes = $qte_s+$qte;
                        $up = $g->update(['qte_stock' => $qtes]);
                        }
                    }
                    
                }

	        $sek = New Mouvement;  
                $sek->reference=$ref;
                $sek->numcmd=$numc;
                $sek->prix_achat=$pachat;
                $sek->qte_stock=$qte;
                $sek->numdest=$fournisseur;
                $sek->prix_vente=null;
                $sek-> editorial= Auth::user()->email; 
                $sek->societe_id = $Soci->societe_id;
                $sek->save();
		
 		    

            $exe= date('Y');
            $mois= date('m');
     
            // generation du numero de bon//
            $soce = $Soci->societe_id;
            $zero="00000";
            $numerooo="BON".$soce.substr($exe,2).$mois; 
            $nombre=bon::all()->where('societe_id',$Soci->societe_id)->count() ;
            $nombre++;
            if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
            else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
            else $zero=substr($zero,0,strlen($zero)-3);
            $numerooo.=$zero.$nombre;
     
            // fin de generation du numero de bon//
     
     
     
            $je = Commande::all()->where('num_com',$numc)->where('societe_id',$Soci->societe_id);
            $jh= $je->count();
            if($jh!=0){
                $toti="";
                $ft = bon::all()->where('societe_id',$Soci->societe_id)->sortByDesc('id')->take(1);
                $nf = $ft->count();
                if($nf!=0){
                    foreach($ft as $h){
                        $tot = $h['tot'];
                        $toti = $tot + 1;
                    }
                }
     
                $sql = New bon;
                $sql->numBON=$numerooo;
                $sql->num_com=$numc;
                foreach($je as $j){
                    $sql->numfour=$j->numfour;
                    $sql->nbre_prod=$j->nbre_prod;
                    $sql->prix_ht=$j->prix_ht;
                    $sql->mnt_tva=$j->mtn_tva;
                    $sql->encaisser=$j->mtn_paye;
                    $sql->prix_ttc=$j->prix_ttc;
                    $sql->modep=$j->modep;
                    $sql->paiement=$j->paiement;
                    $sql->livraison=$j->livraison;
                    $sql->execution=$j->execution;
                    $sql->societe_id = $Soci->societe_id;
                    
                    $sql->log_in=Auth::user()->email;
                    $sql->etat=1;
                }
                $sql->save();
                $poste =$j->numfour; 
                $empl =Fournisseur::where('numero', $poste)->update(['validated' => 1]);
                $cmd =$f->refprod; 
                $cp =Produit::where('numero', $cmd)->update(['validated' => 1]);
                
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
     * @param  \App\Models\Commande  $Commande
     * @return \Illuminate\Http\Response
     * 
     */


    public function show($id){
        $commande=Commande::findOrFail($id);
        $frs=Fournisseur::all()->where('numero',$commande->numfour);
        $details=DetailCommande::all()->where('num_com',$commande->num_com);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        return view('saas-1.commande.bon',compact('commande','frs','details','Societ'));
    }

    public function bon($id){
        $commande=Commande::findOrFail($id);
        return view('saas-1.commande.bvte',compact('commande'));
        }
    
    
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        
        $commande=Commande::findOrFail($id);
        $tras=TransactionCommande::all()->where('societe_id',$Soci->societe_id)->where('numcmd',$commande->num_com)->take(1);
        $fournisseurs=fournisseur::all()->where('societe_id',$Soci->societe_id)->sortBy('nom');
        $produits=Produit::all()->where('societe_id',$Soci->societe_id)->sortBy('nom_prod');
        $tmps=DetailCommande::all()->where('num_com',$commande->num_com);
        
        return view('saas-1.commande.edit', compact('commande','tras','fournisseurs','tmps','produits'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $Commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $Commande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
}
public function supprodcom($refprod)
{
    if(isset($refprod)){ 
        $ref = $refprod;
        $tmp=TmpCommande::all()->where('refprod',$ref);
        $nb=$tmp->count();
        if($nb!=0){
            foreach($tmp as $b){
                $c=$b->delete();
            }
            $detail=DetailCommande::where('refprod',$ref)->delete();
            return back()->with('message',"La Ligne de Commande a été supprimé avec succés!!!");
        }
        else{
            return back()->with('message',"La Ligne de Commande n'a pas été supprimé!!!");

        }
    }
}

 public function regler($id)
    {
    	 
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
	$cmds =  Commande::all()->Where('id',$id);
	 
        return view('saas-1.commande.regul',compact('cmds'));
     
         
    }   

 public function regulariser(Request $request,$id)
    {
    	$validatedData=$request->validate([
            'montant'=>'required', 
          
        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
	$fac=  Commande::findOrFail($id);
	$fmnt = $fac->mtn_paye;
	$enc = $fmnt + $request->montant;
	$num = $fac->num_com; 
	
      	$save = Commande::findOrFail($id);
        $save->mtn_paye= $enc;
        $save->save();
        
        $sav = Bon::all()->where('num_com',$num)->Where('societe_id',$soce)->first();
        $sav->encaisser = $enc;
        $sav->save();
        
        $commandes = Commande::all()->where('etat',1)->Where('societe_id',$soce);
        return BACK()->with('message', "La régularisation a bien été faites avec succés!");
        
    }

Public function supcommande($num_com){
    if(isset($num_com)){
        $num = $num_com;
        $trans =TransactionCommande::all()->where('numcmd',$num);
        $nb=$trans->count();
        if($nb!=0){
            foreach($trans as $a){
            $cmd=$a->numcmd;
            }
            $b= TransactionCommande::where('numcmd',$cmd)->delete();
            $tmp=TmpCommande::where('num_com',$cmd)->delete();
            $detail=DetailCommande::where('num_com',$cmd)->delete();
            $commande=Commande::where('num_com',$cmd)->delete();
            return back()->with('message',"La Commande a été supprimé avec succés!!!");
        }
        else{
            return back()->with('error',"La Commande n'a pas été supprimé!!!");

        }
    }
}
}