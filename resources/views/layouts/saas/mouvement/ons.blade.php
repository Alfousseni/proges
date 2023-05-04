@extends('saas.index')
@section('contenu')
<div  class="col-lg-12 layout-spacing layout-top-spacing">
                            <div class="statbox widget ">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
										<center>   <h4>Fiche des mouvements</h4> </center> 
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="card-header">
								@foreach($users as $user)			
	
	<form action="{{route('mouvement.show', $user->id)}}" id="mvs-form" class="form-horizontal" encusers="multipart/form-data">
              				@endforeach		
	@csrf
									 
									 

              						<div class="row">
                						
                						<div class="col-md-12">
										<center><label for="validationCustom01" class="form-label">Choix du prestataire</label></center>
										
										<select id="company"  class="form-control" required>
										@foreach($users as $user)
										
                                            <option value="{{$user->id}}">{{$user->name}}</option>
											@endforeach  
                                               </select>
											  
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
