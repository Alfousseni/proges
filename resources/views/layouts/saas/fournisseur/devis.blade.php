@extends('saas.index')
@section('contenu')    
<div class="container">
<div class="row">
  <div id="flHorizontalForm" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
      <div class="widget-header">                                
        <div class="row">
          <div class="col-xl-12 col-md-12 col-sm-12 col-12">
            <h4>Formulaire de demande de devis</h4>
          </div>                                                                        
        </div>
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
      <div class="card-header">
        <form action="{{ route('send.devis') }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Choix du client</label>
              <div class="col-sm-10">
                <select name="frs" class="form-control" multiple>
                  <option value="">-- Choisir les fournisseurs --</option>
                    @foreach($frs as $fr)
                  <option value="{{$fr->numero}}">{{$fr->prenom}} &nbsp; {{$fr->nom}} </option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Message</label>
			<div class="col-md-6">
				<textarea class="form-control" 	name="message" 	rows="3" 	id="textareaDefault"></textarea>
        @error('message')
                    <span class="text-danger"> {{ $message }} </span>
              @enderror
			</div>
		  </div>        

          @foreach($transs as $trans)
            <input type="hidden"  name="numc" value="{{$trans -> numcmd}} " />
          @endforeach

          <table class="multi-table table table-striped dt-table-hover table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>N°</th>
                <th>Numero</th>
                <th>Nom produit</th>
                <th>Qté à commander</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tmps as $tmp)
              <tr>
                <td><input type="hidden"  name="id" value="{{$tmp->id}}" />{{$tmp->id}}</td>
                <td><input type="hidden"  name="ref[]" value="{{$tmp->refprod}}>"/>{{$tmp->refprod}}</td>
                <td><input type="hidden"  name="nom" value="{{$tmp->nomprod}}"/>{{$tmp->nomprod}}</td>
                @error('nom')
                  <span class="text-danger"> {{ $message }} </span>
                 @enderror
                <td><input type="number" name="qte" required></td>
                @error('qte')
                    <span class="text-danger"> {{ $message }} </span>
                  @enderror
                <td align="center"> 
                  <a href="{{route('supprime-produit',$tmp->refprod)}}"  class="btn btn-dark">
                    <i class="feather feather-minus"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table><br>
            
          <button type="submit" class="btn btn-primary">Valider</button>
          <button type="reset" class="btn btn-primary">Effacer</button>

        </form>
      </div>
    </div>
  </div>
</div>
@include('saas.fournisseur.add_produit')
</div>
@endsection