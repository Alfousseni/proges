@extends('BACK.index')
@section('contenu')
      
<header class="page-header">
						<h2>Gestion des Inscriptions</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Inscription</span></li>
								<li><a href="/backoffice/societe/create"><span>Ajouter une société</span></a></li>
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
                                    <form action="{{route('societe.store')}}" method="post" enctype="multipart/form-data">
                                    	@csrf
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>

										<h2 class="panel-title">Formulaire d'ajout de société</h2>
										<p class="panel-subtitle">
											Veuillez renseigner les champs ci-dessous.
										</p>
									</header>
 
                  
                					

                   
							<div class="panel-body">
                                    		
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Nom de l'entreprise<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
								<input type="text" name="nom_societe" class="form-control" placeholder="Nom de l'entreprise" required/>
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
 
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Téléphone<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
								<input type="text" name="tel" class="form-control" placeholder="Téléphone" required/>
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
 
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Email<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
								<input type="email" name="email" class="form-control" placeholder="Email" required/>
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
										<div class="form-group">
							<label class="col-sm-3 control-label">Choisir vos modules<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
											@foreach($modules as $module)
                <input class="form-check-input" multiple="multiple" name="nom_mod[]" type="checkbox" value=" {{$module->nom_module}}" id="flexCheckDefault"> {{$module->nom_module}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            @endforeach
												</div>
											</div>
											<div class="col-sm-9">
											</div>
										</div>
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Site web</label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
								<input type="text" name="site_web" class="form-control" placeholder="Site web" />
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
 
 
                                            <div class="form-group">
							<label class="col-sm-3 control-label">Responsable<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
								<input type="text" name="responsable" class="form-control" placeholder="Responsable" />
												</div>
											</div>
											<div class="col-sm-9">

											</div>
										</div>
										<div class="form-group">
							<label class="col-sm-3 control-label">Nombre User<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-globe"></i>
													</span>
								<input type="number" name="nombre" class="form-control" placeholder="Nombre d'utilisateur souhaite" />
												</div>
											</div>
											
										</div>

                                  <div class="form-group">
												<label class="col-md-3 control-label" for="textareaDefault">Adresse<span class="required">*</span></label>
												<div class="col-md-6">
													<textarea class="form-control" name="adresse" rows="3" id="textareaDefault"></textarea>
												</div>
											</div>   
											<div class="form-group">
							<label class="col-sm-3 control-label"> Exonore<span class="required">*</span></label>
											<div class="col-sm-9">
                                            <div class="input-group">
													
											<select id="company" name="exo" class="form-control" required>
								                <option value="">-- Choisir  --</option>
                                             <option value="Oui">Oui</option>
                                             <option value="Non">Non</option>
						                        	</select>	
												</div>
											</div>
											
										</div>
								<div class="form-group">
												<label class="col-md-3 control-label">File Upload</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
											                   <input type="hidden" name="posted" value="1" />
																<input type="file" name="image" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
													</div>
												</div>
											</div>
                                    </div> 
										</div>
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-9 col-sm-offset-3">
												<button class="btn btn-primary">Submit</button>
												<button type="reset" class="btn btn-default">Reset</button>
											</div>
										</div>
									</footer>
                                    

								</section>
							</form> 
 @include('BACK/societe/list')

        </div>
        </div>



 @endsection