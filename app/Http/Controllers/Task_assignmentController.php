<?php

namespace App\Http\Controllers;

use App\Models\Task_assignment;
use App\Models\Task;

use Illuminate\Http\Request;

class Task_assignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $task_assignment = new Task_assignment();
        $task_assignment->participant_id = $request->user;
        $task_assignment->task_id = $request->task;
        $task = Task::where('id', $request->task)->first();

        $startTimestamp = strtotime($task->start_date);
        $endTimestamp = strtotime($task->start_date);

        $task_assignments = Task_assignment::all()->where('participant_id',$request->user);

        if(isset($task_assignments)){
            foreach($task_assignments as $task_assignment){

                $startTimestampa = strtotime($task_assignment->task->start_date);
                $endTimestampa = strtotime($task_assignment->task->end_date);

                if($startTimestamp >= $startTimestampa && $startTimestamp <= $endTimestampa && $endTimestamp >= $startTimestampa && $endTimestamp <= $endTimestampa){

                return back()->with('message', "ce charger est occuper!");

                }


            }
        }
       
    
        $task_assignment->save();
        return back()->with('message', "participant ajouter !");

    }

    /**
     * Display the specified resource.
     */
    public function show(Task_assignment $task_assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task_assignment $task_assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task_assignment $task_assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task_assignment $task_assignment)
    {
        //
    }
}
