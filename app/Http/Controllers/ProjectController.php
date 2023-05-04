<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        $projects = Project::where('user_id', $user->id)->get(); // Récupère les projets de l'utilisateur connecté

        return view('saas-1.gest_projet.index', compact('projects'));

        //return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id; // Récupère l'utilisateur connecté
        $project = new Project();
        $project->name = $request->nom;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->user_id = $user;

        $project->save();

        return BACK()->with('message', "Le projet a bien ete cree !");

    }
    public function voir($id)
    {
        if (isset($id)) {
            $id = $id;
            $project = Project::all()->where('id', $id)->first();
            return view('saas-1.gest_projet.fiche', compact('project'));
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        if (isset($id)) {
            $id = $id;
            $project = Project::all()->where('id', $id)->first();
            
            
            return view('saas-1.gest_projet.cli', compact('project'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $project = Project::findOrFail($id);
        return view('saas-1.gest_projet.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $project = Project::find($id);
        $project->name = $request->nom;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $user = Auth::user()->id; // Récupère l'utilisateur connecté
        $project->user_id = $user;  
        $project->update();
        return BACK()->with('message', "Le projet a bien ete modifier !");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $message = '';
        $erreur = '';
         
            $message = "Projet supprimé avec succèss";
            $desc = str_replace('@', '', "@DELETE-FORMATION");
            $project->delete();
        
        if ($message != '') {
            return back()->with('message', $message);
        } else {
            return back()->with('erreur', $erreur);
        }
    }
}
