@extends('BACK.index')
@section('contenu')
	<header class="page-header">
		<h2>Gestion des Stocks</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="/backoffice">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Inventaire</span></li>
				<li><a href="/backoffice/inventaire/create"><span>Lister les inventaires</span></a></li>
			</ol>
			<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
		</div>
	</header>
    
					          
					   
						<iframe width="100%" src="{{route('inves', $magasin->id)}}" height="800" frameborder="1"></iframe>  
						
			
					
						 
						 
 					
			
    
@endsection
					