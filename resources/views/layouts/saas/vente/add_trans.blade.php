@extends('saas.index')
@section('contenu')   
<div class="container">
    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
				<form action="/BACK/vente/create" class="form-horizontal" enctype="multipart/form-data" method="post">
					@csrf
                    <div class="row mb-4">
                        <div class="col-sm-12">
							<label>
								<br><br>
								<h3 align="center">
									Cliquer sur le bouton ci-dessous pour effectuer une nouvelle transaction de vente

								</h3>

							</label><br/><br/>
							<center>
                            	<button type="submit" class="btn btn-primary">Lancer une vente</button>
							</center>
						</div>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
