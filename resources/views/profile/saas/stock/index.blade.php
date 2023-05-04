@extends('BACK.index')
@section('contenu')
<header class="page-header">
						<h2>Gestion des stocks</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Stock</span></li>
								<li><a href="index.php?jen=Stock&c=App-mag"><span>Approvisionner un magasin</span></a></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
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
    <h2 class="panel-title">Liste des dépots</h2>
  </header>
	<div class="panel-body">
 		<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
      <thead>
        <tr>
          <th>N°</th>
          <th>Nom produit</th>
          <th>Quantité disponible</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
 			@foreach($appros as $appro)
        <tr>
          <td>{{$appro->id}}</td>
          <td>{{$appro->nomprod}}</td>
          <td>{{$appro->qte_stock}}</td> 
          <td align="center"> 
                        &nbsp;&nbsp;|&nbsp;&nbsp;
              <a href="{{route('stock.edit', $appro -> id)}}" title="approvisionner un magasin">
                 <i class="fa fa-download"></i> </a>
                 		&nbsp;&nbsp;|&nbsp;&nbsp;
                       </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

			
