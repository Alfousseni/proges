@extends('saas.index')
@section('content')
					<header class="page-header">
						<h2>Gestion des clients</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Client</span></li>
								<li><a href="index.php?jen=client&c=Lister-client"><span>Lister les Clients</span></a></li>
            					<li><span>Fiche d'un client</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
      
 
 
					<div class="row">
						<div class="col-md-12">
 
<iframe width="100%" src="{{route('client.show',$client->id)}}" height="800" frameborder="1"></iframe> 

						</div>
						</div>
@endsection
