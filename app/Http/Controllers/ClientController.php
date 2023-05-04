<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Societe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Soci = User::all()->Where('email', '=', Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $clients = Client::all()->Where('societe_id', $soce);

        return view('saas-1.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    //liste de toutes les clients

    public function voirliste1()
    {
        $Soci = User::all()->Where('email', '=', Auth::user()->email)->first();
        $soce = $Soci->societe_id;
        $clients = Client::all()->Where('societe_id', $soce);
        return view('saas-1.client.voir', compact('clients'));
    }
    public function liste1()
    {

        $clients = Client::all();
        return view('saas-1.client.list', compact('clients'));
    }
    // fin liste de toutes les clients


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([]);
        $Soci = User::all()->Where('email', '=', Auth::user()->email)->first();
        $soce = $Soci->societe_id;

        if ($request->nom == "" || $request->prenom == "" || $request->adresse == "" || $request->tel == "" || $request->ville == "" || $request->email == "") {
            return back()->with('message ', "!!!! Des champs sont vides !!!!");
        }

        if ($request->email != "") {
            if (!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))) {

                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }

        if ($request->nom != "" && $request->email != "" && $request->prenom != "" && $request->adresse != "" && $request->tel != "") {
            $gt = Client::all()->where('email', $request->email)->Where('societe_id', $soce);
            $nb = $gt->count();
            if ($nb != 0) {
                return back()->with('message', "Le client renseigné existe déja");
            } else {
                $Soci = User::all()->Where('email', '=', Auth::user()->email)->first();
                $soce = $Soci->societe_id;
                $save = new Client;
                //generation du numero de client
                $exe = date('Y');
                $date = substr($exe, 2);
                $zero = "0000";
                $zeroo = "000";

                $numerooo = "CLI" . $soce . $date;
                $code = "411";

                $nombre = Client::all()->Where('societe_id', $soce)->count();
                if ($nombre != 0) {
                    $nbre = Client::all()->Where('societe_id', $soce)->last();
                    $num = $nbre->numero;
                    $numm = $nbre->codeclient;

                    $numo = substr($num, -4);
                    $numo++;
                    if ($numo < 10) $zero = substr($zero, 0, strlen($zero) - 1);
                    else if ($numo < 100) $zero = substr($zero, 0, strlen($zero) - 2);
                    else $zero = substr($zero, 0, strlen($zero) - 3);
                    $numerooo .= $zero . $numo;

                    $nummo = substr($numm, -3);
                    $nummo++;
                    if ($nummo < 10) $zeroo = substr($zeroo, 0, strlen($zeroo) - 1);
                    else if ($nummo < 100) $zeroo = substr($zeroo, 0, strlen($zeroo) - 2);
                    else $zeroo = substr($zeroo, 0, strlen($zeroo) - 3);
                    $code .= $zeroo . $nummo;
                } else {
                    $nombre++;
                    if ($nombre < 10) $zero = substr($zero, 0, strlen($zero) - 1);
                    else if ($nombre < 100) $zero = substr($zero, 0, strlen($zero) - 2);
                    else $zero = substr($zero, 0, strlen($zero) - 3);
                    $numerooo .= $zero . $nombre;

                    $code .= $zero . $nombre;
                }

                //fin

                $save->numero = $numerooo;
                $save->codeclient = $code;
                $save->nom = $request->nom;
                $save->prenom = $request->prenom;
                $save->compagnie = $request->company;
                $save->email = $request->email;
                $save->tel = $request->tel;
                $save->adresse = $request->adresse;
                $save->ville = $request->ville;
                $save->codep = $request->code;
                $save->site = $request->site;
                $save->infos = $request->info;
                $save->editorial = Auth::user()->email;
                $save->save();
                return BACK()->with('message', "Le Client a bien ete cree !");
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function voir($numero)
    {
        if (isset($numero)) {
            $num = $numero;
            $client = Client::all()->where('numero', $num)->first();
            return view('saas-1.client.fiche', compact('client'));
        }
    }

    public function show($numero)
    {
        if (isset($numero)) {
            $num = $numero;
            $client = Client::all()->where('numero', $num)->first();
            $Soci = User::all()->Where('email', '=', Auth::user()->email)->first();
            $soce = $Soci->societe_id;
            
            return view('saas-1.client.cli', compact('client'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('saas-1.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([]);

        if ($request->email != "") {
            if (!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $request->email))) {
                return back()->with('message', "!!!! Email non valide !!!!");
            }
        }

        $save = Client::find($id);
        $save->nom = $request->nom;
        $save->prenom = $request->prenom;
        $save->adresse = $request->adresse;
        $save->compagnie = $request->company;
        $save->email = $request->email;
        $save->tel = $request->tel;
        $save->site = $request->site;
        $save->pays = $request->pays;
        $save->ville = $request->ville;
        $save->codep = $request->code;
        $save->infos = $request->info;
        $save->save();
        return BACK()->with('message', "Le Client a bien ete modifie !");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $message = '';
        $erreur = '';
        if ($client->etat == 0) {
            $message = "Client supprimé avec succèss";
            $desc = str_replace('@', '', "@DELETE-FORMATION");
            $client->delete();
        } else {
            $erreur = "Suppression Client non autorisée";
            $desc = "ESSAYE-DEL-CLIENT";
        }
        if ($message != '') {
            return back()->with('message', $message);
        } else {
            return back()->with('erreur', $erreur);
        }
    }
}
