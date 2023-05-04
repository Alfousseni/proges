@extends('BACK.index')
@section('contenu')

<header class="page-header">
						<h2>Gestion des fournisseurs</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Fournisseur</span></li>
								<li><a href="index.php?jen=client&c=Ajouter-client"><span>Ajouter un Fournisseur</span></a></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
      
 
 
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
                                    <form action="{{route('fournisseur.update', $fournisseur->id)}}" method="post" enctype="multipart/form-data">
                                    	@csrf
                                       @method('put')
                                        <input type="hidden" name="id" value="{{$fournisseur->id}}">
                                        								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Formulaire modification de client</h2>
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
										value="{{$fournisseur->numero}}" 
										disabled
								/>
								<input type="hidden" 
										name="numero" 
										class="form-control"
										value="{{$fournisseur->numero}}" 
								/>
							</div>
						</div>
						<div class="col-sm-9"></div>
					</div>
                                    		<div class="form-group">
							<label class="col-sm-3 control-label">Prénom <span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
			<input type="text" name="prenom" class="form-control" placeholder="Entrer votre prénom" required/ value="{{$fournisseur->prenom}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                        
                                    		<div class="form-group">
							<label class="col-sm-3 control-label">Nom <span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
			<input type="text" name="nom" class="form-control" placeholder="Entrer un nom" required/ value="{{$fournisseur->nom}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                        
                          					 <div class="form-group">
								<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
						<input type="email" name="email" class="form-control" placeholder="eg.: email@email.com" / value="{{$fournisseur->email}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>

                                        
                          					 <div class="form-group">
								<label class="col-sm-3 control-label">Téléphone <span class="required">*</span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
						<input type="tel" name="tel" class="form-control" placeholder="Entrer le numéro de téléphone" required/ value="{{$fournisseur->telephone}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                         
                            				 <div class="form-group">
								<label class="col-sm-3 control-label">Nom de l'entreprise <span class="required"></span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-institution"></i>
													</span>
							<input type="text" name="company" class="form-control" placeholder="Entrer le nom de l'entreprise" / value="{{$fournisseur->nom_entreprise}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                        
                            				 <div class="form-group">
							<label class="col-sm-3 control-label">Site Web <span class="required"></span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
							<input type="text" name="site" class="form-control" placeholder="Entrer le site web" / value="{{$fournisseur->site}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                      
                             <div class="form-group">
											<label class="col-sm-3 control-label">Pays</label>
											<div class="col-sm-9">
												<select id="company" name="pays" class="form-control" required value="{{$fournisseur->pays}}">
    					                        <option value="Sénégal">Sénégal</option>
                                                <option value="Sénégal">Afganhistan</option>
                                                <option value="Sénégal">Australie</option>
                                                <option value="Sénégal">Autriche</option>
                                                <option value="Sénégal">Belgique</option>
                                      
												</select>
												<label class="error" for="company"></label>
											</div>
										</div>       
                            				 <div class="form-group">
							<label class="col-sm-3 control-label">Ville <span class="required"></span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
							<input type="text" name="ville" class="form-control" placeholder="Entrer la ville" / value="{{$fournisseur->ville}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
                                      
                            				 <div class="form-group">
							<label class="col-sm-3 control-label">Code Postal <span class="required"></span></label>
											<div class="col-sm-9">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
							<input type="text" name="code" class="form-control" placeholder="Entrer le code postal" / value="{{$fournisseur->code}}">
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>

                                   <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Adresse</label>
												<div class="col-md-6">
													<textarea class="form-control" name="adresse" rows="3" id="textareaDefault">{{$fournisseur->adresse}}</textarea>
												</div>
											</div>   
                                        
                                   <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Informations additionnelles</label>
												<div class="col-md-6">
													<textarea class="form-control" name="info" rows="3" id="textareaDefault" >{{$fournisseur->info}}</textarea>
												</div>
											</div>   
                                        
                                      
                      						</div>

 									 
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
												<button class="btn btn-primary">Envoyer</button>
												<button type="reset" class="btn btn-default">Annuler</button>
											</div>
										</div>
									</footer>

 								</section>
							</form> 
  
						</div>
 					</div> 

                     @endsection