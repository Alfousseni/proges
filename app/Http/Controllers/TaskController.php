<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_projet)
    {
        $tasks = Task::with('projet','task_assignments')
            ->where('project_id', $id_projet)
            ->get();

            $users = User::where('role', 'user')->get();

        
        return view('saas-1.gest_projet.task.index', compact('tasks','users','id_projet'));
         

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_projet)
    {
        
    }

    public function voir($id)
    {
        if (isset($id)) {
            $id = $id;
            $task = Task::all()->where('id', $id)->first();
            $comments = Commentaire::all()->where('tache_id',$id);
            return view('saas-1.gest_projet.task.fiche', compact('task','comments'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_projet)
    {
        $task = new Task();
        $task->name = $request->nom;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->project_id = $id_projet;
    
        $task->save();
    
        $task->task_assignments()->create([
            'participant_id' => $request->user,
            'task_id' => $task->id
        ]);
    
        return back()->with('message', "La tache a bien ete cree !");
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    { 
        $task = Task::findOrFail($id);
        return view('saas-1.gest_projet.task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $task = Task::find($id);
        $task->name = $request->nom;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->save();
        return BACK()->with('message', "La tache a bien été modifier !");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        {
            $task = Task::findOrFail($id);
            $message = '';
            $erreur = '';
             
                $message = "tache supprimé avec succèss";
                $desc = str_replace('@', '', "@DELETE-FORMATION");
                $task->delete();
            
            if ($message != '') {
                return back()->with('message', $message);
            } else {
                return back()->with('erreur', $erreur);
            }
        }
    }
}
