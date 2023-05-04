<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>PROGES-PME | Espace de connexion  </title>
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
    
                            <h2 class="mt-5 text-white font-weight-bolder px-2">PROGES-PME UTILISATEUR</h2>
                            <p class="text-white px-2">Votre Progiciel de Gestion des Processus Métiers</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>PROGES-PME</h2>
                                    <p>Merci de renseigner vos informations</p>
                                    
                                </div>

                               <form method="POST" action="{{ route('app.register') }}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nom Complet</label>
                                        <input type="text" name="name" :value="old('name')" required autofocus autocomplete="Entrer un nom complet" class="form-control add-billing-address-input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" :value="old('email')" placeholder="Entrer votre mail" required class="form-control">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="role" :value="__('Role')" />
                                    <select name="role" id="role" class="block mt-1 w-full" required>
                                        <option value="">Choose a role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Mot de Passe</label>
                                        <input type="password" name="password" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Confirmer mot de passe</label>
                                        <input type="password" name="password_confirmation" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                I agree the <a href="javascript:void(0);" class="text-primary">Terms and Conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary w-100">Valider</button>
                                    </div>
                                </div>
                                </form>
                                <div class="col-12 mb-4">
                                    <div class="">
                                        <div class="seperator">
                                        </div>
                                    </div>
                                </div>
                              

                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Vous avez déjà un compte ? <a href="{{route('app.login')}}" class="text-warning">Se connecter</a></p>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('saas/src/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>

