@extends('saas-1.index')
@section('contenu')
<div class="row">
	{{-- <div class="col-md-12">
		<a href="/app/client" title="retour a la page precedente"  style="float:right;" 
		class="btn btn-danger btn-icon mb-2 me-1 btn-rounded">
            <i data-feather="arrow-left"></i>
		</a>
	</div> --}}

	<div class="layout-px-spacing">

		<div class="middle-content container-xxl p-0">

			<div class="row layout-top-spacing">

				<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing ">
					<div style="height: 200px" class="widget widget-six">
						
						<div style=" font-size: 1.9em;">{{$project->name}}</div>
						<div class="w-info">
							<p class="value">{{$project->client->nom}} {{$project->client->prenom}}</p>
						</div>
					</div>
					
				</div>
				
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
					<div style="height: 200px" class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-header">
								<div class="w-info">
									<h6 class="value">Budget</h6>
								</div>
							</div>
							
						</div>
						<div class="w-content">
							<div style="height: 200px" class="w-info">
								<p class="value">CFA  {{$project->budget}} <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></p>
							</div>
						</div>
					</div>
				</div>  

				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
					<div class="widget widget-card-three " style="height: 200px">
						<div class="widget-content  d-flex">
							<div class="account-box">
								<div class="">
									<div class="">
										<h5 class="">Delaie</h5>
									</div>
								</div>
								<div class="">
									<p class=""> Debut : {{$project->start_date}}</p><br>
									<p class=""> Livraison : {{$project->end_date}}</p><br>

								</div>
							</div>
							
						</div>
					</div>
				</div>

				<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
					<div class="widget widget-chart-three" >
						<div class="widget-heading">
							<div class="">
								<h5 class="">DESCRIPTION DU PROJET</h5>
							</div>
						</div>

						<div class="widget-content" style="min-height: 400px">
							
								<p class="p-3">{{$project->description}}</p>
							
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
					<div class="widget widget-activity-five">

						<div class="widget-heading">
							<h5 class="">Liste des participants</h5>
						</div>

						<div class="widget-content">

							<div class="w-shadow-top"></div>

							<div class="mt-container mx-auto">
								<div class="timeline-line">
														 

									@foreach($tasks as $task)
									@if($task->task_assignments)
										@foreach($task->task_assignments as $task_assignment)
											<div class="item-timeline timeline-new">
												<div class="t-dot">
													<div class="t-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>
												</div>
												<div class="t-content">
													<div class="t-uppercontent">
														<h5>{{ $task->name }} :  
															<a href="javscript:void(0);"><span>{{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}</span></a>
														</h5>
													</div>
													<div class="t-uppercontent"><h5 class="card-title mb-2" ><li style="color: {{($task->completed) ? 'green' : 'red'}}">{{($task->completed) ? 'Terminé' : 'Inachevé'}}</li></h5></div>
													<p>{{ $task->end_date }}</p>
												</div>
											</div>
										@endforeach
									@endif
									@endforeach                             
								</div>                                    
							</div>

							<div class="w-shadow-bottom"></div>
						</div>
						
						
					</div>
				</div>
			

			</div>
				
		</div>
		<div class="row">
			<div class="card">
				<div class="card-header">
					<h5>Liste des taches
						<a href="" title="Voir toutes les clients"
							style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary mb-2 me-2"><i
								data-feather="list"></i> Liste</a>
						<a href="" title="Ajouter un projet" style="text-align:right; float:right; margin-bottom:20px;"
							class="btn btn-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i
								data-feather="plus"></i>Tache</a>
	
					</h5>
					<p class="text-muted font-13 mb-4">
						Les informations affichées ci dessous sont les  différents taches du projet 
					</p>
				</div>
				<div class="row">
					<div class="col-md-12">
						@if (session()->has('message'))
							<div class="alert alert-icon alert-success">
								<em class="icon ni ni-alert-circle"></em>
								{{ session('message') }}
							</div>
						@endif
						@if ($errors->any())
							@foreach ($errors->all() as $error)
								<div class="alert alert-icon alert-danger">
									<em class="icon ni ni-alert-circle"></em>
									{{ $error }}
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
											<th class="text-center">Nom</th>
											<th class="text-center">Debut de la tache</th>
											<th class="text-center">Fin de tache</th>
											<th class="text-center">Etat</th>
											<th class="text-center">Attribué à</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($tasks as $task)
										<tr>
											<td class="text-center">{{ isset($task->name) ? $task->name : '' }}</td>
											<td class="text-center">{{ isset($task->start_date) ? $task->start_date : '' }}</td>
											<td class="text-center">{{ isset($task->end_date) ? $task->end_date : '' }}</td>
											<td class="text-center">{{ isset($task->completed) ? $task->completed : '' }}</td>
											<td class="text-center">
												@foreach ($task->task_assignments as $task_assignment)
													{{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}<br>
	
												@endforeach
											</td>
												<td align="center">
													<a href="{{ route('voirtache', $task->id) }}" title="Voir"
														style="float:left;" class="badge badge-light-primary text-start me-2 ">
														<i data-feather="eye"></i>
													</a>
													<a href="{{ route('task.edit', $task->id) }}" title="Editer"
														style="float:left;" class="badge badge-light-primary text-start me-2 ">
														<i data-feather="edit"></i>
													</a>
													<form id="destroy{{ $task->id }}"
														onSubmit="return confirm('Confirmez-vous votre suppression?')"
														action="{{ route('task.destroy', $task->id) }}" method="POST">
														@csrf
														@method('DELETE')
														<button class="badge badge-light-danger text-start action-delete"
															style="float:left;"><i data-feather="trash"></i></button>
														<button class="badge badge-light-danger text-start action-delete"
															style="float:left;" hidden><i data-feather="trash"></i></button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
									
								</table>
							</div>
						</div>
					</div>
				</div>
				
				
	
	
				<!-- Modal -->
				<script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>
	
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header bg-light">
								<h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout d'une tache</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body p-4">
								<div class="row">
									<div class="col-md-12 bg-primary-light">
										<form action="{{route('taskadd',$project->id)}}" method="post"
											enctype="multipart/form-data">
											@csrf
											<div class="row">
												<p class="panel-subtitle">
													Veuillez renseigner les champs ci-dessous.
												</p>
												<div class="col-md-6">
													<label for="validationCustom01" class="form-label">Nom de la tache </label>
													<input type="text" name="nom" class="form-control"
														id="validationCustom01" placeholder="Saisir l'intituler du projet"
														required>
													<div class="valid-feedback">Looks good!</div>
												</div>
										
											</div>
											<div class="row">
												
												
												<div class="col-md-4">
													<label for="validationCustom01" class="form-label">Charger de taches</label>
													<select type="text" name="user" class="form-control"
														id="validationCustom01" placeholder="Saisir la description du projet"
														required>
															@foreach($users as $user)                                                     
															<option value="{{$user->id}}">{{$user->name}} </option>
															@endforeach
													</select>
													<div class="valid-feedback">Looks good!</div>
												</div>
												<div class="col-md-4">
													<label for="validationCustom01" class="form-label">date de lancement</label>
													<input type="date" name="start_date" class="form-control"
														id="validationCustom01" 
														required>
													<div class="valid-feedback">Looks good!</div>
												</div>
												<div class="col-md-4">
													<label for="validationCustom01" class="form-label">date de fin</label>
													<input type="date" name="end_date" class="form-control"
														id="validationCustom01" 
														required>
													<div class="valid-feedback">Looks good!</div>
												</div>
												<div class="col-md-12">
                                           
													<label for="validationCustom01" class="form-label">DESCRIPTION DU PROJET</label>
												   
														<textarea name="description" id="demo1" cols="100%"  rows="6"></textarea>
													
													<div class="valid-feedback">Looks good!</div>
											   
												</div>
											<div class=" ">
												<button type="submit" class="btn btn-primary">Valider</button>
												<button type="reset" class="btn btn-default">Annuler</button>
											</div>
											
											
										</form>
									</div>
								</div>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div>
	</div>
	

</div>

@endsection
