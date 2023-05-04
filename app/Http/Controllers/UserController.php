<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Societe;
use App\Http\Controllers\Controller;
use App\Mail\InscriptionClientMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Image;
use Intervention\Image\Exception\NotReadableException;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        //$societes = Societe::all();
        return view ('saas.utilisateur.index', compact('users','societes'));
    }
    public function index1()
    {
        $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $users = User::all()->Where('societe_id',$soce);
        //$societes = Societe::all()->Where('id','=',$Soci->societe_id);
        return view ('saas-1.utilisateur.index', compact('users', 'societes'));
    }
   
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('saas-1.utilisateur.reset');
  
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email','unique:users'],
//             'societe' => ['required', 'integer'],
//             'pass' => ['required',Password::defaults()],
//             'pass1' => ['same:pass']
//         ],
//         [
//             'email.unique' => 'Le mail renseigné existe deja !!!'
//         ]);

//         $sop = User::all()->where('societe_id', $request->societe)->Count();
//         $nbs = $sop;
        
//         $soc = Societe::select('nombre_user')->where('id', $request->societe)->first();
//         $nbr = $soc->nombre_user;

//         if($nbs == $nbr){

//             return back()->with('message', "La société a atteint son quota d'utilisateur");

//         }elseif($nbs < $nbr){
        

//         $user = new User;
//         $user->name=$request->name;
//         $user->email=$request->email;
//         $user->password=Hash::make($request->pass);
//         $user->societe_id=$request->societe;
//         $user->save();
            
//             return back()->with('message', "L'/utilisateur a bien été créé !");
//     }
// }


//     public function store1(Request $request)
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email','unique:users'],
//             'societe' => ['required', 'integer'],
//             'pass' => ['required',Password::defaults()],
//             'pass1' => ['same:pass']
//         ],
//         [
//             'email.unique' => 'Le mail renseigné existe deja !!!'
//         ]);

//         $sop = User::all()->where('societe_id', $request->societe)->Count();
//         $nbs = $sop;
        
//         $soc = Societe::select('nombre_user')->where('id', $request->societe)->first();
//         $nbr = $soc->nombre_user;

//         if($nbs == $nbr){

//             return back()->with('message', "La société a atteint son quota d'utilisateur");

//         }elseif($nbs < $nbr){
        

//         $user = new User;
//         $user->name=$request->name;
//         $user->email=$request->email;
//         $user->password=Hash::make($request->pass);
//         $user->societe_id=$request->societe;
//         $user->save();
            
//             return back()->with('message', "L'/utilisateur a bien été créé !");
//     }
// }
    
//     public function show( )
//     {
//         //
//     }

//     public function entete()
//     {
//         return view ('saas-1.societe.ent');
//     }

    
//     public function edit($id)
//     {
//         $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
//         $soc = $Soci->societe_id;
//         $societe=Societe::find($soc);
//         $societes = Societe::all();
//         $user=User::find($id);
//         $users = User::all()->Where('societe_id',$soc);
//         return view ('saas-1.utilisateur.edit', compact('user', 'users','societes','societe'));
//     }
//     public function edit1($id)
//     {
//         $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
//         $soce = $Soci->societe_id;
//         $user=User::find($id);
//         $societes = Societe::all()->Where('id',$soce);
//         return view ('saas-1.utilisateur.edite', compact('user', 'societes'));
//     }
//     public function update1(Request $request,  $id)
//     {
//         $validatedData=$request->validate([
//             'nouveau' => ['required',Password::defaults()],
//             'nouveau1' => ['same:nouveau']
//         ]);

//         $user=User::find($id);
//         $user->name=$request->name;
//         $user->email=$request->email;
//         $user->societe_id=$request->societe;
//         $user->password=Hash::make($request->nouveau);
//         $user->save();
//         return back()->with('message', "L'/utilisateur a bien été modifie !");
     
//     }
    
//     public function update(Request $request,  $id)
//     {
//         $validatedData=$request->validate([
//             'nouveau' => ['required',Password::defaults()],
//             'nouveau1' => ['same:nouveau']
//         ]);

//         $user=User::find($id);
//         $user->password=Hash::make($request->nouveau);
//         $user->save();
//         Auth::guard('web')->logout();
//         return redirect('/app/login');
//     }

    
//     public function destroy( )
//     {
       
//     }
//     public function destroy1( $id)
//     {
//         $user = User::findOrFail($id);
//         $message = '' ;
//         $erreur = '' ;
//         if($user->etat == 0)
//         {
//             $message = "Utilisateur supprimée avec succèss" ;
//             $desc = str_replace('@','',"@DELETE-BANQUE") ;
            
//             $user->delete();
//         }
//         else
//         {
//             $erreur = "Suppression Operation non autorisée" ;
//             $desc = "ESSAYE-DEL-BANQUE" ;
//         }
//         if($message != '') 
//         { return back()->with('message', $message); }
//         else 
//         { return back()->with('erreur', $erreur); }
//     }
}
