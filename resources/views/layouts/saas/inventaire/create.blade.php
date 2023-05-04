@extends('saas.index')
@section('contenu')
<div  class="col-lg-12 layout-spacing layout-top-spacing">
                            <div class="statbox widget ">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
										<center>   <h4>Fiche des inventaires</h4> </center> 
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="card-header">
													  
							@foreach($magasins as $magasin)
						<form action="{{route('InventaireMagasin', $magasin->id)}}" id="mvs-form" class="form-horizontal" encmagasins="multipart/form-data">
              				@endforeach		
	@csrf
									 
									 

              						<div class="row">
                						
                						<div class="col-md-12">
										<center><label for="validationCustom01" class="form-label">Choix de magazin</label></center>
										
										<select id="company"  class="form-control" required>
								@foreach($magasins as $magasin)
									<option value="{{$magasin->id}}">{{$magasin->nom_mag}}</option>
									 
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




