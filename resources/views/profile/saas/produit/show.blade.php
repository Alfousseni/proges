
<div class="row">
	<div class="col-md-12">
		<h2 class="panel-title" style="border:solid; text-align:center; font-size:20px;font-family:Times,B ;">
				FICHE DU PRODUIT N°{{$produit->numero}} 
		</h2>
		<div class="panel-body">
			<div class="row">
				<div style="font-size:18px; font-family:Times,B ;">Numéro Produit:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$produit->numero}}
				</div>
			</div>
			
			<div class="row">
				<div style="font-size:18px; font-family:Times,B ;">Nom Produit:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$produit->nom_prod}}
				</div>
			</div>
			
			<div class="row">
				<div style="font-size:18px; font-family:Times,B ;">Type Produit:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$produit->type_prod}}
				</div>
			</div>
			
			<div class="row">
				<div style="font-size:18px; font-family:Times,B ;">Quantité minimale:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				{{$produit->qte}} unités</div>
			</div>
			
			<div class="row">
				<div style="font-size:18px; font-family:Times,B ;">Caractéristiques:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				{{$produit->infos}}</div>
			</div>
									
        </div> 
    </div>   
</div>  