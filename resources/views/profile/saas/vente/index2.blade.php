@extends('BACK.index')
@section('contenu')
<header class="page-header">
	<h2>Gestion des Ventes</h2>
  <div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
						<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Ventes</span></li>
			<li><a href="#"><span>Liste des ventes livrées</span></a></li>
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
			<h2 class="panel-title">Liste des ventes</h2>
		</header>
		<div class="panel-body">
 			<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
        <thead>
          <tr>
            <th>Numero</th>
            <th>N° Client</th>
            <th>Nombre Produit</th>
            <th>Accompte</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
 				  @foreach($ventes as $vente)
          <tr>
          @php
                $payer="";
                if($vente->encaisser == $vente->prix_ttc){ 
                  echo $payer='Payé'; 
                }
				        elseif($vente->encaisser > $vente->prix_ttc){ 
                  echo $payer='Payé';  
                }
				 	      elseif($vente->encaisser < $vente->prix_ttc){ 
                  echo $payer='Impayé';
                }
          @endphp
            <td>{{$vente->num_com}}</td>
            <td>{{$vente->num_client}}</td>
            <td>{{$vente->nbre_prod}}</td>
            <td>{{$vente->encaisser}}</td>
            <td>{{$vente->prix_ht}}</td>
            <td>{{$vente->prix_ttc}}</td>
            <td align="center" style="color:red;">{{$payer}}</td>
            <td align="center"> 
                <a href="{{route('vente.show', $vente ->id)}}" title="Voir la facture">
                    <i class="fa fa-eye"></i>   
                </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                @if($payer== "Impayé") 
                    <a href="" title="Modifier la Vente">
                        <i class="fa fa-edit"></i> 
                    </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                
                @elseif($payer == "Payé")
                    <i class="fa fa-edit"></i> &nbsp;&nbsp;|&nbsp;&nbsp;
                @endif
            </td>
          </tr>
 					@endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Numero</th>
            <th>N°Client</th>
            <th>Nombre Produit</th>
            <th>Accompte</th>
            <th>Prix HT</th>
            <th>Prix TTC</th>
            <th>Statut</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- End .powerwidget --> 
  </div>
</div>
@endsection

			
