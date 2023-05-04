@extends('saas.index')
@section('content')
 

<div class="container">

<!-- BREADCRUMB -->
<div class="page-meta">
	<nav class="breadcrumb-style-one" aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Accueil</a></li>
			<li class="breadcrumb-item" aria-current="page"><a href="{{route('fonction.index')}}">Fonction</a></li>
			<li class="breadcrumb-item active" aria-current="page">Editer</li>
		</ol>
	</nav>
</div>
<!-- /BREADCRUMB -->
<div  class="col-lg-12 layout-spacing layout-top-spacing">
		<div class="statbox widget ">
			<div class="widget-header">                                
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
					<center>   <h4>Formulaire de Modification d'une fonction</h4> </center> 
					</div>                                                                        
				</div>
			</div>
			<div class="card-header layout-spacing">
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




            <form action="{{route('fonction.update', $Fonction->id)}}" method="post" enctype="multipart/form-data">
				@csrf
                @method('put')
                <input type="hidden" name="id" value="{{$Fonction->id}}">
              <div class="row mb-3">
                <p class="panel-subtitle">
                  Veuillez renseigner les champs ci-dessous.
                </p>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Nom fonction</label>
                  <input type="text" 
                          name="nom"  
                          class="form-control" 
                          id="validationCustom01" 
                          value="{{$Fonction->nom}}"
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Caption</label>
                  <input type="text" 
                          name="capt"  
                          class="form-control" 
                          id="validationCustom01" 
						  value="{{$Fonction->capt}}"
                          required>
                  <div class="valid-feedback">Looks good!</div>
                </div>
              </div>
               
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">Détails</label>
                  <textarea class="form-control"
                            name="detail" 
                            rows="3" 
                            id="demo1">{{$Fonction->detail}}
                  </textarea>
                </div>
              </div>     
               
			              <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary mb-2 me-4">Modifier</button>
                            </div>

                             </form> 
                              
		       
						</div> 
                    </div>
            </div>



 @endsection