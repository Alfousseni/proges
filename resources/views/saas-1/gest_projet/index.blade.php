@extends('saas-1.index')
@section('contenu')
    <div class="row">
        <div class="card">
            <div class="card-header ">
                <h5>Liste des Projets
                    <a href="" title="Voir toutes les clients"
                        style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary mb-2 me-2"><i
                            data-feather="list"></i> Liste</a>
                    <a href="" title="Ajouter un projet" style="text-align:right; float:right; margin-bottom:20px;"
                        class="btn btn-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i
                            data-feather="plus"></i>Projet</a>

                </h5>
                <p class="text-muted font-13 mb-4">
                    Les informations affichées ci dessous sont les enregistrements des différents types de projet de votre
                    structure.
                </p>
            </div>
            <div class="row ">
                <div class="col-md-12 ">
                    @if (session()->has('message'))
                        <div class="alert alert-icon alert-success">
                            <em class="icon ni ni-alert-circle"></em>
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-icon alert-danger">
                                <em class="icon ni ni-alert-circle"></em>
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <table class="multi-table table table-striped dt-table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Budget</th>
                                        <th class="text-center">Date de lancement</th>
                                        <th class="text-center">Date de fin</th>
                                        <th class="text-center">Etat</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>

                                            <td class="text-center">{{ $project->name }}</td>
                                            <td class="text-center">{{ $project->budget }}</td>
                                            <td class="text-center">{{ $project->start_date }}</td>
                                            <td class="text-center">{{ $project->end_date }}</td>
                                            <td class="text-center">{{ $project->etat }}</td>
                                            <td align="center">
                                                <a href="{{ route('voirprojet', $project->id) }}" title="Voir"
                                                    style="float:left;" class="badge badge-light-primary text-start me-2 ">
                                                    <i data-feather="eye"></i></a>
                                                <a href="{{ route('project.edit', $project->id) }}" title="Editer"
                                                    style="float:left;" class="badge badge-light-primary text-start me-2 ">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                
                                                <form id="destroy{{ $project->id }}"
                                                    onSubmit="return confirm('Confirmez-vous votre suppression?')"
                                                    action="{{ route('project.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="badge badge-light-danger text-start action-delete"
                                                        style="float:left;"><i data-feather="trash"></i></button>
                                               
                                                    <button class="badge badge-light-danger text-start action-delete"
                                                        style="float:left;"hidden><i data-feather="trash"></i></button>
                                            
                                                </form>
                                                <a href="{{ route('listetaches' , $project->id)}}" title="Ajouter une tache"
                                                style="float:left;" class="badge badge-light-primary text-start me-2 ">
                                                <i data-feather="plus"></i>
                                                </a>
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        
                    </div>
                </div>
            </div>


            <!-- Modal -->
        <script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>


            <div class="modal fade bd-example-modal-lg py-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content py-5">
                        <div class="modal-header bg-light">
                            <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout d'un projet</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-12 bg-primary-light">
                                    <form action="{{route('project.store')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <p class="panel-subtitle">
                                                Veuillez renseigner les champs ci-dessous.
                                            </p>
                                            <div class="col-md-12">
                                                <label for="validationCustom01" class="form-label">Nom du projet</label>
                                                <input type="text" name="nom" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir l'intituler du projet"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                    
                                        </div>
                                       <div class="row">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Client</label>
                                                <select type="text" name="client" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la description du projet"
                                                    required>
                                                        @foreach($clients as $client)
                                                        <option value="" >Choisir le client</option>                                                     
                                                        <option value="{{$client->id}}">{{$client->nom}} {{$client->prenom}} </option>
                                                        @endforeach
                                                </select>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Type de projet</label>
                                                <select type="text" name="type" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la description du projet"
                                                    required>
                                                        <option value="ineterne">Interne</option>                                                     
                                                        <option value="externe">Externe</option>
                                                </select>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Nombre de participant</label>
                                                <input type="number" name="personne" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div> 
                                       </div>
                                       <div class="row ">
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Budget</label>
                                                <input type="number" name="budget" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Priorite</label>
                                                <select type="text" name="priorite" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la description du projet"
                                                    required>
                                                        <option value="">Priorite du projet</option>                                                     
                                                        <option value="haute">Haute</option>                                                     
                                                        <option value="moyenne">Moyenne</option>
                                                        <option value="basse">Basse</option>

                                                </select>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                       </div>
                                       <div class="row">
                                        
                                    </div>
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">date de lancement</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">date de fin</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                           
                                                <label for="validationCustom01" class="form-label">DESCRIPTION DU PROJET</label>
                                               
                                                    <textarea name="description" id="demo1" cols="100%"  rows="6"></textarea>
                                                
                                                <div class="valid-feedback">Looks good!</div>
                                           
                                            </div>
                                            <div class=" ">
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                                <button type="reset" class="btn btn-default">Annuler</button>
                                            </div>
                                        </div>

                                   
                                    <div class="row">
                                            
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          
        @endsection

        <script>
            selectBox = new vanillaSelectBox("#selectPays", {
                "keepInlineStyles": true,
                "maxHeight": 200,
                "minWidth": 678,
                "search": true,
                "placeHolder": "Choose..."
            });
        </script>
       
