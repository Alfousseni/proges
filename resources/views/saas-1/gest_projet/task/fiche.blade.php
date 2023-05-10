@extends('saas-1.index')
@section('contenu')

<div class="card style-5 bg-primary mb-md-0 mb-4 w-50 ">
    <div class="card-top-content">
        <div class="avatar avatar-md">
			<i class="fas fa-user rounded-circle"></i>
		</div>		
    </div>
    <div class="card-content">
        <div class="card-body">
            {{-- <h5 class="card-title mb-2">{{$task->name}}  {{($task->completed) ? 'Terminer' : 'Inachever'}}</h5> --}}
			<h5 class="card-title mb-2" >{{$task->name}}  <li style="color: {{($task->completed) ? 'green' : 'red'}}">{{($task->completed) ? 'Terminé' : 'Inachevé'}}</li></h5>
        </div>
    </div>
</div>
<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing mx-auto">
    <div class="widget widget-chart-three">
        <div class="widget-heading">
            <div class="">
                <h5 class="">DESCRIPTION DU PROJET</h5>
            </div>
        </div>

        <div class="widget-content">
            
                <p class="p-3">{{$task->description}}</p>
            
        </div>
    </div>
</div
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


{{-- <div class="table-responsive col-xl-6">
    18 May	784	In Progress

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th class="text-center" scope="col">Sales</th>
                <th class="text-center" scope="col">Status</th>
            </tr>
            <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
        </thead>
        <tbody>
            <tr>
                <td>Shaun Park</td>
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span class="table-inner-text">25 Apr</span>
                </td>
                <td class="text-center">320</td>
                <td class="text-center">
                    <span class="badge badge-light-success">Approved</span>
                </td>
            </tr>
            <tr>
                <td>Alma Clarke</td>
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span class="table-inner-text">26 Apr</span>
                </td>
                <td class="text-center">110</td>
                <td class="text-center">
                    <span class="badge badge-light-secondary">Pending</span>
                </td>
            </tr>
            <tr>
                <td>Vincent Carpenter</td>
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span class="table-inner-text">05 May</span>
                </td>
                <td class="text-center">210</td>
                <td class="text-center">
                    <span class="badge badge-light-danger">Rejected</span>
                </td>
            </tr>
            <tr>
                <td>Xavier</td>
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span class="table-inner-text">18 May</span>
                </td>
                <td class="text-center">784</td>
                <td class="text-center">
                    <span class="badge badge-light-info">In Progress</span>
                </td>
            </tr>
        </tbody>
    </table>
</div> --}}

@endsection
