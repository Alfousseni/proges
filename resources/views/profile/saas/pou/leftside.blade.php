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
                    <span>Dashboard</span>
                </div>
            </a>
        </li>

        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>APPLICATIONS</span></div>
        </li>

        <li class="menu">
            <a href="/BACK/client/" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <i data-feather="package"></i>
                    <span>Gestion Produit</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="/BACK/client/" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <i data-feather="users"></i> 
                <span>Gestion Client</span>
                </div>
            </a>
        </li>

        <li class="menu">
            <a href="" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <i data-feather="truck"></i>  
                <span>Gestion fournisseur</span>
                </div>
            </a>
        </li>

     
 

        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>COMPTABILITE</span></div>
        </li>   

        <li class="menu">
            <a href="#caisse" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    <span>Gestion Caisse</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="caisse" data-bs-parent="#accordionExample">
                <li>
                    <a href=""> Entrée de caisse </a>
                </li>
                <li>
                    <a href=""> Sortie de caisse </a>
                </li>                  
            </ul>
        </li>

                     
        <li class="menu">
            <a href="#invoice" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span>Journaux</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="invoice" data-bs-parent="#accordionExample">
                <li>
                    <a href=""> Journal Achat </a>
                </li>
                <li>
                    <a href=""> Journal Caisse </a>
                </li>
                <li>
                    <a href=""> Journal Vente </a>
                </li>
                <li>
                    <a href="">  </a>
                </li>                            
            </ul>
        </li>
 
      <li class="menu">
            <a href="#Facture" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                   <span>Facturation</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="Facture" data-bs-parent="#accordionExample">
                <li>
                    <a href=""> Devis fournisseur</a>
                </li>
                <li>
                    <a href=""> Devis client</a>
                </li>
                <li>
                    <a href=""> Bon de commande</a>
                </li>
                <li>
                    <a href=""> Facture fournisseur</a>
                </li>
                <li>
                    <a href=""> Facture client </a>
                </li>
                
                <li>
                    <a href="">Facture divers</a>
                </li>                            
            </ul>
        </li>
 
 

        <li class="menu menu-heading">
            <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>TRANSACTION</span></div>
        </li>
        <li class="menu">
            <a href="#Achat" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <i data-feather="shopping-cart"></i>   
                <span>Gestion des achats</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="Achat" data-bs-parent="#accordionExample">
                <li>
                    <a href=""> Effectuer une commande</a>
                </li>
                <li>
                    <a href=""> Facture client </a>
                </li>
                
                <li>
                    <a href="">  </a>
                </li>                            
            </ul>
        </li>
 
        <li class="menu">
            <a href="#Vente" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                <i data-feather="shopping-bag"></i>   
                   <span>Gestion des ventes</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled" id="Vente" data-bs-parent="#accordionExample">
                <li>
                    <a href=""> Effectuer une vente</a>
                </li>
                <li>
                    <a href=""> Vente en cours </a>
                </li>
                
                <li>
                    <a href="">Vente effective  </a>
                </li>                            
            </ul>
        </li>
       
    </ul>
    
</nav>

</div>