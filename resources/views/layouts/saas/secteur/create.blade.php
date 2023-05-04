@extends('saas.index')
@section('content')

<div class="row">
  <div class="col-md-12">
    <h4 class="header-title">Liste des Fonctions</h4>
    <h2 class="text-black">
			<a href="{{route('fonction.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
			  <em class="icon ni ni-plus"></em>
			  <span>Ajouter un Fonction</span>
		  </a>
		</h2>
    <p class="text-muted font-13 mb-4">
      Les informations affichées ci dessous sont les enregistrements des différents Fonctions de votre structure.
    </p>
  </div>
</div>   
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
  <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="statbox widget box box-shadow">
      <div class="widget-content widget-content-area">

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
                                    <form action="{{route('module.store')}}" method="post" enctype="multipart/form-data">
                                    	@csrf
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Formulaire d'ajout de module</h2>
										<p class="panel-subtitle">
											Veuillez renseigner les champs ci-dessous.
										</p>
									</header>
							<div class="panel-body">
                                    		
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Nom Module<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
								<input type="text" name="nom" class="form-control" placeholder="Nom du module" required/>
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
 
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Caption<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
								<input type="text" name="caption" class="form-control" placeholder="Caption" required/>
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
 
                                  <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Description<span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control" name="description" rows="3" id="textareaDefault"></textarea>
												</div>
											</div>   

								
                     
  									 
                                    </div> 
                                     
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
												<button class="btn btn-primary">Submit</button>
												<button type="reset" class="btn btn-default">Reset</button>
											</div>
										</div>
									</footer>
                                    

								</section>
							</form> 
 

        </div>
        </div>

 @endsection