@extends('saas.index')

@section('contenu')

	
						<iframe width="100%" src="{{route('movesp', $user->id)}}" height="800" frameborder="1"></iframe>  

@endsection

					