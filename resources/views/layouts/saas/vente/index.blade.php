@extends('saas.index')
@section('contenu')
<div class="row">
  <div class="col-md-12">
    <h4 class="header-title">Liste des ventes en cours</h4>
    <p class="text-muted font-13 mb-4">
      Les informations affichées ci dessous sont les enregistrements des différents ventes de votre structure.
    </p>
  </div>
</div>   
<div class="row">
  <div class="col-md-12">
    @if(session()->has('message'))
    <div class="alert alert-icon alert-success">
      <em class="icon ni ni-alert-circle"></em>
      {{session('message')}}
    </div>
    @endif
    @if($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-icon alert-danger">
          <em class="icon ni ni-alert-circle"></em>
          {{$error}}
        </div>
      @endforeach
    @endif     
  </div>
  <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="statbox widget box box-shadow">
      <div class="widget-content widget-content-area">
        <table class="multi-table table table-striped dt-table-hover table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Numero</th>
              <th>N°Client</th>
              <th>Nombre Produit</th>
              <th>Accompte</th>
              <th>Prix HT</th>
              <th>Prix TTC</th>
              <th>Statut</th>
              <th class="text-center dt-no-sorting">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ventes as $vente)
            <tr>
              @php
                $payer="";
                  if($vente->encaisser == $vente->prix_ttc){ 
                    $payer='Payé'; 
                  }
                  elseif($vente->encaisser > $vente->prix_ttc){ 
                    $payer='Payé';  
                  }
                  elseif($vente->encaisser < $vente->prix_ttc){ 
                    $payer='Impayé';
                  }
              @endphp
              <td>{{$vente->num_com}}</td>
              <td>{{$vente->num_client}}</td>
              <td>{{$vente->nbre_prod}}</td>
              <td>{{$vente->encaisser}}</td>
              <td>{{$vente->prix_ht}}</td>
              <td>{{$vente->prix_ttc}}</td>
              <td align="center" style="color:red;">{{$payer}}</td>
              <td class="text-center">
                <div class="dropdown">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1"> 
                    <a class="dropdown-item" href="">Afficher</a>
                    <a class="dropdown-item" href="{{ route('valider',$vente->num_com)}}">Valider</a>
                    <a class="dropdown-item" href="">Editer</a>
                    <form  action="{{route('supVente',$vente->num_com)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <a class="dropdown-item" href="" onclick="event.preventDefault();this.closest('form').submit();">Supprimer</a>
                    </form> 
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection




			

