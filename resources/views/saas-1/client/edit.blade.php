@extends('saas-1.index')
@section('contenu')
<div class="row">
  <div class="card">
    <div class="card-header">
        <h5>Modification d'un produit
    <a href="{{route('client.index')}}" style="text-align:right; float:right;" 
					  class="btn btn-primary"  title="Lister les produits">
					 <i data-feather="list"></i> Clients</a> </h5>
    </div>
    
    <div class="card-body">
	<div class="row">

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
								<form action="{{route('client.update',$client->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									@method('put')
									  <input type="hidden" name="id" value="{{$client->id}}">

              						<div class="row">
                						
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Nom entreprise</label>
                  							<input type="text" 
                          							name="company"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->compagnie}}" readonly required>
                  							
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Numéro téléphone</label>
                  							<input type="phone" 
                          							name="tel"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->tel}}" required>
                  							
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Prénom</label>
                  							<input type="text" 
                          							name="prenom"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->prenom}}" required>
                  							
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Nom</label>
                    						<input type="text"  
                            						name="nom"  
                            						class="form-control" 
                            						id="validationCustom01" 
                            						value="{{$client->nom}}"  required>
                  							
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Email</label>
                  							<input type="text" 
                          							name="email"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->email}}"  required>
                  							
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Site Web </label>
                  							<input type="text" 
                          							name="site"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->site}}">
                  							
                						</div>
                						
              						</div>
              						<div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Ville </label>
                  							<input type="text" 
                         							name="ville"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->ville}}">
                  							
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Code Postal </label>
                  							<input type="text" 
                          							name="code"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->codep}}">
                  							
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Adresse </label>
                  							<input type="text" 
                          							name="adresse"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$client->adresse}}">
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Informations additionnelles</label>
                  							<textarea class="form-control"
                            							name="info" 
                            							rows="3" 
                            							id="textareaDefault">{{$client->infos}}
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
@endsection
