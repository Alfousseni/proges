<div class="container">
    <div  class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget ">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <center><h4>Veuillez choisir votre entete </h4> </center> 
                    </div>                                                                        
                </div>
            </div>
            <div class="card-header layout-spacing">
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
                <form action="{{route('ajout-entete',$societe->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                  
                  <div class="col-sm-12">
                 
                        <input type="file" class="form-control" name="image" >
                       
                                </div><br>
                                <div class="modal-footer">
                <button class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-default">Annuler</button>
              </div>
                </form> 
               
            </div> 
        </div>
    </div>
</div>