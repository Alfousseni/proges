<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
  @foreach($Societ as $soc)
  <h2>{{$soc->nom_societe}}</h2>
  <p>Email: {{$soc->email}}</p>
  <p>Tel: {{$soc->tel}}</p>
  <p>Adresse: {{$soc->adresse}}</p>
   <br>
  
  <h2 style="text-center">DEMANDE DE DEVIS</h2>
   <br>
   <p>{{$d->info}}</p>
   <br>
    <table width="100%" border="1" background-color="green">
      <thead>
        <tr>
          <th style="text-center">produit</th> 
          <th style="text-center">quantite</th>
        </tr> 
      </thead>
      <tbody>
        @foreach($devs as $dev)
        <tr>
          <td style="text-center">{{$dev->nomprod}}</td> 
          <td style="text-center">{{$dev->qte_prod}}</td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
    @endforeach
  </body>
</html>