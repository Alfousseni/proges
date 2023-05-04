

@extends('saas.index')

@section('content')



 

 <div class="row">

            <div class="col-md-12">

              <h4 class="header-title">Liste des utilisateurs</h4>

              <h4 class="text-black">

						  <a href="{{route('user.create')}}" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">

							<em class="icon ni ni-plus"></em>

							<span>Ajouter un utilisateur</span>

						  </a>

					    </h4>

                <p class="text-muted font-13 mb-4">

                 Les informations affichées ci dessous sont les enregistrements des différents utilisateurs de votre structure.

                </p>

            </div>

          </div>   

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

                      </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">

                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">

                          

                <table class="multi-table table table-striped dt-table-hover table-bordered" style="width:100%">



                    <thead>

                    <tr>

                      <th>Nom User</th> 

                      <th>Email</th>

                      <th>Nom Société</th> 

                      <th>Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach ($users as $user)							

                      <tr> 

                        <!-- <td><input type="checkbox"></td> -->

                        <td align="left">{{ $user-> name}}</td>  

                        <td align="left">{{ $user-> email}}</td>

                        <td align="left">{{ $user->societe ? $user->societe->nom_societe:''}}</td> 

                        <td class="text-center">

                                                    <div class="dropdown">

                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>

                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">

                                                            <a class="dropdown-item" href="{{route('user.show', $user->id)}}">Afficher</a>

                                                            <a class="dropdown-item" href="{{route('user.edit', $user -> id)}}">Editer</a>

                                                            <form id="destroy{{ $user-> id}}" action="{{route('user.destroy', $user -> id)}}" method="POST">

                                                            @csrf

                                                            @method('DELETE')

                                                            <a class="dropdown-item" href="" onclick="event.preventDefault();this.closest('form').submit();">Supprimer</a>

                                                            </form> 

                                                        </div>

                                                    </div>

                        </td>               

                      </tr>

                      @endforeach 

                    </tbody>

                  </table>

                  </div></div></div>

<script>

  function confirmer() {

    if(confirm("Confirmez-vous la suppression?")) return true;

    else return false;

  }

</script>

			

  <!-- Modal ADD  -->



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

              <div class="modal-content">

                    <div class="modal-header bg-light">

                        <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'ajout d'utilisateur</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                        </button>

                    </div>

                    <div class="modal-body p-4">

                    <div class="row">

                                 

                                      <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">

                                      @csrf

                                  

        



      <div class="row">



    <div class="col-6">



        <div class="mb-3 position-relative">



            <label class="form-label small fw-bold">Nom de l'utilisateur <span class="text-danger">*</span></label>



            <input type="text" class="form-control" name="name" required=""  placeholder="Veuillez saisir le nom d'entreprise :">



        </div>



    </div><!--end col-->



    <div class="col-6">



        <div class="mb-3 position-relative">



            <label class="form-label small fw-bold">email <span class="text-danger">*</span></label>



            <input type="email" class="form-control" name="email" required=""  placeholder="Veuillez saisir votre email :">



        </div>



    </div><!--end col-->

 

   



    <div class="col-6">



        <div class="mb-3 position-relative">



            <label class="form-label small fw-bold">Password <span class="text-danger">*</span></label>



            <input type="password" class="form-control" name="pass"  require="">



        </div>



    </div>



    <div class="col-6">



        <div class="mb-3 position-relative">



            <label class="form-label small fw-bold">Re-Password <span class="text-danger">*</span></label>



            <input type="password" class="form-control" name="pass1"  require="">



        </div>



    </div>





    <div class="col-12">



        <div class="mb-3 position-relative">



            <label class="form-label small fw-bold">Entreprise <span class="text-danger">*</span></label>



            <select id="company" name="societe" class="form-control" required>

              @foreach($societes as $societ)

             <option value="{{$societ->id}}">{{$societ->nom_societe}}</option>

              @endforeach

            </select>

            

        </div>



    </div>



    <div class="form-group">



      <button type="submit" class="btn btn-lg btn-primary" >Enregistrer</button>

      <button type="reset" class="btn btn-lg btn-warning"  >Annuler</button>

    </div>

 

                                  </form> 

                                  </div>

                              </div> 

                    </div>

                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->

</div>



  <!-- /.modal -->



 







@endsection

<script>

  selectBox = new vanillaSelectBox("#selectPays", {

    "keepInlineStyles":true,

    "maxHeight": 200,

    "minWidth":678,

    "search": true,

    "placeHolder": "Choose..." 

});

</script>