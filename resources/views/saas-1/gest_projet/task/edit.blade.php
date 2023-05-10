@extends('saas-1.index')
@section('contenu')
<div class="row">
  <div class="card">
    <div class="card-header">
        <h5>Modification d'une tache
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
								<form action="{{route('task.update',$task->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									@method('put')
									  <input type="hidden" name="id" value="{{$task->id}}">

              						<div class="row">
                						
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Nom de la tache</label>
                  							<input type="text" 
                          							name="nom"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$task->name}}"  required>
                  							
                						</div>
                						
              						</div>
              						<div class="row">
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">date de debut</label>
                  							<input type="date" 
                          							name="start_date"  
                          							class="form-control" 
                          							id="validationCustom01" 
                          							value="{{$task->start_date}}" required>
                  							
                						</div>
                						<div class="col-md-4">
                  							<label for="validationCustom01" class="form-label">Date de fin</label>
                    						<input type="date"  
                            						name="end_date"  
                            						class="form-control" 
                            						id="validationCustom01" 
                            						value="{{$task->end_date}}"  required>
                  							
                						</div>
										{{-- <div class="col-md-4">
											<label for="validationCustom01" class="form-label">Charger de taches</label>
											<select type="text" name="user" class="form-control"
												id="validationCustom01" placeholder="Saisir la description du projet"
												required>
													@foreach($users as $user)                                                     
													<option value="{{$user->id}}">{{$user->name}} </option>
													@endforeach
											</select>
											<div class="valid-feedback">Looks good!</div>
										</div> --}}
                
              						</div>
									  <div class="col-md-4 w-100 border">
										<label for="validationCustom01" class="form-label">DESCRIPTION DE LA TACHE</label>
										<input type="text" name="description" 
											id="demo2" 
											value="{{$task->description}}" required>
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
