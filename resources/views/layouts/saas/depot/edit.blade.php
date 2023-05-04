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
								<form action="{{route('depot.update',$depot->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									  @method('put')
									  <input type="hidden" name="id" value="{{$depot->id}}">

              						<div class="row">
                						
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Nom du dépositaire</label>
	<input type="text" name="nom" class="form-control" placeholder="Entrer le nom du dépositaire"  value="{{$depot->nom_prop}}" required>

                  							
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Montant encaisse</label>
											  <input type="text" name="caisse" class="form-control" placeholder="Entrer le montant encaisse" required/ value="{{$depot->montant}}">
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
