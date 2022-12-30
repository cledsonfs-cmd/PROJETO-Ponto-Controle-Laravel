@extends('layouts.app')

@section('title') 
    @parent
    {{ $title }}
@endsection

@section('pagina')
    @parent
    {{ $pagina }}
@endsection

@section('setores')
    @foreach ($setores as $setor)
        <li class="nav-item">
            <a class="nav-link" href="{{ URL::asset('setor/'.$setor->id.'/'.date('Y-m-d')) }}"><i class="m-r-10 mdi mdi-format-wrap-square">&nbsp;&nbsp;{{ $setor->descricao }}</i></a>
        </li>    
    @endforeach
@endsection


@section('content')
    @parent
             <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">{{ $pagina }}</h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Carga Dados</li>
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
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                 <h5 class="card-header">Carga Dados </h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tabela</th>
                                                <th scope="col">Registros Atuais</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                                                                                                   
                                            <tr bgcolor="#f0f8ff">
                                                <td align="left">Carteira</td>
                                                <td align="left">{{ $registroscarteira }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/carteira') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td>  
                                            </tr>
                                            <tr bgcolor="#f0f8ff">
                                                <td align="left">Devolução</td>
                                                <td align="left">{{ $registrosdevolucao }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/devolucao') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td>  
                                            </tr>
                                            <tr bgcolor="#f0f8ff">                                              
                                                <td align="left">Faturamento</td>
                                                <td align="left">{{ $registrosfaturamento }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/faturamento') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td> 
                                            </tr>
                                            <tr bgcolor="#f0f8ff">                                              
                                                <td align="left">Prazos de Entrega</td>
                                                <td align="left">{{ $registrosprazo_entrega }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/prazo_entrega') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td> 
                                            </tr>
                                            <tr bgcolor="#f0f8ff">                                              
                                                <td align="left">Reprogramação & Retrabalho</td>
                                                <td align="left">{{ $registrosreprogramacao_retrabalho }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/reprogramacao_retrabalho') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td> 
                                            </tr>
                                            <tr bgcolor="#f0f8ff">                                              
                                                <td align="left">Produção Geral</td>
                                                <td align="left">{{ $registrosproducao_geral }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('cargabruta/producao_geral') }}" class="badge badge-warning">Gerar Aleatório</a>
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        </div>
                        </div>
                    </div>
            </div>
           @endsection