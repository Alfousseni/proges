@extends('saas.index')
@section('contenu')    
<div class="row">
  <div class="col-md-12">
    <h4 class="header-title">Liste des Fournisseurs</h4>
    <h2 class="text-black">
			<a href="{{route('fournisseur.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
			  <em class="icon ni ni-plus"></em>
			  <span>Ajouter un fournisseur</span>
		  </a>
		</h2>
    <h2 class="text-black">
      <a href="{{route('devi')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
				<em class="icon ni ni-plus"></em>
				<span>Demander un devis</span>
			</a>
    </h2>
    <p class="text-muted font-13 mb-4">
      Les informations affichées ci dessous sont les enregistrements des différents fournisseurs de votre structure.
    </p>
  </div>
</div>   
<div class="row">
  <div class="col-md-12">
    @if(session()->has('message'))
      <div class="alert alert-icon alert-success">
        <em class="icon ni ni-alert-circle"></em>
        {{session('message')}}
      </div>
    @endif
    @if($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-icon alert-danger">
          <em class="icon ni ni-alert-circle"></em>
          {{$error}}
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
              <th>Numero</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Email</th>
              <th>Tel</th>
              <th class="text-center dt-no-sorting">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($fournisseurs as $fournisseur)
            <tr>
              <td class="text-center">{{ $fournisseur-> numero}}</td>
              <td class="text-center">{{ $fournisseur-> nom}}</td>
              <td class="text-center">{{ $fournisseur-> prenom}}</td>
              <td class="text-center">{{ $fournisseur-> email}}</td>
              <td class="text-center">{{ $fournisseur-> tel}}</td>
              <td class="text-center">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="{{route('voirfrs', $fournisseur->id)}}">Afficher</a>
                    <a class="dropdown-item" href="{{route('fournisseur.edit', $fournisseur -> id)}}">Editer</a>
                    <form id="destroy{{ $fournisseur-> id}}" action="{{route('fournisseur.destroy', $fournisseur -> id)}}" method="POST">
                      @csrf 
                      @method('DELETE')
                      <a class="dropdown-item" href="" onclick="event.preventDefault();this.closest('form').submit();">Supprimer</a>
                    </form> 
                  </div>
                </div>
              </td>                        
            </tr>
            @endforeach 
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  function confirmer() {
    if(confirm("Confirmez-vous la suppression?")) return true;
    else return false;
  }
</script>
			
  <!-- Modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout de Fournisseur</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-12 bg-primary-light">
            <form action="{{route('fournisseur.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <p class="panel-subtitle">
                  Veuillez renseigner les champs ci-dessous.
                </p>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Nom entreprise</label>
                  <input type="text" 
                          name="company"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le nom de l'entreprise" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Numéro téléphone</label>
                  <input type="phone" 
                          name="tel"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder=" Saisir le numéro de téléphone ex : +221 77 000 00 00" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Prénom</label>
                  <input type="text" 
                          name="prenom"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le prénom du client" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Nom</label>
                  <input type="text"  
                          name="nom"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="saisir le nom du client"  
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label">Email</label>
                  <input type="text" 
                          name="email"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="saisir le mail du client"  
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="exampleFormControlSelect2">Specialite</label>
                  <select multiple class="form-control" id="exampleFormControlSelect2" name="specialite">
                    @foreach($types as $type)
                    <option value="{{$type->nom_type}}">{{$type->nom_type}}</option>
                    @endforeach                
                  </select> 
                <div class="valid-feedback">Looks good!</div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Site Web </label>
                  <input type="text" 
                          name="site"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le nom de l'entreprise">
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Pays</label>
                  <select id="selectPays" name="pays" class="form-control" required>
                    <option value="SEN">Sénégal</option>
                    @foreach($payss as $pays)
                    <option value="{{$pays->nom_fr_fr}}">{{$pays->nom_fr_fr}}</option>
                    @endforeach                
                  </select> 
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Ville </label>
                  <input type="text" 
                          name="ville"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir la ville">
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Code Postal </label>
                  <input type="text" 
                          name="code"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir la code postal">
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Adresse </label>
                  <textarea class="form-control" 
                            name="adresse" 
                            rows="3" 
                            id="textareaDefault">
                  </textarea>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Informations additionnelles</label>
                  <textarea class="form-control"
                            name="info" 
                            rows="3" 
                            id="textareaDefault">
                  </textarea>
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
    "keepInlineStyles":true,
    "maxHeight": 200,
    "minWidth":678,
    "search": true,
    "placeHolder": "Choose..." 
});
</script>