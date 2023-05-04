<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title></title>
  </head>
	<body>
		<h2  style="border:solid; text-align:center;">Liste des retraits</h2>	
		<br><br>
 		<table class="table table-bordered"> 
      		<thead>
        		<tr >
				<th>N°</th> 
                      <th>Date retrait</th>
                      <th>Nom Bénéficiaire</th>
                      <th>Montant retiré</th>
        		</tr>
      		</thead>
      		<tbody>
 			@foreach($retraits as $retrait)
        		<tr>
				<td >{{ $retrait->id}}</td> 
					<td >{{ $retrait->created_at}}</td>
                    <td>{{ $retrait->nom_ret}}</td>
					<td >{{ $retrait->montant_ret}}</td>
        		</tr>
        	@endforeach
      		</tbody>
    	</table>
  	</body>
</html>			
