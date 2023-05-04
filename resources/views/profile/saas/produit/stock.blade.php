@extends('BACK.index')
@section('contenu')
<header class="page-header">
	<h2>Gestion de Stock</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="/backoffice">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Produits</span></li>
				<li><a href="/BACK/produit/create"><span>stocker un Produit</span></a></li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right">
        <i class="fa fa-chevron-left"></i></a>
			</div>
</header>
<div class="row">
	<div class="col-md-12">
  @if(session()->has('mes'))
  <div class="alert alert-icon alert-success">
    <em class="icon ni ni-alert-circle"></em>
    {{session('mes')}}
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
  <header class="panel-heading">
	  <div class="panel-actions">
		  <a href="#" class="fa fa-caret-down"></a>
		  <a href="#" class="fa fa-times"></a>
	  </div>
    <h2 class="text-black">
			<a href="{{route('produit.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
				<em class="icon ni ni-plus"></em>
				<span>Ajouter un produit</span>
			</a>
		</h2>
    <h2 class="panel-title">Liste des produits</h2>
  </header>
	<div class="panel-body">
 		<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
      <thead>
        <tr>
          <th>reference</th>
          <th>Nom produit</th>
          <th>qte disponible</th>
		  <th>seuil de stock</th>
		  <th>prixd'achat</th>
		  <th>prix de vente</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
 			@foreach($stocks as $stock)
        <tr>
          <td>{{$stock->reference}}</td>
          <td>{{$stock->nomprod}}</td>
          <td>{{$stock->qte_stock}}</td> 
		      <td>{{$stock->seuil}}</td>
		      <td>{{$stock->prix_achat}}</td>
		      <td>{{$stock->prix_vente}}</td>
          <td align="center"> &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="{{route('stocker',$stock->id)}}">
              <i class="fa fa-download"></i>
            </a>&nbsp;&nbsp;|&nbsp;&nbsp;
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

			
