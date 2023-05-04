<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
  </head>
	<body>
		<h2  style="border:solid; text-align:center;">LISTE DES DEPOTS</h2>	
		<br><br>
 		<table class="table table-bordered"> 
      		<thead>
        		<tr >
          			<th>N°</th>
          			<th>Date Depot</th>
          			<th>Nom Depositaire</th>
          			<th>Montant Deposé</th>
        		</tr>
      		</thead>
      		<tbody>
 			@foreach($depots as $depot)
        		<tr>
          			<td>{{$depot->id}}</td>
         	 		<td>{{$depot->created_at}}</td>
          			<td>{{$depot->nom_prop}}</td>
          			<td>{{$depot->montant}}</td> 
        		</tr>
        	@endforeach
      		</tbody>
    	</table>
  	</body>
</html>			
