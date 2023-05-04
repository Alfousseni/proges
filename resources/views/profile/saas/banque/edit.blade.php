@extends('BACK.index')
@section('contenu')     
<header class="page-header">
	<h2>Gestion des Paramètres</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Paramètre</span></li>
			<li><a href="/backoffice/societe/create"><span>Ajouter une banque</span></a></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>
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
		<form action="{{route('banque.update', $bank->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$bank->id}}">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire de modification de banque </h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
 				<div class="panel-body">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom de la banque
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-institution"></i>
							</span>
							<input type="text" 
									name="nom_banque" 
									value="{{$bank->nom_banque}}" 
									class="form-control" 
									placeholder="Nom de l'institut" 
									required
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Téléphone
						<span class="required">*</span>
					</label>
					<div class="col-sm-9">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-phone"></i>
							</span>
							<input type="tel" 
									name="tel" 
									value="{{$bank->tel}}" 
									class="form-control" 
									required
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email
						<span class="required">*</span>
					</label>
					<div class="col-sm-9">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-envelope"></i>
							</span>
							<input type="email" 
									name="email" 
									value="{{$bank->mail}}"
									class="form-control"  
									required
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
 				<div class="form-group">
					<label class="col-sm-3 control-label">gestionnaire
						<span class="required">*</span>
					</label>
					<div class="col-sm-9">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-globe"></i>
							</span>
							<input type="text" 
									name="gestionnaire" 
									value="{{$bank->gestionnaire}}" 
									class="form-control"  
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
 				<div class="form-group">
					<label class="col-sm-3 control-label">RIB
						<span class="required">*</span>
					</label>
					<div class="col-sm-9">
                    	<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-book"></i>
							</span>
							<input type="text" 
									name="rib" 
									value="{{$bank->rib}}" 
									class="form-control"  
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label" for="textareaDefault">Adresse</label>
					<div class="col-md-6">
						<textarea class="form-control"  
									name="adresse" 
									rows="3" >{{$bank->adresse}}
						</textarea>
					</div>
				</div> 
			</div>   
        	<footer class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<button class="btn btn-primary">Valider</button>
						<button type="reset" class="btn btn-default">Effacer</button>
					</div>
				</div>
			</footer>
    	</section>
	</form> 
 	@include('BACK/banque/index')
	</div>
</div>
@endsection