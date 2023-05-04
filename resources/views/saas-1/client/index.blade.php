@extends('saas-1.index')
@section('contenu')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5>Liste des Clients
                    <a href="{{ route('voirliste1') }}" title="Voir toutes les clients"
                        style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary mb-2 me-2"><i
                            data-feather="list"></i> Liste</a>
                    <a href="" title="Ajouter un client" style="text-align:right; float:right; margin-bottom:20px;"
                        class="btn btn-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i
                            data-feather="plus"></i>Client</a>

                </h5>
                <p class="text-muted font-13 mb-4">
                    Les informations affichées ci dessous sont les enregistrements des différents types de clients de votre
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
                                        <th class="text-center">Numero</th>
                                        <th class="text-center">Entreprise</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>

                                            <td class="text-center">{{ $client->numero }}</td>
                                            <td class="text-center">{{ $client->compagnie }}</td>
                                            <td class="text-center">{{ $client->email }}</td>



                                            <td align="center">
                                                <a href="{{ route('voirclient', $client->numero) }}" title="Voir"
                                                    style="float:left;" class="badge badge-light-primary text-start me-2 ">
                                                    <i data-feather="eye"></i></a>
                                                <a href="{{ route('client.edit', $client->id) }}" title="Editer"
                                                    style="float:left;" class="badge badge-light-primary text-start me-2 ">
                                                    <i data-feather="edit"></i></a>

                                                @if ($client->etat == 0)
                                                    <form id="destroy{{ $client->id }}"
                                                        onSubmit="return confirm('Confirmez-vous votre suppression?')"
                                                        action="{{ route('client.destroy', $client->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="badge badge-light-danger text-start action-delete"
                                                            style="float:left;"><i data-feather="trash"></i></button>
                                                    @elseif($client->etat == 1)
                                                        <button class="badge badge-light-danger text-start action-delete"
                                                            style="float:left;"hidden><i data-feather="trash"></i></button>
                                                @endif
                                                </form>
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
                            <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout de client</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-12 bg-primary-light">
                                    <form action="{{ route('client.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <p class="panel-subtitle">
                                                Veuillez renseigner les champs ci-dessous.
                                            </p>
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Nom entreprise</label>
                                                <input type="text" name="company" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir le nom de l'entreprise"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Numéro téléphone</label>
                                                <input type="phone" name="tel" class="form-control"
                                                    id="validationCustom01"
                                                    placeholder=" Saisir le numéro de téléphone ex : +221 77 000 00 00"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Prénom</label>
                                                <input type="text" name="prenom" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir le prénom du client"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Nom</label>
                                                <input type="text" name="nom" class="form-control"
                                                    id="validationCustom01" placeholder="saisir le nom du client"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Email</label>
                                                <input type="text" name="email" class="form-control"
                                                    id="validationCustom01" placeholder="saisir le mail du client"
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Site Web </label>
                                                <input type="text" name="site" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir le nom du site">
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Ville </label>
                                                <input type="text" name="ville" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la ville" required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationCustom01" class="form-label">Code Postal </label>
                                                <input type="text" name="code" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la code postal">
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="validationCustom01" class="form-label">Adresse </label>
                                                <input type="text" name="adresse" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir l'adresse" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="validationCustom01" class="form-label">Informations
                                                    additionnelles</label>
                                                <textarea class="form-control" name="info" rows="3"> </textarea>
                                            </div>
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
