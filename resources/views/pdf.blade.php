<div class="row">
	<div class="col-md-12">
<form action="{{route('produit.update', $produit->id)}}" class="form-horizontal"  method="POST">
		@csrf
		@method('put')	
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="panel-title">Formulaire de modification de produit</h2>
					<p class="panel-subtitle">
						Veuillez renseigner les champs ci-dessous.
					</p>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">ref
							<span class="required">*</span>
						</label>
						<div class="col-sm-3">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										class="form-control"
										value="{{$produit->numero}}" 
										disabled
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Nom Produit 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="nom" 
										class="form-control"
										value="{{$produit->nom_prod}}" 
                                        disabled
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                    <div class="form-group">
						<label class="col-sm-3 control-label">Quantité 
							<span class="required">*</span>
						</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="number" 
										name="qte" 
										class="form-control" 
										value="{{$produit->qte}}" 
                                        disabled

								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>            
                    <div class="form-group">
						<label class="col-sm-3 control-label">Type de produit</label>
						<div class="col-sm-9">
                            <div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" 
										name="typo" 
										class="form-control" 
										value="{{$produit->type_prod}}" 
                                        disabled
								/>
							</div>
						</div>
					</div>       
                    <div class="form-group">
						<label class="col-md-3 control-label" for="textareaDefault">Caractéristique du produit</label>
						<div class="col-md-6">
							<textarea class="form-control" 
										name="infos" rows="3" 
										id="textareaDefault" disabled>{{$produit->infos}}
							</textarea>
						</div>
					</div> 
                    <div>
                        <a href="{{ route('download.pdf',$produit->id)}}">Download PDF</a>
                    </div>  
                </div>         
                
            </section>
		</form> 
        </div> 
        </div>     