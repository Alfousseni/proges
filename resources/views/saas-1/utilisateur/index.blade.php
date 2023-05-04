
<div class="row">
  <div class="card">
    <div class="card-header">
      <h5>Liste des utilisateurs
      <a href="" style="text-align:right; float:right; margin-bottom:20px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
<em class="icon ni ni-plus"></em>
<span>Ajouter un utilisateur</span>
</a>
      </h5>
      <p class="text-muted font-13 mb-4">
        Les informations affichées ci dessous sont les enregistrements des différents fournisseurs de votre structure.
      </p>
    </div>
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
             <td class="text-center">{{ $user-> name}}</td>  
             <td class="text-center">{{ $user-> email}}</td>
             <td class="text-center">{{ $user->societe ? $user->societe->nom_societe:''}}</td> 
             <td class="text-center">
                  <a href="{{route('user.edit1', $user -> id)}}}" title="editer"  style="float:left;"  class="badge badge-light-warning text-start me-2 " >
                 <i data-feather="edit"></i></a>
                 <form id="destroy{{ $user-> id}}" action="{{route('user.destroy1', $user -> id)}}" method="POST" 
                  onSubmit="return confirm('Confirmez-vous votre suppression?')"  >
                    @csrf
                    @method('DELETE')
                    <button class="badge badge-light-danger text-start action-delete" style="float:left;" ><i data-feather="trash"></i></button>
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
                                      <form action="{{route('user.store1')}}" method="post" enctype="multipart/form-data">
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
                                 <select id="company" name="societe" class="form-control" readonly required>
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
                             </div>
                               </div>
                             </div>



  <!-- /.modal -->