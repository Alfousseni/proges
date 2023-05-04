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
        $societes = Societe::all();
        return view ('saas.utilisateur.index', compact('users','societes'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','unique:users'],
            'societe' => ['required', 'integer'],
            'pass' => ['required',Password::defaults()],
            'pass1' => ['same:pass']
        ],
        [
            'email.unique' => 'Le mail renseigné existe deja !!!'
        ]);

        $sop = User::all()->where('societe_id', $request->societe)->Count();
        $nbs = $sop;
        
        $soc = Societe::select('nombre_user')->where('id', $request->societe)->first();
        $nbr = $soc->nombre_user;

        if($nbs == $nbr){

            return back()->with('message', "La société a atteint son quota d'utilisateur");

        }elseif($nbs < $nbr){
        

        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->pass);
        $user->societe_id=$request->societe;
        $user->save();
            
            return back()->with('message', "L'/utilisateur a bien été créé !");
    }
}
    
    public function show( )
    {
        //
    }

    
    public function edit($id)
    {
        $user=User::find($id);
        return view ('saas-1.utilisateur.edit', compact('user'));
    }

    
    public function update(Request $request,  $id)
    {
        $validatedData=$request->validate([
            'nouveau' => ['required',Password::defaults()],
            'nouveau1' => ['same:nouveau']
        ]);

        $user=User::find($id);
        $user->password=Hash::make($request->nouveau);
        $user->save();
        Auth::guard('web')->logout();
        return redirect('/app/login');
    }

    
    public function destroy( )
    {
       
    }
}
