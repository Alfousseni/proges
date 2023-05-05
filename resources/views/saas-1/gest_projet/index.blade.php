@extends('saas-1.index')
@section('contenu')
    <div class="row">
        <div class="card">
            <div class="card-header">
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
            <div class="row">
                <div class="col-md-12">
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
                                        <th class="text-center">description</th>
                                        <th class="text-center">date de lancement</th>
                                        <th class="text-center">date de fin</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        <tr>

                                            <td class="text-center">{{ $project->name }}</td>
                                            <td class="text-center">{{ $project->description }}</td>
                                            <td class="text-center">{{ $project->start_date }}</td>
                                            <td class="text-center">{{ $project->end_date }}</td>
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

            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
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
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Nom du projet</label>
                                                <input type="text" name="nom" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir l'intituler du projet"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                    
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Description du projet</label>
                                                <textarea type="text" name="description" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la description du projet"
                                                    required></textarea>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">date de lancement</label>
                                                <input type="date" name="start_date" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">date de fin</label>
                                                <input type="date" name="end_date" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Valider</button>
                                            <button type="reset" class="btn btn-default">Annuler</button>
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
