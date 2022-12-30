@extends('layouts.setor')

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
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Peças Produzidas(und)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($pecas_produzidas, 0, ',', '.') }}</h2>
                                        </div>
                                        <!--<div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span>+5.86%</span>
                                        </div>-->
                                    </div>
                                    <div id="sparkline-produzida"></div>
                                </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Peças Reprogramadas(und)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($pecas_reprogramadas, 0, ',', '.') }}</h2>
                                        </div>
                                        <!--<div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span>+{ indice1 }%</span>
                                        </div>-->
                                    </div>
                                    <div id="sparkline-reprogramada"></div>
                                </div>
                            </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Peças Reprocessadas(und)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($pecas_retrabalhadas, 0, ',', '.') }}</h2>
                                        </div>
                                        <!--<div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                            <span>-{ indice2 }%</span>
                                        </div>-->
                                    </div>
                                    <div id="sparkline-reprocessada"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                        <!-- ============================================================== -->
                        <!--Carteira Char  -->
                        <!-- ============================================================== -->
                       <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Produção {{$data1}}</h5>
                                <div class="card-body">
                                    <div id="graf_atual"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!--end Carteira Char  -->
                        <!-- ============================================================== -->
                        </div>
                        <div class="row">
                              <!-- ============================================================== -->
                        <!-- striped table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h4 class="card-header">
                                    Visão Atual do Setor
                                </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Dia</th>
                                                <th scope="col">Peças Produzidas(und)</th>
                                                <th scope="col">Peças Reprogramadas(und)</th>
                                                <th scope="col">Peças Reprocessadas(und)</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($dia = 1; $dia <= $ultimo_dia; $dia++)                                   
                                                <tr bgcolor="#f0f8ff">
                                                    <td ALIGN="center">{{ $dia }}</td>
                                                    <td ALIGN="center">
                                                        @foreach ($producaos as $dado) 
                                                            @if (date('d', strtotime($dado->data)) == $dia)
                                                                {{ number_format($dado->quantidade, 0, ',', '.') }}
                                                            @endif                                                                       
                                                        @endforeach
                                                    </td>
                                                    <td ALIGN="center">
                                                        @foreach ($reprogramadas as $dado) 
                                                            @if (date('d', strtotime($dado->data)) == $dia)
                                                                {{ number_format($dado->quantidade, 0, ',', '.') }}
                                                            @endif                                                                       
                                                        @endforeach
                                                    </td>
                                                    <td ALIGN="center">
                                                        @foreach ($retrabalhadas as $dado) 
                                                            @if (date('d', strtotime($dado->data)) == $dia)
                                                                {{ number_format($dado->quantidade, 0, ',', '.') }}
                                                            @endif                                                                       
                                                        @endforeach
                                                    </td>                                                    
                                                </tr>
                                            @endfor
                                        </tbody>
                                        <tr>
                                            <td ALIGN="center">Totalização</td>
                                            <td ALIGN="center"><h4>{{ number_format($pecas_produzidas, 0, ',', '.') }}</h4></td>
                                            <td ALIGN="center"><h4>{{ number_format($pecas_reprogramadas, 0, ',', '.') }}</h4></td>
                                            <td ALIGN="center"><h4>{{ number_format($pecas_retrabalhadas, 0, ',', '.') }}</h4></td>                                            
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end striped table -->
                        <!-- ============================================================== -->
                        </div>


                        
                    </div>
                    
            </div>
           @endsection
@section('scripts')
    @parent
    <script>
 Morris.Area({
                element: 'graf_atual',
                fillOpacity: 0.6,
                hideHover: 'auto',
                behaveLikeLine:true,
                data: [
                    @foreach ($grafico as $dado)            
                        {{ $dado }},
                    @endforeach
                ],
                xkey: 'x',parseTime:false,
                ykeys: ['y', 'z', 'w'],
               labels:  ['Produção','Retrabalho','Reprogramação'],
                   resize: true,
                   gridTextSize: '14px'
            });

        $("#sparkline-produzida").sparkline([
            @foreach ($producaos as $dado)            
                {{ $dado->quantidade }},
            @endforeach
        ], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#5969ff',
        fillColor: '#dbdeff',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true
    });

        $("#sparkline-reprogramada").sparkline([
            @foreach ($reprogramadas as $dado)            
                {{ $dado->quantidade }},
            @endforeach
        ], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#ff407b',
        fillColor: '#ffdbe6',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true
    });

        $("#sparkline-reprocessada").sparkline([
            @foreach ($retrabalhadas as $dado)            
                {{ $dado->quantidade }},
            @endforeach        ], {
        type: 'line',
        width: '99.5%',
        height: '100',
        lineColor: '#fec957',
        fillColor: '#fff2d5',
        lineWidth: 2,
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: undefined,
        resize: true,
    });

    </script>
@endsection