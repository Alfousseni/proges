@extends('saas-1.index')
@section('contenu')
<div class="row">
	<div class="col-md-12">
		<a href="/app/client" title="retour a la page precedente"  style="float:right;" 
		class="btn btn-danger btn-icon mb-2 me-1 btn-rounded">
            <i data-feather="arrow-left"></i>
		</a>
 		<iframe width="100%" src="{{route('project.show',$project->id)}}" height="800" frameborder="1"></iframe> 
	</div>
</div>
@endsection
