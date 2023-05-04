@extends('BACK.index')
@section('contenu')    
<header class="page-header">
	<h2>Gestion des commandes</h2>
	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="/backoffice">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>commandes</span></li>
			<!--li><a href="/BACK/produit/"><span>Lister les Produits</span></a></li-->
			<li><a href="#"><span>Ajouter une commande</span></a></li>
		</ol>
		<a class="sidebar-right-toggle" data-open="sidebar-right">
			<i class="fa fa-chevron-left"></i>
		</a>
	</div>
</header>
<div class="row">
	<div class="col-md-12">             
    	<form action="/BACK/commande/create" class="form-horizontal" enctype="multipart/form-data" method="post">
			@csrf
 	    	<div id="post"></div>
        	<center>
        		<div class="row">
                	<section class="col col-10"><br/><br/>
                		<label>
							<h3 align="center">
								Cliquer sur le bouton ci-dessous pour effectuer un bon de commande
							</h3>
						</label><br/><br/>
        				<center>
             				<button type="submit" 
									class="btn btn-primary" 
									title="effectuer une commande">Lancer une commande
							</button>
                		</center>
              		</section>
            	</div>
        	</center><br/><br/><br/>
    	</form>
	</div>
</div>
@endsection