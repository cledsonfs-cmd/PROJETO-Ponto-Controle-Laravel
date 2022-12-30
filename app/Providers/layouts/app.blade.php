<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href='public/assets/vendor/bootstrap/css/bootstrap.min.css'>
    <link rel="stylesheet" href="public/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href='public/assets/vendor/fonts/circular-std/style.css'>
    <link rel="stylesheet" href='public/assets/libs/css/style.css'>
    <link rel="stylesheet" href='public/assets/vendor/fonts/fontawesome/css/fontawesome-all.css'>
    <link rel="stylesheet" href='public/assets/vendor/charts/chartist-bundle/chartist.css'>
    <link rel="stylesheet" href='public/assets/vendor/charts/morris-bundle/morris.css'>
    <link rel="stylesheet" href='public/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css'>
    <link rel="stylesheet" href='public/assets/vendor/charts/c3charts/c3.css'>
    <link rel="stylesheet" href='public/assets/vendor/fonts/flag-icon-css/flag-icon.min.css'>
    <title>@yield('title')</title>
</head>

<body>
   <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index">@yield('title')</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">nome&nbsp;sobrenome </h5>
                                    <span class="status"></span><span class="ml-2">
                                    	Grupo:
                                    </span>
                                </div>
                                <!--<a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>-->
                                <a class="dropdown-item" href="logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">@yield('pagina')</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                <c:set var = "now" value = "<%= new java.util.Date()%>" />
                                <fmt:formatDate value="${now}" pattern="dd 'de' MMMM 'de' yyyy"/>
                                 {{ date('l, d \d\e M \d\e Y') }}
                            </li>
                                                      
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="m-r-10 mdi mdi-settings"></i>Administra&ccedil;&atilde;o </a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="usuariosAdm"><i class="m-r-10 mdi mdi-account-multiple">&nbsp;&nbsp;Usu&aacute;rios</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="funcionariosAdm"><i class="m-r-10 mdi mdi-account-switch">&nbsp;&nbsp;Funcion&aacute;rios</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="especialidadesAdm"><i class="m-r-10 mdi mdi-hospital-marker">&nbsp;&nbsp;Especialidades</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="conveniosAdm"><i class="m-r-10 mdi mdi-hospital-building">&nbsp;&nbsp;Conv&ecirc;nios</i></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="medicosAdm"><i class="m-r-10 mdi mdi-hops">&nbsp;&nbsp;M&eacute;dicos</i></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
       <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            @yield('content')
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             <strong>Copyright &copy; 2020 Pontos de Controle</strong></br>
			                Desenvolvido por <a href="http://www.cledsonfs.com.br">Cledson Francisco Silva</a>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="http://www.cledsonfs.com.br">Contato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
	<script src="public/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="public/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="public/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="public/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="public/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="public/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="public/assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="public/assets/vendor/charts/c3charts/c3.min.js'"></script>
    <script src="public/assets/vendor/charts/c3charts/d3-5.4.0.min.js'"></script>
    <script src="public/assets/vendor/charts/c3charts/C3chartjs.js'"></script>
    <script src="public/assets/libs/js/dashboard-ecommerce.js'"></script>
    <script src="public/assets/vendor/charts/charts-bundle/Chart.bundle.js'"></script>
        
    <script>

    </script>


</body>
 
</html>