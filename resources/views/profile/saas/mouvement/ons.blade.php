@extends('BACK.index')
@section('contenu')
	<header class="page-header">
		<h2>Gestion des Stocks</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="/backoffice">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Mouvement</span></li>
				<li><a href="/backoffice/mouvement/create"><span>Lister les Mouvements</span></a></li>
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
		
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>
						<h2 class="panel-title">Fiche des mouvements</h2>
						<p class="panel-subtitle">
							Veuillez renseigner les champs ci-dessous.
						</p>
					</header>          
					<div class="panel-body">
                    	<div class="form-group">
							<label class="col-sm-3 control-label">Choix du prestataire</label>
							<div class="col-sm-6">
							@foreach($users as $user)
						<form action="{{route('mouvement.show', $user->id)}}" id="mvs-form" class="form-horizontal" encusers="multipart/form-data">
							@csrf
								
								<select id="company"  class="form-control" required>
									
									<option value="{{$user->id}}">{{$user->name}}</option>
									
								</select>
								<label class="error" for="company"></label>
							</div>
                            <button class="col-sm3 btn btn-primary">Valider</button>
						</div> 
						</form>
						@endforeach   
						<iframe width="100%" src="#" height="800" frameborder="1"></iframe>  
						</div>
				</section> 
					
						 
						 
 					
			
    	</div>
    </div>
@endsection
					