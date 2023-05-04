<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\User;
use App\Models\Produit;
use App\Models\Magasin;
use App\Models\Societe;
use App\Models\StockMagasin;
use PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //approvisionnement debut
    public function index()
    { 
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $appros = Stock::all()->Where('societe_id',$soce);
        return view('saas-1.stock.index', compact('appros'));
    }
    //approvisionnement fin


    //inventaire debut
    public function inventaire(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $inventaires =Stock::all()->Where('societe_id',$soce)->sortBy('reference');
	    $nns= $inventaires->Count();$nns++;
        return view('saas-1.inventaire.stock', compact('inventaires'));
    }

    public function voir(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $inventaires =Stock::all()->Where('societe_id',$soce)->sortBy('reference');
        return view('saas-1.inventaire.in', compact('inventaires','Societ'));
    }
    //inventaire fin

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //inventaire magasin 
    public function create(){
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $magasins=magasin::all()->sortBy('nom_mag')->Where('societe_id','=',$soce);
        return view('saas-1.inventaire.create', compact('magasins'));
    }

    public function inventairemag(Request $request)
    {
        $id=$request->id;
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $magasin=magasin::findOrFail($id);
        $inventaires =StockMagasin::all()->where('magasin',$magasin->nom_mag)->Where('societe_id',$soce)->sortBy('reference');
        return view ('saas-1.inventaire.stocks', compact('inventaires','magasin')); 
    }


    public function voirs($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $magasin=magasin::findOrFail($id);
        $inventaires =StockMagasin::all()->where('magasin',$magasin->nom_mag)->Where('societe_id',$soce)->sortBy('reference');
        return View('saas-1.inventaire.ins', compact('inventaires','magasin','Societ')) ;         
    }

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $appro=Stock::findOrFail($id);
        $magasins=Magasin::all()->Where('societe_id',$soce)->sortBy('nom_mag');
        return view('saas-1.stock.edit',compact('appro','magasins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

        $ref=$request->ref;
        $num = $request->num;
        $mag = $request->mag;
        $nom = $request->nom;
        $cas = $request->qte; 
        $ret = $request->ret; 
        if( $ret>$cas){
            return back()->with('message',"Vous ne pouvez pas stocker cette quantité, Veuillez verifier l'stock disponible");
        }
        
        if($request->mag=="" || $request->nom=="" || $request->ret==""){

 		    return back()->with('message',"!!!! Des Champs sont vides !!!!");
        }
        
        if($mag!="" && $nom!="" && $cas!=""){
	        $fg= StockMagasin::all()->where('reference',$ref);
	        $ng = $fg->Count();
	        if($ng!=0){
		        $sql2 =StockMagasin::all()->where('reference',$ref)->where('magasin',$mag);
	            //var_dump($sql);
                foreach($sql2 as $a){
                    $a->update(['qte_stock' =>$a->$cas + $ret]);
                }
                $reste = $cas - $ret;
                $sql2 = Stock::findOrFail($id);
                $b=$sql2->update(['qte_stock' => $reste]);
               
	            //var_dump($sql);
                return back()->with('message',"!!!! Enregistrement reussi !!!!");	 
 	        }
          
	        elseif($ng==0){
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();

 	            $save= new StockMagasin;
                $save->reference=$ref;
                $save->qte_stock=$ret;
                $save->magasin=$mag;
                $save->editorial= Auth::user()->email;
                $save->societe_id = $Soci->societe_id;
                $save-> save();
	            //var_dump($sql); 
 	            $reste = $cas - $ret;
	            $sql2 = Stock::findOrFail($id);
                $b=$sql2->update(['qte_stock' => $reste]);
                
	            //var_dump($sql);
                return back()->with('message',"!!!! Enregistrement reussi !!!!");
            } 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}