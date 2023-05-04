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
			<li><a href="/BACK/retrait/create"><span>Retrait de fond</span></a></li>
			<li><span>Liste des retraits</span></li>
 		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
	</div>
</header>
<div class="row">
	<div class="col-md-12"> 
		<iframe width="100%" src="/Liste-des-retraits" height="800" frameborder="1"></iframe>  
	</div>
</div>
@endsection

 