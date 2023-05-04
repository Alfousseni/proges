@extends('saas.index')
@section('contenu')
<div class="row">
  <div class="col-md-12">
    <h4 class="header-title">Liste des entrées caisse</h4>
    <h2 class="text-black">
			<a href="{{route('retrait.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
			  <em class="icon ni ni-plus"></em>
			  <span>Ajouter un retrait</span>
			</a>
		</h2>
    <h2 class="text-black">
      <a href="/voirretrait" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
				<em class="icon ni ni-plus"></em>
				<span>Imprimer la liste</span>
			</a>
		</h2>
    <p class="text-muted font-13 mb-4">
      Les informations affichées ci dessous sont les enregistrements des différents entrées caisse de votre structure.
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
              <th>N°</th> 
              <th>Date retrait</th>
              <th>Nom Bénéficiaire</th>
              <th>Montant retiré</th>
                      
              <th class="text-center dt-no-sorting">Action</th>
            </tr>
          </thead>
          <tbody>
 			    @foreach($retraits as $retrait)
            <tr>
              <td>{{$retrait->id}}</td>
              <td>{{$retrait->created_at}}</td>
              <td>{{$retrait->nom_ret}}</td>
              <td>{{$retrait->montant_ret}}</td>  
              <td class="text-center">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1"> 
                    <a class="dropdown-item" href="{{route('retrait.edit', $retrait -> id)}}">Editer</a>
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
        <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout de sortie de caisse</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-12 bg-primary-light">
            <form action="{{route('retrait.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <p class="panel-subtitle">
                  Veuillez renseigner les champs ci-dessous.
                </p>
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">nom du beneficiaire</label>
                  <input type="text" 
                          name="nom"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le nom du beneficiaire " 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">Montant disponible</label>
                  <input type="text" 
                          name="caisse"  
                          class="form-control" 
                          id="validationCustom01" 
                          value="{{$montants}}" 
										      readonly >
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Montant retiré</label>
                  <input type="text" 
                          name="montant"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le montant a retirer" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
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


			
