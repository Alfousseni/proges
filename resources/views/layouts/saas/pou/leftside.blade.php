<div class="sidebar-wrapper sidebar-theme">



<nav id="sidebar">



    <div class="navbar-nav theme-brand flex-row  text-center">

        <div class="nav-logo">

            <div class="nav-item theme-logo">

                <a href="">

                    <img src="{{asset('saas/src/assets/img/logo.svg')}}" class="navbar-logo" alt="logo">

                </a>

            </div>

            <div class="nav-item theme-text">

                <a href="" class="nav-link"> PROGES-PME </a>

            </div>

        </div>

        <div class="nav-item sidebar-toggle">

            <div class="btn-toggle sidebarCollapse">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>

            </div>

        </div>

    </div>

    <div class="shadow-bottom"></div>

    <ul class="list-unstyled menu-categories" id="accordionExample">

        <li class="menu active">

            <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">

                <div class="active">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>

                    <span>Tableau de Bord</span>

                </div>

            </a>

        </li>



        <li class="menu menu-heading">

            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>APPLICATIONS</span></div>

        </li>



        <li class="menu">

            <a href="{{route('societe.index')}}" aria-expanded="false" class="dropdown-toggle">

                <div class="">

                <i class="far fa-building"></i>

                    <span>Gestion Societe</span>

                </div>

            </a>

        </li>



        <li class="menu">

            <a href="{{route('user.index')}}" aria-expanded="false" class="dropdown-toggle">

                <div class="">

                <i data-feather="users"></i> 

                <span>Gestion Utilisateur</span>

                </div>

            </a>

        </li>

        <li class="menu">

        <a href="{{route('fonction.index')}}" aria-expanded="false" class="dropdown-toggle">

            <div class="">

            <i data-feather="slack"></i>  

            <span>Gestion des fonctions</span>

            </div>

        </a>

        </li>

        <li class="menu">

        <a href="{{route('Block.index')}}" aria-expanded="false" class="dropdown-toggle">

            <div class="">

            <i data-feather="slack"></i>  

            <span>Gestion des blocks</span>

            </div>

        </a>

        </li>

        <li class="menu">

        <a href="{{route('Secteur.index')}}" aria-expanded="false" class="dropdown-toggle">

            <div class="">

            <i data-feather="slack"></i>  

            <span>Gestion des secteurs</span>

            </div>

        </a>

        </li>

        <li class="menu">

        <a href="{{route('Menu.index')}}" aria-expanded="false" class="dropdown-toggle">

            <div class="">

            <i data-feather="slack"></i>  

            <span>Gestion des menus</span>

            </div>

        </a>

        </li>




        <li class="menu">

            <a href="" aria-expanded="false" class="dropdown-toggle">

                <div class="">

                <i data-feather="slack"></i>  

                <span>Gestion Abonnement</span>

                </div>

            </a>

        </li>


  <li class="menu">

            <a href="{{route('messagerie.index')}}" aria-expanded="false" class="dropdown-toggle">

                <div class="">

                <i data-feather="mail"></i>

                    <span>Messagerie</span>

                </div>

            </a>

        </li>

     

 



       

 

        

       

    </ul>

    

</nav>



</div>