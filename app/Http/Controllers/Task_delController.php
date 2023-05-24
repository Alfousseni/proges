<?php

namespace App\Http\Controllers;

use App\Models\Task_del;
use App\Models\Task_assignment;

use Illuminate\Http\Request;

class Task_delController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id)
    {
        $task_del = new Task_del();
        $task_assignment = Task_assignment::where('participant_id', $request->user)
        ->where('task_id', $id)
        ->first();
        $task_del->task_id = $id;
        $task_del->participant_id = $request->user;
        $task_del->raison = $request->raison;
        $task_del->save();
        $task_assignment->delete();
        return back()->with('message', "participant retirer !");   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task_del  $task_del
     * @return \Illuminate\Http\Response
     */
    public function show(Task_del $task_del)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task_del  $task_del
     * @return \Illuminate\Http\Response
     */
    public function edit(Task_del $task_del)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task_del  $task_del
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task_del $task_del)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task_del  $task_del
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // $task_assignment = Task_assignment::where('participant_id','task_id',$user->id)->get();;
        // $message = '';
        // $erreur = '';
         
        //     $message = "Projet supprimé avec succèss";
        //     $project->delete();
        
        // if ($message != '') {
        //     return back()->with('message', $message);
        // } else {
        //     return back()->with('erreur', $erreur);
        // }
    }
    
}
