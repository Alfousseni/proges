<div class="container">
    <div  class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget ">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <center><h4>Ajout de votre Logo</h4> </center> 
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
                <form action="{{route('ajout-logo',$societe->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                  <input type="hidden" name="id" value="{{$societe->id}}">
                  
                  <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Votre Logo</h5>
                                        </div>
                                        <div class="card-block">
                                                <div class="fallback">
                                <center><img src="../../../uploads/societe/logo/{{ $societe->logo }}" style="margin-bottom:20px;" height="100" width="150"/></center>
                                <input type="file" name="image" id="input-file-now" class="dropify" />
                                                </div>
                                           
                                        </div>
                                    </div>
                                </div><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary mb-2 me-4">Valider</button>
                            <button type="reset" class="btn btn-lg btn-primary mb-2 me-4">Annuler</button>
                       
                    </div>
                </form> 
            </div> 
        </div>
    </div>
</div>
