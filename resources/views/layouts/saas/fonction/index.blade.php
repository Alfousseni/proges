@extends('saas.index')
@section('content')    
<div class="row">
  <div class="col-md-12">
    <h4 class="header-title">Liste des Fonctions</h4>
    <h2 class="text-black">
			<a href="{{route('fonction.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
			  <em class="icon ni ni-plus"></em>
			  <span>Ajouter un Fonction</span>
		  </a>
		</h2>
    <p class="text-muted font-13 mb-4">
      Les informations affichées ci dessous sont les enregistrements des différents Fonctions de votre structure.
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
              <th>Nom</th>
              <th>Caption</th>
              <th>Url</th>
              <th class="text-center dt-no-sorting">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($Fonctions as $Fonction)
            <tr>
              <td class="text-center">{{ $Fonction-> nom}}</td>
              <td class="text-center">{{ $Fonction-> capt}}</td>
              <td class="text-center">{{ $Fonction-> url}}</td>
              <td class="text-center">
              @if($Fonction->etat == 0)  
              <a href="{{route('fonction.show', $Fonction->id)}}" title="activer"  style="float:left;" 
               class="btn btn-primary btn-icon btn-rounded mb-2 me-1">
               <i data-feather="thumbs-down"></i></a>
               @elseif($Fonction->etat == 1)
               <a href="{{route('fonction.show', $Fonction->id)}}" title="désactiver"  style="float:left;" 
               class="btn btn-primary btn-icon btn-rounded mb-2 me-1">
               <i data-feather="thumbs-up"></i></a>
               @endif
               <a href="{{route('fonction.edit', $Fonction -> id)}}" title="editer"  style="float:left;" 
               class="btn btn-warning btn-icon btn-rounded mb-2 me-1">
               <i data-feather="edit"></i></a>
              <form id="destroy{{ $Fonction-> id}}"  onSubmit="return confirm('Confirmez-vous votre suppression?')" 
                action="{{route('fonction.destroy', $Fonction-> id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  @if($Fonction->etat == 0)
                  <button  class="btn btn-danger btn-icon btn-rounded mb-2 me-1"  style="float:left;" ><i data-feather="trash"></i></button>
                  @elseif($Fonction->etat == 1)
                  <button  class="btn btn-danger btn-icon btn-rounded mb-1 me-1"  style="float:left;" hidden><i data-feather="trash"></i></button>
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
        <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout de Fonction</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-12 bg-primary-light">
            <form action="{{route('fonction.store')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <p class="panel-subtitle">
                  Veuillez renseigner les champs ci-dessous.
                </p>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Nom fonction</label>
                  <input type="text" 
                          name="nom"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le nom de la fonction" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Caption</label>
                  <input type="text" 
                          name="capt"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le diminutif" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
               
              <div class="row">
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">Détails</label>
                  <textarea class="form-control"
                            name="detail" 
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



