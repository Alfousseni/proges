
				@extends('BACK.index')
                @section('contenu')
         
					<header class="page-header">
						<h2>Gestion de la Comptabilite</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Comptabilite</span></li>
								<li><a href="/backoffice/facture/"><span>Liste des factures</span></a></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
      
 
 
					<div class="row">
						<div class="col-md-12">

                  

            
 							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
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
								<h2 class="panel-title">Liste des factures</h2>
							</header>
							<div class="panel-body">
 								<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
                                  <thead>
                    <tr>
                    <th>Numero</th>
                      <th>N° Client</th>
                      <th>Nom Produit</th>
                      <th>TVA</th>
                      <th>PRIX HT</th>
                      <th>PRIX TTC</th>
                      <th>Statut</th>
                      <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach ($factures as $facture)
                  
 
                    <tr>
                      @php
                      $payer="";
                      if ($facture -> encaisser == $facture -> prix_ttc){
                        echo $payer = 'Payé';
                      }
                      elseif ($facture -> encaisser > $facture -> prix_ttc){
                        echo $payer = 'Payé';
                      }
                      elseif ($facture -> encaisser < $facture -> prix_ttc){
                        echo $payer = 'Impayé';
                      }
                      @endphp
                    <td>{{ $facture-> numfac}}</td>

                    <td>{{ $facture-> num_client}}</td>
                    <td>{{ $facture-> nbre_prod}}</td>
                    <td>{{ $facture-> mnt_tva}}</td>
                    <td>{{ $facture-> prix_ht}}</td>
                    <td>{{ $facture-> prix_ttc}}</td>
                    <td align="center" style="color:red;">{{ $payer}}</td>
                      <td align="center"> 
                 <a href="{{route('facture.show', $facture ->id)}}">
                 <i class="fa fa-eye"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                
                 
                      </td>
                    </tr>
 					
                    @endforeach 
                   </tbody>
                  <tfoot>
                    <tr>
                    <th>Numero</th>
                      <th>N° Client</th>
                      <th>Nom Produit</th>
                      <th>TVA</th>
                      <th>PRIX HT</th>
                      <th>PRIX TTC</th>
                      <th>Statut</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
   			        <script>
                    function confirmer() {
                    if(confirm("Confirmez-vous la suppression?")) return true;
                    else return false;
                    }
                    </script>
			

@endsection