<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Image;

class AccueilController extends Controller
{
    public function accueil(){
        return view ('FRONT.main');
    }
    public function inscription(){
    $modules = Module::all()->where('etat', 1);
    return view('FRONT.inscription', compact('modules'));
    }
    public function client(){
        return view ('FRONT.client');
    }
    public function control(){
        return view ('FRONT.stock');
    }
    public function achat(){
        return view ('FRONT.achat');
    }
    public function vente(){
        return view ('FRONT.vente');
    }
    public function produit(){
        return view ('FRONT.produit');
    }
    public function fact(){
        return view ('FRONT.fact');
    }
    public function agenda(){
        return view ('FRONT.agenda');
    }
    public function compta(){
        return view ('FRONT.compta');
    }
    public function contact(){
        return view ('FRONT.contact');
        
    }
    public function devis(){
        return view ('FRONT.demander_devis');
        
    }
    
}
