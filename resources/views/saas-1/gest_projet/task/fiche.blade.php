@extends('saas-1.index')
@section('contenu')

<div class="card style-5 bg-primary mb-md-0 mb-4">
    <div class="card-top-content">
        <div class="avatar avatar-md">
			<i class="fas fa-user rounded-circle"></i>
		</div>		
    </div>
    <div class="card-content">
        <div class="card-body">
            {{-- <h5 class="card-title mb-2">{{$task->name}}  {{($task->completed) ? 'Terminer' : 'Inachever'}}</h5> --}}
			<h5 class="card-title mb-2" >{{$task->name}}  <li style="color: {{($task->completed) ? 'green' : 'red'}}">{{($task->completed) ? 'Terminé' : 'Inachevé'}}</li></h5>

            <p class="card-text">{{$task->description}}</p>
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
					 {{ isset($comment) && isset($comment->user->name) ? $comment->user->name : '' }}<br>

					 

                </div>
            </section>
        </div>
        <div id="defaultAccordionOne" class="collapse" aria-labelledby="..." data-bs-parent="#toggleAccordion">
            <div class="card-body">
					 {{ isset($comment) && isset($comment->contenu) ? $comment->contenu : '' }}<br>
            </div>
        </div>
    </div>
	@endforeach


    {{-- <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="" data-bs-toggle="collapse" data-bs-target="#defaultAccordionTwo" aria-expanded="false" aria-controls="defaultAccordionTwo">
                    Élément de groupe pliable #2
                </div>
            </section>
        </div>
        <div id="defaultAccordionTwo" class="collapse show" aria-labelledby="..." data-bs-parent="#toggleAccordion">
            <div class="card-body">
                .......................
                .......................
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#defaultAccordionThree" aria-expanded="false" aria-controls="defaultAccordionThree">
                    Élément de groupe pliable #3
                </div>
            </section>
        </div>
        <div id="defaultAccordionThree" class="collapse" aria-labelledby="..." data-bs-parent="#toggleAccordion">
            <div class="card-body">
                .......................
                .......................
            </div>
        </div>
    </div>
</div> --}}

@endsection
