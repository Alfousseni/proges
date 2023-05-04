<div class="row">
    <div class="card">
      <div class="card-body">
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
                <div class="row">
                    <div class="col-md-12 bg-primary-light">
                        <form action="{{route('utilisateur.update',$user->id)}}" method="post" enctype="multipart/form-data">
                         @csrf
                        @method('put')
                          <input type="hidden" name="id" value="{{$user->id}}">
                          <div class="row">	
                              <div class="col-3">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">Nom de l'utilisateur :</label>
                                      {{$user->name}}
                                  </div>
                              </div><!--end col-->
                              <div class="col-3">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">email :</label>
                                      {{$user->email}}
                                  </div>
                              </div><!--end col-->
                              <div class="col-3">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">Entreprise :</label>
                                      {{$user->Societe->nom_societe}}
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">Ancien Password :</label>
                                      <input type="password" class="form-control" name="ancien"  required>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">Nouveau Password :</label>
                                      <input type="password" class="form-control" name="nouveau"  required>
                                  </div>
                                  <p style="color:#000080;">Votre mot de passe doit contenir au moins 8 caracteres</p>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 position-relative">
                                      <label class="form-label small fw-bold">Confirmer Password :</label>
                                      <input type="password" class="form-control" name="nouveau1"  required>
                                  </div>
                              </div>
                          </div>	
  
                          <div class="form-group">
                              <button type="submit" class="btn btn-lg btn-primary" >Modifier</button>
                              <button type="reset" class="btn btn-lg btn-warning"  >Annuler</button>
                          </div>
                      </form> 
                     </div>
              </div> 
            </div>
      </div>
  </div>
  </div>

