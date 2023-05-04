@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion de la comptabilité</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Comptabilité</span></li>
			<li><a href="#"><span>Modifier un dépot</span></a></li>
			<li><a href="/BACK/depot/create"><span>Ajouter un dépot</span></a></li>
			<li><a href="/voirdepot"><span>Liste des dépots</span></a></li>
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
		<form action="{{route('depot.store')}}" class="form-horizontal"  method="POST">
		@csrf	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire de modification de dépot</h2>
					<h2 class="text-black">
						<a href="/voirdepot" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Liste des Entrées</span>
						</a>
					</h2>
					<h2 class="text-black">
						<a href="/BACK/depot/create" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Créer une Entrée</span>
						</a>
					</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">nom du depositaire 
							<span class="required"></span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-money"></i>
								</span>
								<input type="text" 
										name="nom" 
										class="form-control"
										value="{{$depot->nom_prop}}"
										required 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Montant encaissé 
							<span class="required"></span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-money"></i>
								</span>
								<input type="text" 
										name="caisse" 
										class="form-control" 
										value="{{$depot->montant}}"
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
							<button type="reset" class="btn btn-default">effacer</button>
						</div>
					</div>
				</footer>
            </section>
		</form> 
	</div>
</div>
@endsection