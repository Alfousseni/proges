<?php

namespace App\Http\Controllers;
use App\Models\JournalCaisse;
use App\Models\User;
use App\Models\Banque;
use App\Models\OpeBanque;
use App\Models\Societe;
use App\Models\Facture;
use App\Models\bon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JournalCaisseController extends Controller
{
    //caisse
    public function JournalCaisse(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        
        $journals = JournalCaisse::all()->Where('societe_id','=',$soce);
        
        return view('saas-1.journaux.journal_caisse', compact('journals'));
    }

    public function listejournalcaisse(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=JournalCaisse::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.caisse',compact('journaux','Societ'));
    }
    
    public function listejournalcaisse1(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $journaux=JournalCaisse::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.journaux.list_journal_caisse',compact('journaux','debut','fin'));
    }
    public function voircaisse($debut, $fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $journaux=JournalCaisse::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.journaux.caisse1',compact('journaux', 'Societ','debut','fin'));
    }
    //fin

    //vente
    public function journalvente(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	$soce = $Soci->societe_id;
        $factures=Facture::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.journal_vente',compact('factures'));
    }

    public function listejournalvente(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $factures=Facture::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.vente',compact('factures', 'Societ'));
    }

   public function listejournalvente1(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $factures = Facture::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id','=',$soce);
        return view('saas-1.journaux.list_journal_vente1',compact('factures','Soci','debut','fin'));
    }

    
    
    public function voirvente1($debut,$fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        
        $factures = Facture::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id','=',$soce);
        //var_dump($factures); die();
        return view('saas-1.journaux.vente1',compact('factures', 'Societ','debut','fin'));
    }
    //fin

    //achat
    public function journalachat(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
	    $soce = $Soci->societe_id;
        $bons=Bon::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.journal_achat',compact('bons'));
    }
    public function listejournalachat(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $bons=Bon::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.achat',compact('bons' ,'Societ'));
    }
    
     public function listejournalachat1(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $bons = Bon::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id','=',$soce);
        return view('saas-1.journaux.list_journal_achat1',compact('bons','Soci','debut','fin'));
    }
    public function voirachat($debut,$fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $bons = Bon::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id','=',$soce);
        //var_dump($bons);
        return view('saas-1.journaux.achat1',compact('bons', 'Societ','debut','fin'));
    }
    //fin
     
     
    
     public function JournalBanque(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $banks=OpeBanque::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.journal_banque',compact('banks'));
    }
    
    public function listejournalbanque(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $banks=OpeBanque::all()->Where('societe_id',$soce);
        return view('saas-1.journaux.banque',compact('banks' ,'Societ'));
    }
    
     public function listejournalbanque1(Request $request){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $debut=$request->debut;
        $fin= $request->fin;
        $banks=OpeBanque::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id','=',$soce);
        return view('saas-1.journaux.list_journal_banque1',compact('banks','Soci','debut','fin'));
    }
    
    
    public function voirOpebanque($debut,$fin) {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $banks=OpeBanque::all()->whereBetween('created_at', [$debut, $fin])->Where('societe_id',$soce);
        return view('saas-1.journaux.banque1',compact('banks','Societ','debut','fin'));
    }
     
     
     
    
}