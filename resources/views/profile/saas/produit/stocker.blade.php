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
			<li><a href="/BACK/produit/"><span>Modifier Produit</span></a></li>
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
		<form action="{{route('stockerprod', $stock->id)}}" class="form-horizontal"  method="POST">
		@csrf	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire de gestion de stock</h2>
					<h4 class="text-black">
						<a href="/stock" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Voir le stock</span>
						</a>
					</h4>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">ref</label>
						<div class="col-sm-3">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="ref"
										class="form-control"
										value="{{$stock->reference}}" 
										readonly
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nom Produit </label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom" 
										class="form-control"
										value="{{$stock->nomprod}}" 
										readonly
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Quantité Disponible
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								@if($stock->qte_stock!=null)
								<input type="number" 
										name="qte" 
										class="form-control"
										value="{{$stock->qte_stock}}"  
								/>
								@else
								<input type="number" 
										name="qte" 
										class="form-control"  
								/>
								@endif
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>  
					<div class="form-group">
						<label class="col-sm-3 control-label">Seuil 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
								</span>
								@if($stock->seuil!=null)
								<input type="number" 
										name="seuil" 
										class="form-control" 
										value="{{$stock->seuil}}" 
								/>
								@else
								<input type="number" 
										name="seuil" 
										class="form-control" 
								/>
								@endif
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>           
                    <div class="form-group">
						<label class="col-sm-3 control-label">Prix d'Achat</label>
						<div class="col-sm-9">
						@if($stock->prix_achat != null)
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="integer" 
										name="prixa" 
										class="form-control" 
										value="{{$stock->prix_achat}}" 
								/>
							</div>
						@elseif($stock->prix_achat== null)
							<p style="color:green"> si vous n'avez pas encore les prix exacts, ne ous inquitez pas cele peut attendre</p>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="integer" 
										name="prixa" 
										class="form-control"  
								/>	
							</div>
						@endif
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Prix de Vente</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								@if($stock->prix_vente != null)
                                <input type="integer" 
										name="prixv" 
										class="form-control" 
										value="{{$stock->prix_vente}}" 
								/>
                                @elseif($stock->prix_vente== null)
								<input type="integer" 
										name="prixv" 
										class="form-control"  
								/>
								@endif
							</div>
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
	</div>
</div>
@endsection