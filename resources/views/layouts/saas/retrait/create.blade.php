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
			<li><a href="#"><span>Ajouter un retrait</span></a></li>
			<li><a href="/voirretrait"><span>Liste des retraits</span></a></li>
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
        <form action="{{route('retrait.store')}}" method="post" enctype="multipart/form-data">
            @csrf
 			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire d'ajout de retrait</h2>
					<h2 class="text-black">
						<a href="/voirretrait" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Liste des Sorties</span>
						</a>
					</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
	            <div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nom du bénéficiaire 
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
										placeholder="Entrer nom du bénéficiaire" 
										required 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Montant Disponible 
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
										value="{{$montants}}" 
										readonly 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label">Montant retiré 
							<span class="required"></span>
						</label>
						<div class="col-sm-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-money"></i>
								</span>
								<input type="text" 
										name="montant" 
										class="form-control" 
										placeholder="Montant retiré" 
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

<div class="row">
	<div class="col-md-12">
		@include('BACK/retrait/liste')
	</div>
</div>
@endsection