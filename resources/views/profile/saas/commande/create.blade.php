@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des commandes</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>commandes</span></li>
			<!--li><a href="/BACK/produit/"><span>Lister les Produits</span></a></li-->
			<li><a href="#"><span>Ajouter une commande</span></a></li>
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
		<form action="{{route('commande.store')}}" class="form-horizontal" enctype="multipart/form-data" method="POST">
			@csrf
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout de commande</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
            		<div class="form-group">
						<label class="col-sm-3 control-label">Choix du fournisseur</label>
						<div class="col-sm-9">
							<select id="company" name="fournisseur" class="form-control" required>
								<option value="">-- Choisir un fournisseur --</option>
                            		@foreach($fournisseurs as $fournisseur)
                        		<option value="{{$fournisseur->numero}}">{{$fournisseur->prenom}} &nbsp; {{$fournisseur->nom}} </option>
                           			 @endforeach
							</select>
							<label class="error" for="company"></label>
						</div>
					</div>       
					<div class="form-group">
						<label class="col-sm-3 control-label">Mode de paiment</label>
						<div class="col-sm-9">
							<select id="company" name="modep" class="form-control" required>
                        		<option value="Espece">Espece</option>
                        		<option value="Cheque">Cheque</option>
                        		<option value="Virement">Virement</option>
							</select>
							<label class="error" for="company"></label>
						</div>
					</div>       
					
				</div>
				@foreach($transs as $trans)
				<input type="hidden"  name="numc" value="{{$trans -> numcmd}} " />
				@endforeach
 				<div class="panel-body">
 					<table class="table table-bordered table-striped mb-none" > 
                		<thead>
                    		<tr>
                      			<th>N°</th>
                     			<th>Numero</th>
                      			<th>Nom produit</th>
                      			<th>Qté à commander</th>
                      			<th>Prix unitaire</th>
                    		</tr>
                		</thead>
                		<tbody>
								@foreach($tmps as $tmp)
                    		<tr>
			   		  			<td><input type="hidden"  name="id" value="{{$tmp->id}}" />{{$tmp->id}}</td>
                      			<td><input type="hidden"  name="ref[]" value="{{$tmp->refprod}}>"/>{{$tmp->refprod}}</td>
                      			<td><input type="hidden"  name="nom[]" value="{{$tmp->nomprod}}"/>{{$tmp->nomprod}}</td>
                      			<td><input type="number" name="qte[]" required></td>
                      			<td><input type="double" name="prixu[]" required></td>
                    		</tr>
								@endforeach
						</tbody>
            		</table>
        		</div>
    			<footer class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-primary">Valider</button>
								<a href=""  class="btn btn-primary" style="color:#FFFFFF" onClick="return annulation()">Annuler
								</a>
						</div>
					</div>
				</footer>
			
		</form>
	</div>
</div>        
@include("BACK/commande/add_produit")
@endsection