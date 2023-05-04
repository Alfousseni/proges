<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fonction;
use App\Models\Block;
use App\Models\Menu;
use Image;

class AccueilController extends Controller
{
    public function accueil(){
        return view ('front.pages.main');
    }
    public function inscription(){
    $Fonctions = Fonction::all()->where('etat', 1);
    return view('front.pages.inscription', compact('Fonctions'));
    }
    public function client(){
        return view ('front.pages.client');
    }
    public function fonction(){
    $Fonctions = Fonction::all()->where('etat', 1);
    return view('front.pages.fonction', compact('Fonctions'));
    }
    public function control(){
        return view ('front.pages.stock');
    }
    public function achat(){
        return view ('front.pages.achat');
    }
    public function vente(){
        return view ('front.pages.vente');
    }
    public function produit(){
        return view ('front.pages.produit');
    }
    public function fact(){
        return view ('front.pages.fact');
    }
    public function agenda(){
        return view ('front.pages.agenda');
    }
    public function compta(){
        return view ('front.pages.compta');
    }
    public function contact(){
        return view ('front.pages.contact');
        
    }
    public function devis(){
        return view ('front.pages.demander_devis');
        
    }
    public function Navig(){

        $Block=""; 
        $Menus="";
        $Men="";
        $Blocks = Block::all()->where('etat', 1);
        foreach($Blocks as $block){
        $Menus = Menu::all()->where('parent', 0)->where('block_id', $block->id);
        foreach($Menus as $mens){
        $Men = Menu::all()->where('etat', 1)->where('parent', $mens->parent);
        
            }
        }
        return view::make('saas-1.pou.leftside',compact('Blocks','$Menus','$Men'));
        
    }
    
}