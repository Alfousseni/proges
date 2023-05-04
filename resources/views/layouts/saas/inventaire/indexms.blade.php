<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
  </head>
	<body>
		<h2  style="border:solid; text-align:center;">INVENTAIRES DU STOCK</h2>	
		<br><br>
		<div style="font-size:18px; font-family:Times,B ;">Magasin:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{{$magasin->nom_mag}}
				</div>
 		<table class="table table-bordered"> 
      		<thead>
        		<tr >
				<th>N°</th>
          			<th>Référence</th>
					  <th>Nom Produit</th>
					  <th>Quantité</th>
          			
          			<th></th>
        		</tr>
      		</thead>
      		<tbody>
			  @foreach($inventaires as $inventaire)
        		<tr>
          			<td>{{$inventaire->id}}</td>
         	 		<td>{{$inventaire->reference}}</td>
					  
					@foreach($produits as $produit)
					  <td>{{$produit->nom_prod}}</td>
          			@endforeach
					<td>{{$inventaire->qte_stock}}</td> 
        		</tr>
        	@endforeach
      		</tbody>
    	</table>
  	</body>
</html>			
