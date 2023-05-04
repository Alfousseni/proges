<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\DetailDevis;
use App\Models\TmpDevis;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use App\Mail\Devi;
use App\Models\Devis;
use App\Models\DevisSend;




class EmailController extends Controller
{
    public function create()
    {
        return view('email');
    }

    public function sendEmail(Request $request)
    {
        $capt = $request->capt;
        $capts = $request->capt1;
        if($capt!= $capts ){
            return back()->with('message', "Veuillez remplir ce champ vide");
        } 
        elseif ($capt== $capts ){
            Mail::to('noreply@proges-pme.com')
            ->send(new Contact($request->except('_token')));
            return back()->with(['message' => 'Email envoyé avec succés. Merci votre messsage a été bien envoye']);
        } 
    }

    public function sendDevis(Request $request)
    {
        
        $validatedData=$request->validate([   
        ]);
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $ex=date('Y');
        $date=substr($ex,2);
        $mois=date('m');
         // generation du numero de produit//
        $zer="0000";
        $numero="DV".$soce.$date.$mois;
        $nbre=Devis::all()->where('societe_id',$Soci->societe_id)->Count();
        if($nbre!=0){
            $nombre=Devis::all()->where('societe_id',$Soci->societe_id)->last();
            $numm = $nombre->numero;
            $numo = substr($numm,-4);
            $numo++;
            if($numo<10) $zer=substr($zer,0,strlen($zer)-1);
            else if($numo<100) $zer=substr($zer,0,strlen($zer)-2);
            else $zer=substr($zer,0,strlen($zer)-3);
            $numero.=$zer.$numo;
        }
        else{
            $nbre++;
            if($nbre<10) $zer=substr($zer,0,strlen($zer)-1);
            else if($nbre<100) $zer=substr($zer,0,strlen($zer)-2);
            else $zer=substr($zer,0,strlen($zer)-3);
            $numero.=$zer.$nbre;
        }
        $n=count($request->ref);
        $i=0;
        for($i=0; $i<$n; $i++){
            if(!isset($request->ref[$i])) $request->ref[$i] = '' ;
            if($request->qte==''){
              return BACK()->with('message', "Insertion non reussi!!!! Des champs sont vides!!!!!");
            }
            else{
                $save=new DetailDevis;
                $save->num_dev=$numero;
                $save->refprod=$request->ref[$i];
                $save->nomprod=$request->nom[$i];
                $save->qte_prod=$request->qte[$i];
                $save->log_in=Auth::user()->email ;
                $save->societe_id = $Soci->societe_id;
                $save->save();
            }
        }
        
        $nbr=DetailDevis::select('refprod')->where('num_dev',$numero)->count();

        $nb=count($request->frs);
        
            $devis=new Devis;
            $devis->numero=$numero;
            $devis->numfour=$nb;
            $devis->produit=$nbr;
            $devis->log_in=Auth::user()->email ;
            $devis->info=$request->message;
            $devis->societe_id = $Soci->societe_id;
            $tp=TmpDevis::all();
            foreach($tp as $a){
                $d=$a->delete();
            }
            $devis->save();
        $dev = Devis::all()->where('numero',$numero)->SortByDesc('id')->first();
        $j=0;
        for($j=0; $j<$nb; $j++){
            $send = new DevisSend;
            $send ->devis_id = $dev->id;
            $send ->numDev=$numero;
            $send ->numfour=$request->frs[$j];
            $send ->etat=1;
            $send ->deletable=0;
            $send->societe_id = $Soci->societe_id;
            $send->save();

            $email= Fournisseur::all()->where('numero',$request->frs[$j])->first();
            Mail::to($email->email)
            ->send(new Devi($request->except('_token')));
        }
        return back()->with(['message' => 'Devis envoyé avec succés. Merci votre messsage a été bien envoye']);   
    }
    
}