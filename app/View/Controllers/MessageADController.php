<?php

namespace App\Http\Controllers;

use App\Models\Messagerie;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MessageADController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    	$mal = Auth::guard('admin')->user()->email;
        $messages = Messagerie::all()->Where('email_dest',$mal);
        $messages1 = Messagerie::all()->Where('email_esp',$mal);
        $User = User::all();
        return view("saas.messagerie.index",compact('messages','messages1','User'));
    	 
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
          $validatedData=$request->validate([   
          'objet' => 'required', 'String',
          'message' => 'required',
          'email_dest' => 'required',
          'email_esp' => 'required',
          
           
        ]);
        
        $mal = $request->email_dest;
        $Soci= User::all()->Where('email','=',$mal)->first();
        $soce = $Soci->societe_id;
        
        $save=new Messagerie;
        $save->email_dest = $request->email_dest;
        $save->email_esp = $request->email_esp;
        $save->Objet = $request->objet;
        $save->Message = $request->message;
        $save->societe_id = $soce;
        $save->save();
        return back()->with('message', "Message envoyé avec succés!");
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Messagerie  $messagerie
     * @return \Illuminate\Http\Response
     */
    public function show(Messagerie $messagerie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Messagerie  $messagerie
     * @return \Illuminate\Http\Response
     */
    public function edit(Messagerie $messagerie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Messagerie  $messagerie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messagerie $messagerie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Messagerie  $messagerie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messagerie $messagerie)
    {
        //
    }
}