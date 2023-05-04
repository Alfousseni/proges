@extends('BACK.index')
@section('contenu')     
<header class="page-header">
	<h2>Gestion des utilisateurs</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li>
                <span>Ajouter</span>
            </li>
			<li><a href=""><span>Utilisateur</span></a></li>
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
        <form action="{{route('register')}}" class="form-horizontal" enctype="multipart/form-data" method="GET">
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
                    <h2 class="panel-title">Formulaire d'ajout d'utilisateur</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
                <div class="panel-body">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom complet 
                            <span class="required">*</span>
                        </label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
			                    <input type="text" 
                                        name="name" 
										id="name"
                                        class="form-control" 
                                        placeholder="Entrer le nom complet de l'utilisateur" 
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
                                        placeholder="ex: email@email.com" 
                                        required
                                />
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Mot de passe 
                            <span class="required">*</span>
                        </label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>
								</span>
					            <input type="password" 
                                        name="pass" 
                                        class="form-control"  
                                        required
                                />
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Confirmer mot de passe<span class="required">*</span></label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>
								</span>
								<input type="password" 
										name="pass1" 
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
							<button type="reset" class="btn btn-default">Reset</button>
						</div>
					</div>
				</footer>
            </section>
		</form> 
	</div>
</div> 
@endsection