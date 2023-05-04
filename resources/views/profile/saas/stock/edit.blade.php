@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des stocks</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li><a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Stock</span></li>
			<li><a href="#"><span>Approvisionner un magasin</span></a></li>
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

		<form action="{{route('stock.update', $appro->id)}}" class="form-horizontal" enctype="multipart/form-data" method="post">
 		@csrf
		@method('put')				 
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'approvisionnement de magasin</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
                <input type="hidden" name="num" value="{{$appro->id}}">
                <input type="hidden" name="ref" value="{{$appro->reference}}">
                <div class="panel-body">
                    <div class="form-group">
						<label class="col-sm-3 control-label">Choisir un magasin</label>
						<div class="col-sm-9">
							<select id="company" name="mag" class="form-control" required>
								<option value="">-- votre magasin ici --</option>
                                @foreach($magasins as $magasin)
                                <option value="{{$magasin->nom_mag}}">{{$magasin->nom_mag}}</option>
                                @endforeach
							</select>
							<label class="error" for="company"></label>
						</div>
					</div>       
                    <div class="form-group">
						<label class="col-sm-3 control-label">Nom du produit</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-cubes"></i>
								</span>
								<input type="text" 
										name="nom" 
										class="form-control" 
										value="{{$appro->nomprod}}" 
										readonly 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Stock Disponible</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-cubes"></i>
								</span>
								<input type="text" 
										name="qte" 
										class="form-control" 
										value="{{$appro->qte_stock}}" 
										readonly 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
                    <div class="form-group">
						<label class="col-sm-3 control-label">Quantité à stocker
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-cubes"></i>
								</span>
								<input type="text" 
										name="ret" 
										class="form-control" 
										placeholder="entrer la quantité à insérer" 
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
                            <input type="submit" value="Valider" class="btn btn-primary">
                            <input type="reset" value="Effacer" class="btn btn-primary">
  						</div>
					</div>
				</footer>
			</section>
        </form>
	</div>
</div>
@endsection