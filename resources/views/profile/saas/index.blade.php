<!DOCTYPE html>
<html lang="fr">

    <head>
       
    @include('saas/pou/head')

    </head>

    <body class="layout-boxed">

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        @include('saas/pou/top')
    </div>
    <div class="main-container" id="container">
        
        <div class="overlay"></div>
        <div class="search-overlay"></div>
 
         <!--  BEGIN SIDEBAR  -->
         
            @include('saas/pou/leftside')

         <!--  END SIDEBAR  -->


        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="middle-content container-xxl p-0">

                        <div class="row layout-top-spacing">
                        
                        <!-- end page title --> 
                        @yield('content')
                        
                        </div>

                    </div>

                </div>
                <!-- Footer Start -->
                @include('saas/pou/footer')
                <!-- end Footer -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>

        @include('saas/pou/js')
        
    </body>
</html>