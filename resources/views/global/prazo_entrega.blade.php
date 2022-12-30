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
                                <h2 class="pageheader-title">{{ $paginanome }}</h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
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
                                 <h5 class="card-header">{{$pagina}} ({{ $dataprazo }}) </h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">linha de Produção</th>
                                                <th scope="col">Ocorrências</th>
                                                <th scope="col">Prazo Mínimo</th>
                                                <th scope="col">Prazo Máximo</th>
                                                <th scope="col">Prazo Médio</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $objeto)                                                                                        
                                            <tr bgcolor="#f0f8ff">
                                                <td scope="col">
                                                    @foreach ($linhas as $linha)
                                                        @if ($linha->id == $objeto->idlinhaproducao)
                                                            {{ $linha->descricao }}
                                                        @endif
                                                    @endforeach                                                    
                                                </td>
                                                <td scope="col">{{ $objeto->registros }}</td>  
                                                <td scope="col">{{ $objeto->prazo_minimo }}</td>  
                                                <td scope="col">{{ $objeto->prazo_maximo }}</td>  
                                                <td scope="col">{{ $objeto->prazo_medio }}</td>                                                 
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