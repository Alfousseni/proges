@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des Produit</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Produits</span></li>
			<li><a href="/BACK/produit/"><span>Lister les Produits</span></a></li>
			<li><a href="#"><span>Ajouter un produit</span></a></li>
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
	
		<form action="{{route('produit.store')}}" class="form-horizontal"  method="POST">
		@csrf	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout de produit</h2>
					<h2 class="text-black">
						<a href="{{route('produit.index')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Liste des produits</span>
						</a>
					</h2>
					<h2 class="text-black">
						<a href="/stock" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Stocker les Produits</span>
						</a>
					</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nom Produit 
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
										placeholder="Entrer le nom du produit" 
										required
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                          
                    <div class="form-group">
						<label class="col-sm-3 control-label">Type de produit</label>
						<div class="col-sm-9">
							<select id="company" name="typo" class="form-control" required>
								<option value="">-- Choisir un type --</option>
                                @foreach($types as $type)
                                <option value="{{$type->nom_type}}">{{$type->nom_type}}</option>
                                @endforeach
							</select>
							<label class="error" for="company"></label>
						</div>
					</div>        
                    <div class="form-group">
						<label class="col-md-3 control-label" for="textareaDefault">Caractéristique du produit</label>
						<div class="col-md-6">
							<textarea class="form-control" name="infos" rows="3" id="textareaDefault"></textarea>
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