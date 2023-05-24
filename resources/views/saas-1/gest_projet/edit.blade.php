@extends('saas-1.index')
@section('contenu')
<div class="row">
  <div class="card">
    <div class="card-header">
        <h5>Modification d'un projet
    <a href="{{route('voirlistep')}}" style="text-align:right; float:right;" 
					  class="btn btn-primary"  title="Lister les produits">
					 <i data-feather="list"></i> Projet</a> </h5>
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
								<form action="{{route('project.update',$project->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									@method('put')
									  <input type="hidden" name="id" value="{{$project->id}}">

              						<div class="row">
                						
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Nom du projet</label>
                  							<input type="text" 
                          							name="nom"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$project->name}}"  required>
                  							
                						</div>
										<div class="row">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Type de projet</label>
                                                <select type="text" name="type" class="form-control"
                                                    id="validationCustom01" placeholder="Saisir la description du projet"
                                                    required>
                                                        <option value="ineterne" {{ $project->type == 'interne' ? 'selected' : '' }}>Interne</option>                                                     
                                                        <option value="externe" {{ $project->type == 'externe' ? 'selected' : '' }}>Externe</option>
                                                </select>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Nombre de participant</label>
                                                <input type="number" value="{{$project->nbr_de_participant}}"  name="personne" class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div> 
                                       </div>
                                       <div class="row ">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Budget</label>
                                                <input type="number" name="budget" value="{{$project->budget}}"  class="form-control"
                                                    id="validationCustom01" 
                                                    required>
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Etat</label>
                                                <select type="text" name="etat" class="form-control" id="validationCustom01" required>
													<option value="Null">Etat du projet</option>
													<option value="en attente" {{ $project->etat == 'en attente' ? 'selected' : '' }}>En attente</option>
													<option value="en cours" {{ $project->etat == 'en cours' ? 'selected' : '' }}>En cours</option>
													<option value="fin" {{ $project->etat == 'fin' ? 'selected' : '' }}>Fin</option>
												</select>
												
                                                <div class="valid-feedback">Looks good!</div>
                                            </div>
                                       </div>
                                       <div class="col-md-4">
                                        <label for="validationCustom01" class="form-label">Priorite</label>
                                        <select type="text" name="Initialiser" class="form-control" id="validationCustom01" required>
                                            <option value="Null">Prioriter du projet</option>
                                            <option value="haute" {{ $project->priorite == 'haute' ? 'selected' : '' }}>Haute</option>
                                            <option value="moyenne" {{ $project->priorite == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                                            <option value="fin" {{ $project->priorite == 'basse' ? 'selected' : '' }}>Basse</option>
                                        </select>
                                        
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
              						</div>
              						<div class="row">
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">date de debut</label>
                  							<input type="date" 
                          							name="start_date"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$project->start_date}}" required>
                  							
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Date de fin</label>
                    						<input type="date"  
                            						name="end_date"  
                            						class="form-control" 
                            						id="validationCustom01" 
                            						value="{{$project->end_date}}"  required>
                  							
                						</div>
                
              						</div>
									  <div class="col-md-4 w-100 border">
										<label for="validationCustom01" class="form-label">DESCRIPTION DU PROJET</label>
										<input type="text" name="description" 
											id="demo1" 
											value="{{$project->description}}" required>
										<div class="valid-feedback">Looks good!</div>
									</div >			     
              						<div class="modal-footer">
                						<button class="btn btn-primary">Valider</button>
                						<button type="reset" class="btn btn-default">Annuler</button>
              						</div>
            					</form> 

                                    

                                </div>
                            </div>
                        </div>
@endsection
