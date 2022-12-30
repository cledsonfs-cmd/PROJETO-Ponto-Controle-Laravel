<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    @include('layouts.css')
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
                <a class="navbar-brand" href="http://www.cledsonfs.com.br/pontocontrole">@yield('title')</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src={{ URL::asset('public/assets/images/avatar-1.jpg') }} alt="" class="user-avatar-md rounded-circle"></a>
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
                    <a class="d-xl-none d-lg-none" href="#">{{ $setor->descricao }}</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                {{ $data }} 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="m-r-10 mdi mdi-folder-star"></i>RELATÓRIOS</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#"><i class="m-r-10 mdi mdi-note-text">&nbsp;&nbsp;-<span class="badge badge-secondary">New</span></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::asset('setor_layout/'.$setor->id) }}"><i class="far fa-map">&nbsp;&nbsp;Layout<span class="badge badge-secondary">Layout</span></i></a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="m-r-10 mdi mdi-av-timer"></i>HISTORICO</a>
                                <div id="submenu-10" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        
                                        @foreach ($anos as $ano)                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-{{ $ano }}" aria-controls="submenu-11">{{ $ano }}</a>
                                            <div id="submenu-{{ $ano }}" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        @foreach ($links as $link)
                                                            @if ($link->v1 == $ano)                                                                
                                                                <a class="nav-link" href="{{ URL::asset('setor/'.$setor->id.'/'.$link->v3.'-01') }}">{{ $link->v2}}</a>      
                                                            @endif
                                                        @endforeach                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-pop" aria-controls="submenu-pop"><i class="m-r-10 mdi mdi-settings"></i> POP's</a>
                                <div id="submenu-pop" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        @foreach ($pops as $pop)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::asset('pop/'.$pop->id.'/'.$setor->id) }}"><i class="m-r-10 mdi mdi-note-plus-outline">&nbsp;&nbsp;{{$pop->tarefa}}</i></a>
                                            </li>    
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-pc" aria-controls="submenu-pc"><i class="m-r-10 mdi mdi-settings"></i> PONTOS DE CONTROLE</a>
                                <div id="submenu-pc" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        @foreach ($pontos as $ponto)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ URL::asset('pontocontrole/'.$setor->id.'/'.$ponto->id.'/'.$data2) }}"><i class="m-r-10 mdi mdi-note-plus-outline">&nbsp;&nbsp;{{$ponto->descricao}}</i></a>
                                            </li>  
                                        @endforeach
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
@include('layouts.script')
@yield('scripts')
</body>
 
</html>