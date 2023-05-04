
@extends('saas-1.index')
@section('contenu')
<div class="account-settings-container layout-top-spacing">
  <div class="account-content">
    <div class="row mb-3">
      <div class="col-md-12">
          <h2>Parametre</h2>
          <div class="animated-underline-content">
            <ul class="nav nav-tabs" id="animateLine" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="Ajout-user-tab" data-bs-toggle="tab" href="#AjoutUser" role="tab" aria-controls="AjoutUser" aria-selected="true"> 
              Information personnelles
            </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Liste-user-tab" data-bs-toggle="tab" href="#LesUser" role="tab" aria-controls="LesUser" aria-selected="false">
                 Gestion utilisateur
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Logo-tab" data-bs-toggle="tab" href="#Logo" role="tab" aria-controls="Logo" aria-selected="false">
                 Votre Logo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Entete-tab" data-bs-toggle="tab" href="#Entete" role="tab" aria-controls="Entete" aria-selected="false">
                 Entete
                </a>
              </li>
            </ul>
          </div>
    </div>
      <div class="tab-content" id="animateLineContent-3">
        <div class="tab-pane fade show active" id="AjoutUser" role="tabpanel" aria-labelledby="Ajout-user-tab">
            @include('saas-1/utilisateur/tabs')
        </div>
      
        <div class="tab-pane fade" id="LesUser" role="tabpanel" aria-labelledby="Liste-user-tab">
        @include('saas-1/utilisateur/index')
        </div>

        <div class="tab-pane fade" id="Logo" role="tabpanel" aria-labelledby="Logo-tab">
        @include('saas-1/utilisateur/logo')
        </div>
        <div class="tab-pane fade" id="Entete" role="tabpanel" aria-labelledby="Entete-tab">
        @include('saas-1/utilisateur/ent')
        </div>
    </div>
  </div>
</div>
@endsection