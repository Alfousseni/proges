<div class="row">
	<div class="col-md-12">
        <header class="panel-heading">
			<div class="panel-actions">
				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="panel-title">Liste des produits</h2>
		</header>
		<div class="panel-body">
 			<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Nom produit</th>
                        <th>Qte min</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($produits as $produit) 
                    <tr>
 				        <form action="/ajoutproduit" class="orb-form"  method="post" enctype="multipart/form-data" >	
                            @csrf
                            @foreach($transs as $trans)
                            <input type="hidden" name="numcom" value="{{$trans->numcmd}}">
                            @endforeach
                            <td><input type="hidden" name="refprod" value="{{$produit->numero}}">{{$produit->numero}}</td>
                            <td><input type="hidden" name="nomprod" value="{{$produit->nom_prod}}">{{$produit->nom_prod}}</td>
                            <td>{{$produit->qte}}</td>
                            <td align="center">  &nbsp;&nbsp;|&nbsp;&nbsp;
                                <button type="submit"  class="btn btn-default">
                                    <i class="fa fa-plus"></i>
                                </button>&nbsp;&nbsp;|&nbsp;&nbsp;
                            </td>
 					        <div id="post"></div>
                        </form>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Numero</th>
                        <th>Nom produit</th>
                        <th>Qte min</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>