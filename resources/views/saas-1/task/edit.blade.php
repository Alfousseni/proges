@extends('saas-1.index')
@section('contenu')
<div class="row">
  <div class="card">
    <div class="card-header">
        <h5>Modification d'un projet
    <a href="{{route('client.index')}}" style="text-align:right; float:right;" 
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
                          							value="{{$project->name}}" readonly required>
                  							
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Description du prjet</label>
                  							<input type="text" 
                          							name="description"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$project->description}}" required>
                  							
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
              						<div class="modal-footer">
                						<button class="btn btn-primary">Valider</button>
                						<button type="reset" class="btn btn-default">Annuler</button>
              						</div>
            					</form> 

                                    

                                </div>
                            </div>
                        </div>
@endsection
