<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Societe;
use App\Models\Employer;
use App\Models\Poste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Image;
use Intervention\Image\Exception\NotReadableException;
use PDF;
 
class EmployerController extends Controller
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
        $Postes = Poste::all()->Where('validated',0)->Where('societe_id',$soce);
        $employers = Employer::all()->Where('societe_id',$soce);
        return view('saas-1.employer.index', compact('employers','Postes'));
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

    //liste de toutes les employers
    
    public function voirliste4()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $employes = Employer::all()->Where('societe_id',$soce);
        return view ('saas-1.employer.voir', compact('employes')); 
    }
    public function liste4()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
        $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
        $employes = Employer::all()->Where('societe_id',$soce);
        return view('saas-1.employer.list', compact('employes','Societ'));
        
    }
            // fin liste de toutes les employers

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validatedData=$request->validate([   
          //'date_limite' => 'required|date|after:today',
          'poste' => 'required', 'integer', 'poste_id', 'max:20', 'unique:employers',
          'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
           
        ]);

        if($request->nom=="" ||$request->prenom=="" || $request->adresse=="" || $request->poste=="" || $request->tel=="" || $request->date_naiss=="" || $request->lieu_naiss=="" || $request->email==""){
 		      return back()->with('message ', "!!!! Des champs sont vides !!!!");   
        }

        if($request->email!=""){
            if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))){

                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }

        if($request->nom!="" && $request->email!="" && $request->prenom!="" && $request->adresse!="" && $request->tel!="" && $request->date_naiss!=""&& $request->lieu_naiss!=""&& $request->poste!=""){
            $gt = Employer::all()->where('email',$request->email);	
            $nb = $gt->count();  
            if($nb!=0){
                return back()->with('message', "Le mail renseigné existe déja");
            }
            else{
                $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
           	$soce = $Soci->societe_id;
                $save=new Employer;
                //generation du numero de client
                $exe=date('Y');
                $date=substr($exe,2);
                $zero="0000";
                $numerooo="EMP".$soce.$date;
                $nombre=Employer::all()->Where('societe_id',$soce)->Count();
                $nombre++;
                if($nombre<10) $zero=substr($zero,0,strlen($zero)-1);
                else if($nombre<100) $zero=substr($zero,0,strlen($zero)-2);
                else $zero=substr($zero,0,strlen($zero)-3);
                $numerooo.= $zero.$nombre;
                //fin

                 

                $save->numero=$numerooo; 
                $save->nom=$request->nom;
                $save->prenom=$request->prenom;
                $save->date_naiss=$request->date_naiss;
                $save->lieu_naiss=$request->lieu_naiss;
                $save->email=$request->email;
                $save->tel=$request->tel;
                $save->adresse=$request->adresse;
                $save->poste_id=$request->poste;
                $save->societe_id = $Soci->societe_id;
                $save->date_emb = $request->date_emb;
                $save->validated = 1;
                
                if($request->hasfile('photo')){
	            $file = $request->file('photo');
	            $extension = $file->getClientOriginalExtension();
	            $filename = '-img-'.$soce.'-'.time() . '.' . $extension;
	            $destinationPath = public_path('/uploads/employe');
	            $resize_image = Image::make($file->getRealPath());
	            $resize_image->resize(500,600)->save($destinationPath. '/' . $filename);
	            $destinationPath = $request->file('photo')->store('uploads/employe');
	
	            $save->photo= $filename;
	
	        } else{
	            $save->photo='';
	        }
	        
		  
                $save->save();
                
                $poste = $request->poste; 
                
                 
                
                $empl = Poste::where('id', $poste)->update(['validated' => 1]);
                 
		
                return BACK()->with('message', "L'employé a bien été créé !");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
     
     public function voir($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $employes=Employer::all()->where('id',$num)->first();
            return view('saas-1.employer.fiche', compact('employes'));  
        }
      
    }
    
    public function show($numero)
    {
        if(isset($numero)){  
            $num = $numero;
            $employes=Employer::all()->where('numero',$num)->first();
            $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            $Societ = Societe::all()->Where('id','=',$Soci->societe_id);
            return view('saas-1.employer.emp', compact('employes','Soci','Societ'));  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $postes = Poste::all()->Where('societe_id',$soce);
        $employes=Employer::findOrFail($id);
        return view('saas-1.employer.edit', compact('employes','postes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
     	public function update(Request $request,  $id)
    	{ 
    	$validatedData=$request->validate([
          'poste' => 'required', 'integer', 'poste_id', 'max:20', 'unique:employers',
           
        ]);
        
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $ffn = Employer::find($id);
        $num = $ffn->numero;
        $poste = $ffn->poste_id;

        $pot =	$request->poste;
        
        if($poste == $pot ){
        
         $op = Poste::where('id', $poste)->update(['validated' => 1]);
        
        }elseif($poste != $pot){
        
         $ope = Poste::where('id', $poste)->update(['validated' => 1]);
         $opt = Poste::where('id', $pot)->update(['validated' => 0]);
       
        
        }
        
        
        
        $save = Employer::find($id);
       
        $save->nom=$request->nom;
        $save->prenom=$request->prenom;
        $save->date_naiss=$request->date_naiss;
        $save->lieu_naiss=$request->lieu_naiss;
        $save->tel=$request->tel;
        $save->email=$request->email;
        $save->date_emb=$request->date_emb;
        $save->adresse=$request->adresse;
        $save->poste_id=$request->poste;
       
       
        if($request->hasFile('photo')){
            $request->validate([
              'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $image = Employer::find($request->id);
            // URL du fichier distant
            $rFile = "uploads/employe/".$image->photo;
            // Ouvrir le fichier
            $check = @fopen($rFile, 'r');
            // Vérifier si le fichier existe
            if(!$check){
            
            }else{
                unlink('uploads/employe/'.$image->photo);
            }

            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filenames = '-img-'.$soce.'-'.time() . '.' . $extension;
            $destinationPath = public_path('/uploads/employe');
            $resize_image = Image::make($file->getRealPath());
            $resize_image->resize(500,600)->save($destinationPath. '/' . $filenames);
	    $destinationPath = $request->file('photo')->store('uploads/employe');
            $save->photo = $filenames;
        }
        
         
            $save->save();
        
        	
        return back()->with('message', "L'employé a bien été modifie !");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $employe= Employer::findOrFail($id);
        $message = '' ;
        $erreur = '' ;
        if($employe->validated == 0)
        {
            $message = "Employé supprimé avec succès" ;
            $desc = str_replace('@','',"@DELETE-POSTE") ;
            $employe->delete();
        }
        else
        {
            $erreur = "Suppression employe non autorisée" ;
            $desc = "ESSAYE-DEL-EMPLOYE" ;
        }
        if($message != '') 
        { return back()->with('message', $message); }
        else 
        { return back()->with('erreur', $erreur); }
   
    }
}