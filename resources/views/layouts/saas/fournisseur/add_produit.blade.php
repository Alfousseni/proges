<?php
use App\Models\Stock;
?>
<div class="row">
  <div class="col-md-12">
    <h3 class="header-title">Liste des Produits</h3>
  </div>
</div>   
<div class="row">
  <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="statbox widget box box-shadow">
      <div class="widget-content widget-content-area">
        <table class="multi-table table table-striped dt-table-hover table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center dt-no-sorting">reference</th>
                    <th class="text-center dt-no-sorting">Nom produit</th>
                    <th class="text-center dt-no-sorting">Qte dispo</th>
                    <th class="text-center dt-no-sorting">Action</th>
                </tr>
            </thead>
            <tbody>
 			    @foreach($produits as $produit)
                <tr>
                    <form action="/ajout-produit" class="orb-form"  method="post" enctype="multipart/form-data" >	
                        @csrf
                        @foreach($transs as $trans)
                            <input type="hidden" name="numcom" value="{{$trans->numcmd}}">
                        @endforeach
                        <td class="text-center dt-no-sorting"><input type="hidden" name="refprod" value="{{$produit->numero}}">{{$produit->numero}}</td>
                        <td class="text-center dt-no-sorting"><input type="hidden" name="nomprod" value="{{$produit->nom_prod}}">{{$produit->nom_prod}}</td>
                        @foreach($stocks=Stock::all()->where('reference',$produit->numero) as $stock)
                            <td class="text-center dt-no-sorting">{{$stock->qte_stock}}</td>
                        @endforeach
                        <td class="text-center dt-no-sorting">  
                            <button type="submit"  class="btn btn-default">
                                <i class="feather feather-card"></i>
                            </button>
                        </td>
                    </form>
                </tr>        
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>