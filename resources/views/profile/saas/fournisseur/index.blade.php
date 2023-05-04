

				@extends('BACK.index')

                @section('contenu')

         

					<header class="page-header">

						<h2>Gestion des Fournisseurs</h2>

					

						<div class="right-wrapper pull-right">

							<ol class="breadcrumbs">

								<li>

									<a href="index.php">

										<i class="fa fa-home"></i>

									</a>

								</li>

								<li><span>Fournisseur</span></li>

								<li><a href="/BACK/fournisseur/create"><span>Ajouter un Fournisseur</span></a></li>

							</ol>

					

							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>

						</div>

					</header>

      

 

 

					<div class="row">

						<div class="col-md-12">



                  



            

 							<header class="panel-heading">

								<div class="panel-actions">

									<a href="#" class="fa fa-caret-down"></a>

									<a href="#" class="fa fa-times"></a>

								</div>

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
            <h2 class="text-black">
              <a href="{{route('devis')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Demander un devis</span>
						</a>
						<a href="{{route('fournisseur.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary">
							<em class="icon ni ni-plus"></em>
							<span>Ajouter un fournisseur</span>
						</a>
					</h2>

								<h2 class="panel-title">Liste des fournisseurs</h2>

							</header>

							<div class="panel-body">

 								<table class="table table-bordered table-striped mb-none" id="datatable-default"> 

                                  <thead>

                    <tr>

                    <th>Numero</th>

                      <th>Nom</th>

                      <th>Prenom</th>

                      <th>Email</th>

                      <th>Tel</th>

                      <th>Action</th>

                     </tr>

                  </thead>

                  <tbody>

                  @foreach ($fournisseurs as $fournisseur)

                  

 

                    <tr>

                    <td>{{ $fournisseur-> numero}}</td>



                                                <td>{{ $fournisseur-> nom}}</td>

                                                <td>{{ $fournisseur-> prenom}}</td>

                                                <td>{{ $fournisseur-> email}}</td>

                                                <td>{{ $fournisseur-> tel}}</td>

                      <td align="center"> 

                 <a href="{{route('voirfrs', $fournisseur -> id)}}">

                 <i class="fa fa-eye"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;

                 <a href="{{route('fournisseur.edit', $fournisseur -> id)}}">

                 <i class="fa fa-edit"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;

                 <form id="destroy{{ $fournisseur-> id}}" action="{{route('fournisseur.destroy', $fournisseur -> id)}}" method="Post">

                 @csrf

                                                            @method('DELETE')

                 <a href="" onclick="event.preventDefault();this.closest('form').submit();" >

                 <i class="fa fa-trash-o"></i></a> </form>

                      </td>

                    </tr>

 					

                    @endforeach 

                   </tbody>

                  <tfoot>

                    <tr>

                    <th>Numero</th>

                    <th>Nom</th>

                      <th>Prenom</th>

                      <th>Email</th>

                      <th>Tel</th>

                      <th>Action</th>

                    </tr>

                  </tfoot>

                </table>

              </div>

   			        <script>

                    function confirmer() {

                    if(confirm("Confirmez-vous la suppression?")) return true;

                    else return false;

                    }

                    </script>

			



@endsection