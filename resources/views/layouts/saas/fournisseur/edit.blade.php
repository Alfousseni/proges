@extends('saas.index')
@section('contenu')
<div  class="col-lg-12 layout-spacing layout-top-spacing">
                            <div class="statbox widget ">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
										<center>   <h4>Formulaire de Modification</h4> </center> 
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="card-header">
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
								<form action="{{route('fournisseur.update',$fournisseur->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									  @method('put')
									  <input type="hidden" name="id" value="{{$fournisseur->id}}">

              						<div class="row">
                						
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Prénom</label>
	<input type="text" name="prenom" class="form-control" placeholder="Entrer votre prénom"  value="{{$fournisseur->prenom}}" required>

                  							
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Nom</label>
											  <input type="text" name="nom" class="form-control" placeholder="Entrer un nom" required/ value="{{$fournisseur->nom}}">
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Email</label>
											  <input type="email" name="email" class="form-control" placeholder="veuillez saisir votre email" / value="{{$fournisseur->email}}">
                  							
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Téléphone</label>
											  <input type="tel" name="tel" class="form-control" placeholder="Entrer le numéro de téléphone" required/ value="{{$fournisseur->tel}}">
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Nom de l'entreprise</label>
											  <input type="text" name="company" class="form-control" placeholder="Entrer le nom de l'entreprise" / value="{{$fournisseur->compagnie}}">
                						</div>
              						</div>
									  <div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Site Web </label>
											  <input type="text" name="site" class="form-control" placeholder="Entrer le site web" / value="{{$fournisseur->site}}">
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Pays</label>
                  							<select id="selectPays" name="pays" class="form-control" required>
                    							@if($fournisseur->pays!=null)
                    								<option value="{{$fournisseur->pays}}">{{$fournisseur->pays}}</option>
                    							@endif
                    							@foreach($payss as $pays)
                    								<option value="{{$pays->nom_fr_fr}}">{{$pays->nom_fr_fr}}</option>
                    							@endforeach                
                  							</select> 
                  							
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Ville </label>
											  <input type="text" name="ville" class="form-control" placeholder="Entrer la ville" / value="{{$fournisseur->ville}}">
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Code Postal </label>
											  <input type="text" name="code" class="form-control" placeholder="Entrer le code postal" / value="{{$fournisseur->codep}}">
                						</div>
              						</div>
              						<div class="row">
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Adresse </label>
                  							<textarea class="form-control" 
                            							name="adresse" 
                            							rows="3" 
                            							id="textareaDefault">{{$fournisseur->adresse}}
                  							</textarea>
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Informations additionnelles</label>
                  							<textarea class="form-control"
                            							name="info" 
                            							rows="3" 
                            							id="textareaDefault">{{$fournisseur->info}}
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
