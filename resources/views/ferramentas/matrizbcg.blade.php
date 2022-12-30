@extends('layouts.ferramenta')

@section('title') 
    @parent
    {{ $title }}
@endsection

@section('pagina')
    @parent
    {{ $pagina }}
@endsection

@section('content')
    @parent
    <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">{{ $pagina }} </h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $pagina }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                       <!-- ============================================================== -->
                        <!-- horizontal form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                               <div class="card-body">
                                   <img src="images/Matriz_BCG2.jpg" alt="Matriz BCG"/>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end horizontal form -->
                        <!-- ============================================================== -->
                        </div>
                        <div class="row">
                       <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table WIDTH="100%">
                                        <tr>
                                            <td bgcolor='white' align="left">
                                                <h4>
                                                    <ul>
                                                        <li>Produ&ccedil;&atilde;p Constantes</li>
                                                        <li>Alta Produ&ccedil;&atilde;o</li>
                                                    </ul>
                                                </h4>
                                            </td>
                                            <td bgcolor='white' align="left">
                                                <h4>
                                                    <ul>
                                                        <li>Produ&ccedil;&atilde;p Constantes</li>
                                                        <li>Baixa Produ&ccedil;&atilde;o</li>
                                                    </ul>
                                                </h4>
                                            </td>
                                            <td bgcolor='white' align="left">
                                                <h4>
                                                    <ul>
                                                        <li>Produtos Novos</li>
                                                    </ul>
                                                </h4>
                                            </td>
                                            <td bgcolor='white' align="left">
                                                <h4>
                                                    <ul>
                                                        <li>Produtos Antigos</li>
                                                        <li>Baixa Produ&ccedil;&atilde;o</li>
                                                    </ul>
                                                </h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan='4' bgcolor='black'></th>
                                        </tr>
					                    <tr>
                                            <th>VACA LEITEIRA</th>
                                            <th>ESTRELA</th>
                                            <th>EM QUESTIONEMANTO</th>
                                            <th>ABACAXI</th>
                                        </tr>
                                        <tr>
                                            <th colspan='4' bgcolor='black'></th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection