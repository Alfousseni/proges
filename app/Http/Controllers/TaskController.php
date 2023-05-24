<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Task_assignment;
use App\Models\Project;
use App\Models\Task;
use App\Models\task_del;
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
            $project = Project::where('id',$id_projet)->first();

        
        return view('saas-1.gest_projet.task.index', compact('tasks','users','id_projet','project'));
         

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
            $users = User::all();
            $task_dels= task_del::all()->where('task_id',$id);
            return view('saas-1.gest_projet.task.fiche', compact('task','comments','users','task_dels'));
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

        $startTimestamp = strtotime($request->start_date);
        $endTimestamp = strtotime($request->start_date);


        $task_assignments = Task_assignment::all()->where('participant_id',$request->user);

        if(isset($task_assignments)){
            foreach($task_assignments as $task_assignment){

                $startTimestampa = strtotime($task_assignment->task->start_date);
                $endTimestampa = strtotime($task_assignment->task->end_date);

                if($startTimestamp >= $startTimestampa && $startTimestamp <= $endTimestampa && $endTimestamp >= $startTimestampa && $endTimestamp <= $endTimestampa){

                return back()->with('message', "ce charger de date est deja occuper a cette date !");

                }


            }
        }
    
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
        $project = Project::where('id',$task->project_id)->first();
        return view('saas-1.gest_projet.task.edit', compact('task','project'));
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
