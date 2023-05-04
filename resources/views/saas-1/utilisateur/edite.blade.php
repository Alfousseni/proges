@extends('saas-1.index')
@section('contenu')
<div class="row">
  <div class="card">
    <div class="card-header">
        <h5>Modification d'un utilisateur
    </h5>
    </div>
    
    <div class="card-body">
     
	 
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
  	<div class="row">
          <div class="col-md-12 bg-primary-light">
           
		<form action="{{route('update.user1',$user->id)}}" method="post" enctype="multipart/form-data">
              	  @csrf
		  @method('put')
			<input type="hidden" name="id" value="{{$user->id}}">
				<div class="row">
                						
                		<div class="col-md-6">
                  		<label for="validationCustom01" class="form-label">Nom </label>
	<input type="text" name="name" class="form-control"  value="{{$user->name}}" required>	
                						</div>
                						<div class="col-md-6">
                  							<label for="validationCustom01" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"  value="{{$user->email}}" >		
						</div>
              						</div><br><br>
									  <div class="row">
							<div class="col-md-6">
							<label for="validationCustom01" class="form-label">Nouveau password </label>
									<input type="password" class="form-control" name="nouveau"  required><br>
							</div>
							<div class="col-md-6">
							<label for="validationCustom01" class="form-label">Confirmer password </label>
									<input type="password" class="form-control" name="nouveau1"  required>
							</div>
						</div>	
						
              						</div>   
									  <div class="col-12">
        <div class="mb-3 position-relative">
            <label class="form-label small fw-bold">Entreprise <span class="text-danger">*</span></label>
            <select id="company" name="societe" class="form-control" readonly required>
              @foreach($societes as $societ)
             <option value="{{$societ->id}}">{{$societ->nom_societe}}</option>
              @endforeach
            </select>
        </div>
		<p style="color:#000080;">Votre mot de passe doit contenir au moins 8 caracteres</p>

    </div>		
              						<div class="modal-footer">
                						<button type="submit" class="btn btn-primary">Modifier</button>
              						</div>
            					</form> 

              </div>
        </div> 
        
        
      </div>
    </div>
  </div>
@endsection
 
