@extends('BACK.index')
@section('contenu')
<header class="page-header">
	<h2>Gestion des commande</h2>
  <div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
						<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>commande</span></li>
      <li><a href="/transactionC"><span>Ajouter une commande</span></a></li>
			<li><a href="#"><span>Liste des commande livrés</span></a></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
<div class="row">
	<div class="col-md-12">
  @if(session()->has('messsage'))
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
 		<header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="panel-title">Liste des commande livrés</h2>
		</header>
		<div class="panel-body">
 			<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
        <thead>
          <tr>
            <th>Numero</th>
            <th>Fournisseur</th>
            <th>Nombre Produit</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
 				  @foreach($commandes as $commande)
          <tr>
            <td>{{$commande->num_com}}</td>
            <td>{{$commande->numfour}}</td>
            <td>{{$commande->nbre_prod}}</td>
            <td>{{$commande->prix_ht}}</td>
            <td>{{$commande->prix_ttc}}</td>
            <td align="center"> 
                <a href="" title="Afficher le bon de commande">
                    <i class="fa fa-eye"></i>   
                </a>&nbsp;&nbsp;|&nbsp;&nbsp;
            </td>
          </tr>
 					@endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Numero</th>
            <th>Fournisseur</th>
            <th>Nombre Produit</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- End .powerwidget --> 
  </div>
</div>
@endsection

			
