@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des Paramètres</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Paramètre</span></li>
			<li><a href="#"><span>Ajouter un magasin</span></a></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right">
			<i class="fa fa-chevron-left"></i>
		</a>
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
		<form action="{{route('magasin.store')}}" class="form-horizontal"  method="POST">
		@csrf	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout de magasin</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom du magasin
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom_mag" 
										class="form-control" 
										placeholder="Nom du magasin" required
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
										class="form-control" 
										placeholder="Entrer un numero de telephone" required
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
										class="form-control" 
										placeholder="ex: email@email.com" required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom du responsable 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="responsable" 
										class="form-control" 
										placeholder="Entrer le nom complet du responsable" required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-md-3 control-label" for="textareaDefault">Adresse</label>
						<div class="col-md-6">
							<textarea class="form-control" name="adresse" rows="3" id="textareaDefault"></textarea>
						</div>
					</div>   
                </div> 
                <footer class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
					</div>
				</footer>
            </section>
		</form> 
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		@include('BACK/magasin/index')
	</div>
</div>
@endsection