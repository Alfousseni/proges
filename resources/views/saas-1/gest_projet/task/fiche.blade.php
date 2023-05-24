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
						<div class="w-info">
                            <h6 class="value">Tache</h6>
                        </div>
						<div style=" font-size: 1.9em;">{{isset($task) ? $task->name : ""}}</div>

					</div>
					
				</div>
				
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
					<div style="height: 200px" class="widget widget-card-four">
						<div class="widget-content">
							<div class="w-header">
								<div class="w-info">
									<h6 class="value">Etat</h6>
								</div>
							</div>
							
						</div>
						<div class="w-content">
							<div style="height: 200px" class="w-info">
								<h2><p class=""><li style="color: {{($task->completed) ? 'green' : 'red'}}">{{($task->completed) ? 'Terminé' : 'Inachevé'}}</li></p></h2>
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
									<p class=""> Debut : {{$task->start_date}} </p><br>
									<p class=""> Livraison : {{$task->end_date}} </p><br>

								</div>
							</div>
							
						</div>
					</div>
				</div>
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

				<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
					<div class="widget widget-chart-three" >
						<div class="widget-heading">
							<div class="">
								<h5 class="">DESCRIPTION DE LA TACHE</h5>
							</div>
						</div>

						<div class="widget-content" style="min-height: 400px">
							
								<p class="p-3">{{$task->description}}</p>
							
						</div>
					</div>
				</div>

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
					<div class="widget widget-activity-five">
                        <h4><b>Charges de tache</b></h4>
						<div class="widget-heading">
                            <a href="" title="ajouter un charger de taches"
                                 style="float:left;" class="badge badge-light-primary text-start me-2 add"
                                data-bs-toggle="modal" data-bs-target="#loginModal" id="lo" > Ajouter 
                                <i data-feather="user"></i>
                            </a>
                            <a href="" title="ajouter un charger de taches"
                                 style="float:left;" class="badge badge-light-primary text-start me-2 sup"
                                data-bs-toggle="modal" data-bs-target="#standardModal" id="sup" > Retirer 
                                <i data-feather="user"></i>
                            </a>
						</div>
						<div class="widget-content">
							<div class=""></div>
							<div class="mt-container mx-auto">
                                
								<div class="timeline-line">
														 

                                    @foreach ($task->task_assignments as $task_assignment)
                                    <div class="item-timeline timeline-new">
												<div class="t-dot">
													<div class="t-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></div>
												</div>
												<div class="t-content">
													<div class="t-uppercontent">
														<h5>{{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}  
														</h5>
													</div>
													
                                               </div>
												
									</div>
										@endforeach
									
									                            
								</div>                                    
							</div>

							<div class="w-shadow-bottom">
                                
                            </div>
						</div>
						
						
					</div>
				</div>
			

			</div>
				
		</div>
{{-- @foreach ($task->task_assignments as $task_assignment) --}}
@foreach ($comments as $comment)

<div id="toggleAccordion" class="no-icons accordion">
    <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#defaultAccordionOne" aria-expanded="true" aria-controls="accordionun par défaut">
					 Cliquer ici pour voir le Commentaire de  
					 {{-- {{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}<br> --}}
					 {{ isset($comment) && isset($comment->user->name) ? $comment->user->name : '' }} le <p>{{ $comment->created_at }}</p><br>
                </div>
            </section>
        </div>
        <div id="defaultAccordionOne" class="collapse" aria-labelledby="..." data-bs-parent="#toggleAccordion">
            <div class="card-body">
					 {{ isset($comment) && isset($comment->contenu) ? $comment->contenu : '' }}<br>
                     
            </div>
        </div>
    </div>
	
</div>
@endforeach

@foreach ($task_dels as $task_del)

<div id="toggleAccordion" class="no-icons accordion">
    <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#defaultAccordionOne" aria-expanded="true" aria-controls="accordionun par défaut">
					 Cliquer ici pour voir la raison pour lesquel   
					 {{-- {{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}<br> --}}
					 {{ isset($task_del) && isset($task_del->user->name) ? $task_del->user->name : '' }} a été retirer de cette tache le <p>{{ $task_del->created_at }}</p><br>
                </div>
            </section>
        </div>
        <div id="defaultAccordionOne" class="collapse" aria-labelledby="..." data-bs-parent="#toggleAccordion">
            <div class="card-body">
					 {{ isset($task_del) && isset($task_del->raison) ? $task_del->raison : '' }}<br>
                     
            </div>
        </div>
    </div>
	
</div>
@endforeach

<div class="modal fade login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header" id="loginModalLabel">
          <h4 class="modal-title">Ajout</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
          <form class="mt-0" method="post" action="{{route('assignmentadd',$task->id)}}">
            @csrf
            <div class="form-group">
                <select type="text" name="user" class="form-control"
                id="validationCustom01" placeholder="Saisir la description du projet"
                required>
                    @foreach($users as $user)                                                     
                    <option value="{{$user->id}}">{{$user->name}} </option>
                    @endforeach
            </select>
            <input type="hidden" name="task" value="{{$task->id}}">

            </div>
            
            <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Ajouter</button>
          </form>
        </div>
        <div class="modal-footer justify-content-center">
          <div class="forgot login-footer">
              <span>Selectionner celui que vous souhaiter ajouter </span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade modal-notification" id="standardModal" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header" id="loginModalLabel">
          <h4 class="modal-title">Retirer</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
        </div>
        <div class="modal-body">
          <form class="mt-0" method="post" action="{{route('assignmentdeladd',$task->id)}}">
            @csrf
            <div class="form-group">
                <select type="text" name="user" class="form-control"
                id="validationCustom01" placeholder="S"
                required>
                @foreach ($task->task_assignments as $task_assignment)
                <option value="{{$task_assignment->user->id}}">{{ isset($task_assignment->user) && isset($task_assignment->user->name) ? $task_assignment->user->name : '' }}  </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                                           
                    <label for="validationCustom01" class="form-label">Motif du retrait</label>
                   
                        <textarea name="raison" id="demo1" cols="100%"  rows="6" ></textarea>
                    
                    <div class="valid-feedback">Looks good!</div>
               
                </div>

            </div>
            
            <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">Retirer</button>
          </form>
        </div>
        <div class="modal-footer justify-content-center">
          <div class="forgot login-footer">
              <span>Selectionner celui que vous souhaiter retirer </span>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <!-- Votre code JavaScript -->
  <script>
    $(document).ready(function(){

$(document).on('click', '.add', function(){

 $('#loginModal').modal('show');//load modal



});

$(document).on('click', '.sup', function(){


$('#standardModal').modal('show');//load modal


});

});
</script>



@endsection
