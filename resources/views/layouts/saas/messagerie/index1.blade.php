@extends('saas-1.index')
@section('contenu')

    <div class="row">
  <div class="card">
    <div class="card-header">
      <h5>Liste des messages
      <a href="/app/messagerie-envoie" title="demander un devis" style="text-align:right; float:right; margin-bottom:20px;" 
          class="btn btn-primary mb-2 me-2" ><i data-feather="list"></i> Envoies</a>  
        <a href="" title="Ajouter un fournisseur" style="text-align:right; float:right; margin-bottom:20px;" 
          class="btn btn-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i data-feather="plus"></i> Nouveau</a>
      </h5>
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
						              <th class="text-center">Obet</th>
						              <th class="text-center">Provenance</th>
						              <th class="text-center">Date</th>
						              <th class="text-center">Action</th>
						            </tr>
						          </thead>
						          <tbody>
						 	 @foreach($messages as $message)
						            <tr>
						              <td class="text-center">{{$message->Objet}}</td>
						              <td class="text-center">Admininistrateur</td> 
						              <td class="text-center">{{$message->created_at}}</td>
						              <td class="text-center">
						              <a href="{{route('messagerie.show', $message-> id)}}" title="afficher"  style="float:left;" 
						               class="btn btn-success btn-icon mb-1 me-2 btn-rounded">
						               <i data-feather="eye"></i></a>
						               
						               @if($message->validated == 0)
						               <form id="destroy{{ $message-> id}}" action="{{route('messagerie.destroy', $message-> id)}}" method="POST" 
						               onSubmit="return confirm('Confirmez-vous votre suppression?')" >
						                      @csrf
						                      @method('DELETE')
						               <button  class="btn btn-danger btn-icon mb-1 me-1 btn-rounded"  style="float:left;" ><i data-feather="trash"></i></button>
						               @elseif($message->validated == 1)
						                <button  class="btn btn-danger btn-icon mb-1 me-1 btn-rounded"  style="float:left;" disabled><i data-feather="trash"></i></button>
						               @endif
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

<!-- Modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h4 class="modal-title" id="myCenterModalLabel">Formulaire d'envoi message</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-12 bg-primary-light">
            <form action="{{route('messagerie.store')}}" method="post" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="email_dest" class="form-control" id="validationCustom01" value="contact@jenmedias.com">
                  <div class="row">
                <p class="panel-subtitle">
                  Veuillez renseigner les champs ci-dessous.
                </p>
                <div class="col-md-12">
                  <label for="validationCustom01" class="form-label">Objet Message</label>
                  <input type="text" 
                          name="objet"  
                          class="form-control" 
                          id="validationCustom01" 
                          placeholder="Saisir le titre du message" 
                          required>
                  <div class="valid-feedback">Looks good!</div>
               </div>
                
             
              
               <div class="row">
                <div class="col-md-12">
                  <label class="form-label">Adresse </label>
                  <textarea class="form-control"  id="editor-container" name="message"  rows="3" ></textarea>
                </div>
                  
              <div class="modal-footer">
                <button class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-default">Annuler</button>
              </div>
            </form> 
          </div>
        </div> 
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection