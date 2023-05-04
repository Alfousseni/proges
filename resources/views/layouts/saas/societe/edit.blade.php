@extends('saas.index')
@section('content')
      
<div class="container">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                <li class="breadcrumb-item" aria-current="page">Societe</li>
                                <li class="breadcrumb-item active" aria-current="page">Editer</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
                    <div  class="col-lg-12 layout-spacing layout-top-spacing">
                            <div class="statbox widget ">
                                <div class="widget-header">                                
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
										<center>   <h4>Formulaire de Modification d'une société</h4> </center> 
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
                                <form action="{{route('societe.update',$societe->id)}}" method="post" enctype="multipart/form-data">
              						@csrf
									  @method('put')
									  <input type="hidden" name="id" value="{{$societe->id}}">

                            <div class="row">

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Nom de l'entreprise <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" name="nom_societe" required="" value="{{$societe->nom_societe}}">

                            </div>

                            </div><!--end col-->

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Telephone <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" name="tel" required="" value="{{$societe->tel}}">

                            </div>

                            </div><!--end col-->

                            <div class="col-12">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>

                                <input type="email" class="form-control" name="email" required="" value="{{$societe->email}}">

                            </div>

                            </div><!--end col-->



                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Site Web </label>

                                <input type="text" class="form-control" name="site_web" value="{{$societe->site}}">

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Responsable <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" name="responsable" required="" value="{{$societe->responsable}}">

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Nombre d'utilisateur souhaité <span class="text-danger">*</span></label>

                                <input type="number" class="form-control" min="1" name="nombre" required="" value="{{$societe->nombre_user}}">

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Adresse <span class="text-danger">*</span></label>

                                <input type="text" class="form-control" name="adresse" required="" value="{{$societe->adresse}}">

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Choisir votre logo d'entreprise </label>

                                <input type="file" class="form-control" name="image" >

                            </div>

                            </div>

                            <div class="col-6">

                            <div class="mb-3 position-relative">

                                <label class="form-label small fw-bold">Exonération <span class="text-danger">*</span></label><br>

                                <select id="company" name="exo" class="form-control" required>
                                <option value="{{$societe->exoneration}}">{{$societe->exoneration}}</option>
                                    <option value="Oui">Oui</option>

                                    <option value="Non">Non</option>

                                        </select>

                            </div>

                            </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary mb-2 me-4">Modifier</button>
                            </div>

                             </form> 
                              
                             </div> 
                    </div>
            </div>
 @endsection