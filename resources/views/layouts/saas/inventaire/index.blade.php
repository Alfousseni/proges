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
					<td>{{$inventaire->nomprod}}</td>
					<td>{{$inventaire->qte_stock}}</td> 
        		</tr>
        	@endforeach
      		</tbody>
    	</table>
  	</body>
</html>			
