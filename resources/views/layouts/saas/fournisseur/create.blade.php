@extends('saas.index')
@section('contenu')

<header class="page-header">
	<h2>Gestion des fournisseurs</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Fournisseur</span></li>
			<li><a href="/BACK/fournisseur"><span>Lister Fournisseur</span></a></li>
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
        <form action="{{route('fournisseur.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout de fournisseur</h2>
					<h2 class="text-black">
						<a href="{{route('fournisseur.index')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Liste des fournisseurs</span>
						</a>
					</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Prénom 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="prenom" 
										class="form-control" 
										placeholder="Entrer votre prénom" 
										required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
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
										placeholder="Entrer un nom" 
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
										class="form-control" 
										placeholder="ex.: email@email.com" 
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
										placeholder="Entrer le numéro de téléphone" 
										required
								/>
							</div>
						</div>
					<div class="col-sm-9"></div>
				</div>
                <div class="form-group">
					<label class="col-sm-3 control-label">Nom de l'entreprise 
						<span class="required"></span>
					</label>
					<div class="col-sm-9">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-institution"></i>
							</span>
							<input type="text" 
									name="company" 
									class="form-control" 
									placeholder="Entrer le nom de l'entreprise" 
							/>
						</div>
					</div>
					<div class="col-sm-9"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Specialite du fournisseur</label>
						<div class="col-sm-9">
							<select id="specialite" name="specialite[]" class="form-control" multiple>
    					        <option value="">-- Choisir les specialités --</option>
                            	@foreach($types as $type)
                            	<option value="{{$type->nom_type}}">{{$type->nom_type}}</option>
                            	@endforeach
                            </select>
							<label class="error" ></label>
						</div>
					</div>                          
                <div class="form-group">
					<label class="col-sm-3 control-label">Site Web </label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-globe"></i>
								</span>
								<input type="text" 
										name="site" 
										class="form-control" 
										placeholder="Entrer le site web" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Pays</label>
						<div class="col-sm-9">
							<select id="company" name="pays" class="form-control">
    					        <option value="">-- Choisir un pays --</option>
                            	@foreach($payss as $pays)
                            	<option value="{{$pays->nom_fr_fr}}">{{$pays->nom_fr_fr}}</option>
                            	@endforeach
                            </select>
							<label class="error" ></label>
						</div>
					</div>       
                    <div class="form-group">
						<label class="col-sm-3 control-label">Ville</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-globe"></i>
								</span>
								<input type="text" 
										name="ville" 
										class="form-control" 
										placeholder="Entrer la ville" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Code Postal</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-globe"></i>
								</span>
								<input type="text" 
										name="code" 
										class="form-control" 
										placeholder="Entrer le code postal" 
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
                    <div class="form-group">
						<label class="col-md-3 control-label" for="textareaDefault">Informations additionnelles</label>
						<div class="col-md-6">
							<textarea class="form-control" name="info" rows="3" id="textareaDefault"></textarea>
						</div>
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