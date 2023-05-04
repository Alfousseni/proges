@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des Parametres</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Produits</span></li>
			<li><a href="/BACK/type_prod/create"><span>Ajouter type </span></a></li>
			<li><a href="#"><span>Modification type</span></a></li>
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
		<form action="{{route('type_prod.update', $type->id)}}" class="form-horizontal"  method="POST">
		@csrf
		@method('put')	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire de modification de type</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nom de type de produit
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom_type" 
										class="form-control" 
										value="{{$type->nom_type}}" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>  
                </div> 
                <footer class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button class="btn btn-primary">modifier</button>
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
		@include('BACK/type_prod/index')
	</div>
</div>
@endsection