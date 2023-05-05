@extends('saas.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des clients</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Projet</span></li>
			<li><a href="/BACK/projet/"><span>Lister les Projets</span></a></li>
			<li><a href="#"><span>Ajouter un Projet</span></a></li>
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
        <form action="{{route('projet.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout d'un projet</h2>
					<h2 class="text-black">
						<a href="{{route('projet.index')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Liste des projet</span>
						</a>
					</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
                	<div class="form-group">
						<label class="col-sm-3 control-label">Nom 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom" 
										class="form-control" 
										placeholder="Saisir le nom du projet" 
										required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Description 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="descriprtion" 
										class="form-control" 
										placeholder="saisir la description du projet" 
										required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">date de lancement 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
								<input type="texte" 
										name="start_date" 
										class="form-control" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">date de livraison du projet  
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-phone"></i>
								</span>
								<input type="text" 
										name="end_date" 
										class="form-control" 
										 
										required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
                </div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-primary">Valider</button>
							<button type="reset" class="btn btn-default">Annuler</button>
						</div>
					</div>
				</footer>
			</section>
		</form> 
  	</div>
</div> 
@endsection