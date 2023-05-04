@extends('BACK.index')
@section('contenu')
<header class="page-header">
	<h2>Gestion des produits</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="/backoffice">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Produits</span></li>
				<li><a href="/BACK/produit/create"><span>Ajouter un Produit</span></a></li>
				<li><span>Lister les Produits</span></li>
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
				<span>Ajouter des produits</span>
			</a>
		</h2>
		<h2 class="text-black">
      <a href="/stock" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
				<em class="icon ni ni-plus"></em>
				<span>Stocker les Produits</span>
			</a>
		</h2>
    <h2 class="panel-title">Liste des produits</h2>
  </header>
	<div class="panel-body">
 		<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
      <thead>
        <tr>
          <th>Numero</th>
          <th>Nom produit</th>
          <th>Type produit</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
 			@foreach($produits as $produit)
        <tr>
          <td>{{$produit->numero}}</td>
          <td>{{$produit->nom_prod}}</td>
          <td>{{$produit->type_prod}}</td> 
          <td align="center"> 
            <a href="{{ route('voirprod',$produit->id)}}">
              <i class="fa fa-eye"></i>
            </a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="{{route('produit.edit', $produit -> id)}}">
              <i class="fa fa-edit"></i> 
            </a>&nbsp;&nbsp;|&nbsp;&nbsp;
            <form id="destroy{{ $produit-> id}}" action="{{route('produit.destroy', $produit -> id)}}" method="POST">
            @csrf
            @method('DELETE')
              <a href="" title="Supprimer"  onclick="event.preventDefault();this.closest('form').submit();">
                <i class="fa fa-trash-o"></i>
              </a> 
            </form>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

			
