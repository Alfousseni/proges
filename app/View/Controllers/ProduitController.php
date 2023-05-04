<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
use App\Models\User;
use App\Models\Societe;
use App\Models\TypeProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProduitController extends Controller
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
        $types = TypeProduit::all()->Where('societe_id',$soce);
        $produits=Produit::all()->Where('societe_id',$soce);
        return view('saas-1.produit.index',compact('produits','types'));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $types = TypeProduit::all()->Where('societe_id',$soce);
        return view('saas-1.produit.create', compact('types')) ;
    }

    //liste de toutes les clients
    
    public function voirliste()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $produits = Produit::all()->Where('societe_id',$soce);
        return view ('saas-1.produit.voir', compact('produits')); 
    }
    public function liste()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $produits = Produit::all()->Where('societe_id',$soce);
        return view('saas-1.produit.list', compact('produits','Societ'));
        
    }
            // fin liste de toutes les clients

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
        //generation de refrence de produit debut
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $exe=date('Y');
        $date=substr($exe,2);
        $zero="00000";
        $numerooo="REFPROD".$soce.$date;
        $nombre=Produit::all()->Where('societe_id',$soce)->Count();
        $nombre++;
        if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
        else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
        else $zero=substr($zero,0,strlen($zero)-3);
        $numerooo.= $zero.$nombre;
        //generation de refrence de produit fin

        //controle sur les champs de saisie vide
        if($request->nom==""){
            return back()->with('message', "!!!! Des champs oblogatoires sont vides !!!!");
        }

        //controle sur les produit dispo
        elseif($request->nom!=""){
            $nb = Produit::all()->where('nom_prod',$request->nom)->count();	  
            if($nb!=0){
              return back()->with('message', "!!!! Ce produit existe déja !!!!");
            }
            else{
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
                $save = new Produit;
                $save->numero=$numerooo;
                $save->nom_prod = $request->nom;
                $save->type_produit_id = $request->type;
                $save->infos = $request->infos;
                $save->editorial = Auth::user()->email ;
                
                $save->societe_id = $Soci->societe_id;
                $save->infos = $request->infos;
                $save->save();

                $stock= new Stock;
                $stock->reference=$numerooo;
                $stock->nomprod = $request->nom;
                $stock->qte_stock=1;
                $stock->societe_id= $Soci->societe_id;
                //$stock->prix_achat=null;
                $stock->prix_vente=null;
                $stock->editorial = Auth::guard('web')->user()->email ;
                $stock->save();

                return BACK()->with('message', "Le produit a bien été crée!");
            }
        }        
        
    }

    //stoker les produits
    public function stock()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $stocks=Stock::all()->Where('societe_id',$soce);
        return view('saas-1.produit.stock',compact('stocks'));
    }

    public function stocker($id)
    {
        $stock=Stock::findOrfail($id);
        return view('saas-1.produit.stocker',compact('stock'));
    }

    public function finalisation(Request $request, $id)
    {
        $save=Stock::findOrFail($id);
        $save->reference=$request->ref;
        $save->nomprod=$request->nom;
        $save->qte_stock=$request->qte;
        
        if($request->prixv==""){
            $save->prix_vente=null;
        }else{
            $save->prix_vente=$request->prixv;
        }
        
        $save->save();
        return back()->with('message',"Votre produit e bien été stocker");
    }
    //fin stock


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */

    public function voir($numero){
        if(isset($numero)){  
            $refprod = $numero;
            $produit=Produit::all()->where('numero',$numero)->first();
            return view('saas-1.produit.fiche',compact('produit'));
        }
    }

    

    public function show($numero) {
        if(isset($numero)){  
            $refprod = $numero;
            $produit=Produit::all()->where('numero',$numero)->first();
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        return View('saas-1.produit.prod', compact('produit','Soci','Societ'));
}}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        
        $produit=Produit::findOrFail($id);
        $types = TypeProduit::all()->Where('societe_id',$soce);
        return view('saas-1.produit.edit', compact('types', 'produit')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            

        ]);
        $save =Produit::findorFail($id);
        $save->nom_prod = $request->nom;
        $save->type_produit_id = $request->typo;
        $save->infos = $request->infos;
        $save->editorial = Auth::user()->email ;
        
        $save->save();

        return BACK()->with('message', "Le  produit a bien été modifié!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $stocks=Stock::all()->where('reference', $produit->numero);
        $message = '' ;
        $erreur = '' ;
        if($produit->deletable == 0)
        {
            $message = "Produit supprimé avec succèss" ;
            $desc = str_replace('@','',"@DELETE-PRODUIT") ;
            $produit->delete();
            foreach($stocks as $stock)
            {
                $a=$stock->delete();
            }
        }
        else
        {
            $erreur = "Suppression de produit non autorisée" ;
            $desc = "ESSAYE-DEL-PRODUIT" ;
        }
        if($message != '')
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
    }
}