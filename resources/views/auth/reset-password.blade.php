<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>PROGES-PME |Reinitialiser </title>
    <link rel="icon" type="image/x-icon" href="{{asset('saas/src/assets/img/favicon.ico')}}"/>
    <link href="{{asset('saas/layouts/vertical-light-menu/css/light/loader.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('saas/layouts/vertical-light-menu/css/dark/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('saas/layouts/vertical-light-menu/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('saas/src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('saas/layouts/vertical-light-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('saas/src/assets/css/light/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{asset('saas/layouts/vertical-light-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('saas/src/assets/css/dark/authentication/auth-cover.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('saas/src/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/2514a9f0c0.js" crossorigin="anonymous"></script>
<style>
    .mdp {
        width:100%;
        position: relative;
    }
    .mdp i {
    position: absolute;
    top: 11px;
    right: 10px;
    font-size: 18px;
    cursor: pointer;
    }
    .mdp i.active::before{
        content:'\f070';
        color:#5256ad;
    }
</style>
    <!-- END GLOBAL MANDATORY STYLES -->
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="auth-cover">
    
                        <div class="position-relative">
    
                            <img src="{{asset('saas/src/assets/img/auth-cover.svg')}}" alt="auth-img">
    
                            <h2 class="mt-5 text-white font-weight-bolder px-2">PROGES-PME</h2>
                            <p class="text-white px-2">Votre Progiciel de Gestion des Processus Métiers</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
								@if (session('status'))
                                             <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                             </div>
                                @endif

                                    <h2>PROGES-PME | CLIENT</h2>
                                    <p>Espace de connexion au progiciel</p>
                                    
                                </div>
        <form method="POST" action="{{ route('app.password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="col-md-12">
           <div class="mb-3">
             <label class="form-label">Email</label>
         <input id="email"  type="email" name="email" :value="old('email', $request->email)" required autofocus class="form-control">
            </div>
         </div>
         <div class="col-12">
        <div class="mb-4">
         <label class="form-label">Password</label>
        <input id="password"  type="password" name="password" required class="form-control">
        <x-input-error :messages="$errors->get('password')" class="mt-2" />              
         </div>
         </div>
         <div class="col-12">
        <div class="mb-4">
         <label class="form-label">Confirmer Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />         </div>
         </div>
            

            

            <div class="flex items-center justify-end mt-4">
            <div class="mb-4">
            <button  type="submit" class="btn btn-secondary w-100"> Connexion</button>
            </div>
            </div>
        </form>
        </body>
</html>
