@extends('layouts.global')

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
                                            <li class="breadcrumb-item"><a href="javascript: window.history.go(-1)" class="breadcrumb-link">Produção Geral</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{$pagina}}</li>
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
                                 <h5 class="card-header">{{$pagina}}</h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Data</th>
                                                <th scope="col">Componente</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Peso</th>
                                                <th scope="col">Setor</th>
                                                <th scope="col">Máquina</th>
                                                <th scope="col">Processo</th>
                                                <th scope="col">Controlado</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $objeto)                                                                                        
                                            <tr bgcolor="#f0f8ff">
                                                <td align="center">{{ date('d/m/Y', strtotime($objeto->data)) }}</td>
                                                <td align="center">{{ $objeto->componente }}</td>
                                                <td align="center">{{ number_format($objeto->quantidade, 0, ',', '.') }}</td>
                                                <td align="center">{{ number_format($objeto->peso, 0, ',', '.') }}</td>
                                                <td align="center">
                                                    @foreach ($setores as $setor)
                                                        @if ($setor->id == $objeto->idsetor)
                                                            {{ $setor->descricao }}        
                                                        @endif
                                                    @endforeach 
                                                </td>
                                                <td align="center">
                                                    @foreach ($maquinas as $maquina)
                                                        @if ($maquina->id == $objeto->idmaquina)
                                                            {{ $maquina->descricao }}        
                                                        @endif
                                                    @endforeach  
                                                </td>
                                                <td align="center">
                                                    @foreach ($processos as $processo)
                                                        @if ($processo->id == $objeto->idprocesso)
                                                            {{ $processo->descricao }}        
                                                        @endif
                                                    @endforeach                                                    
                                                </td>
                                                <td align="center">
                                                    @if ($objeto->controlado == 1)
                                                        SIM
                                                    @else
                                                        NÃO
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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