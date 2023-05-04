@extends('saas.index')

@section('contenu')

	
<div class="row">
	<div class="col-md-12">
		<iframe width="100%" src="{{route('Inventaire-magasin', $magasin->id)}}" height="800" frameborder="1"></iframe>  
</div>
</div>
						

			

@endsection

					