@extends('BACK.index')
@section('contenu')
<header class="page-header">
	<h2>Gestion des Paramètres</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php"><i class="fa fa-home"></i></a>
			</li>
			<li><span>Paramètre</span></li>
			<li><a href="/BACK/magasin/create"><span>Ajouter un magasin</span></a></li>
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
		<form action="{{route('magasin.update', $magasin->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$magasin->id}}">
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
						<label class="col-sm-3 control-label">Nom du magasin</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom" 
										value="{{$magasin->nom_mag}}"  
										class="form-control" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Téléphone</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-phone"></i>
								</span>
								<input type="tel" 
										name="tel" 
										value="{{$magasin->tel}}" 
										class="form-control" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
								<input type="email" 
										name="email" 
										value="{{$magasin->email}}" 
										class="form-control" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom du responsable</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="responsable" 
										value="{{$magasin->responsable}}" 
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
										rows="3" 
										id="textareaDefault">{{$magasin->adresse}}
							</textarea>
						</div>
					</div>   
                </div> 
                <footer class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-primary">Valider</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
					</div>
				</footer>
            </section>
		</form> 
		@include('BACK/magasin/index')
	</div>
</div>
@endsection