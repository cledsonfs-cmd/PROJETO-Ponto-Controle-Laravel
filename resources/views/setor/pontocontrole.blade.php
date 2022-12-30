@extends('layouts.pontocontrole')

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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('setor/'.$setor->id.'/'.$data2) }}" class="breadcrumb-link">{{$setor->descricao}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $pontocontrole->descricao }}</li>
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
                         @if ($pontocontrole->quantidade == 1)                        
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Quantidade (und)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($total_quantidade, 0, ',', '.') }}</h2>
                                        </div>
                                    </div>
                                    <div id="sparkline-quantidade"></div>
                                </div>
                        </div>
                        @endif
                        @if ($pontocontrole->peso == 1)                        
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Peso (kg)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($total_peso, 3, ',', '.') }}</h2>
                                        </div>
                                    </div>
                                    <div id="sparkline-peso"></div>
                                </div>
                            </div>
                        @endif
                        @if ($pontocontrole->valor == 1) 
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Valor (R$)</h5>
                                        <div class="metric-value d-inline-block">
                                            <h2 class="mb-1">{{ number_format($total_valor, 2, ',', '.') }}</h2>
                                        </div>
                                    </div>
                                    <div id="sparkline-valor"></div>
                                </div>
                            </div>
                        @endif
                        </div>
                        <div class="row">
                        
                        </div>
                        <div class="row">
                              <!-- ============================================================== -->
                        <!-- striped table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h4 class="card-header">
                                    Dados
                                </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Data</th>
                                                @if ($pontocontrole->produto == 1) 
                                                <th scope="col">Produto</th>
                                                @endif
                                                @if ($pontocontrole->quantidade == 1) 
                                                <th scope="col">Und</th>
                                                @endif
                                                @if ($pontocontrole->peso == 1) 
                                                <th scope="col">Kg</th>
                                                @endif
                                                @if ($pontocontrole->volume == 1) 
                                                <th scope="col">ml</th>
                                                @endif
                                                @if ($pontocontrole->valor == 1) 
                                                <th scope="col">R$</th>
                                                @endif
                                                @if ($pontocontrole->observacao == 1) 
                                                <th scope="col">Observação</th>
                                                @endif
                                                @if ($pontocontrole->estra1 == 1) 
                                                <th scope="col">Extra-1</th>
                                                @endif
                                                @if ($pontocontrole->estra2 == 1) 
                                                <th scope="col">Extra-2</th>
                                                @endif
                                                @if ($pontocontrole->estra3 == 1) 
                                                <th scope="col">Extra-3</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $dado)                                            
                                                <tr bgcolor="#f0f8ff">
                                                    <td scope="col">{{ date('d/m/Y', strtotime($dado->data)) }}</td>
                                                     @if ($pontocontrole->produto == 1) 
                                                        <td scope="col">{{$pontocontrole->produto}}</td>
                                                    @endif
                                                    @if ($pontocontrole->quantidade == 1) 
                                                        <td scope="col">
                                                            {{ number_format($dado->quantidade, 0, ',', '.') }}                                                        
                                                        </td>
                                                    @endif
                                                    @if ($pontocontrole->peso == 1) 
                                                        <td scope="col">                                                       
                                                            {{ number_format($dado->peso, 3, ',', '.') }}                                                            
                                                        </td>
                                                    @endif
                                                    @if ($pontocontrole->volume == 1) 
                                                        <td scope="col">                                                       
                                                            {{ number_format($dado->volume, 3, ',', '.') }}                                                            
                                                        </td>
                                                    @endif
                                                    @if ($pontocontrole->valor == 1) 
                                                        <td scope="col">
                                                            {{ 'R$ '.number_format($dado->valor, 2, ',', '.') }}                                                        
                                                        </td>
                                                    @endif
                                                @if ($pontocontrole->observacao == 1) 
                                                    <td scope="col">{{$dado->observacao}}</td>
                                                @endif
                                                @if ($pontocontrole->estra1 == 1) 
                                                    <td scope="col">{{$dado->estra1}}</td>
                                                @endif
                                                @if ($pontocontrole->estra2 == 1) 
                                                    <td scope="col">{{$dado->estra2}}</td>
                                                @endif
                                                @if ($pontocontrole->estra3 == 1) 
                                                    <td scope="col">{{$dado->estra3}}</td>
                                                @endif                                                  
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tr>
                                            <td scope="col">Totalização</td>
                                            <td scope="col"><h4>
                                                @if ($pontocontrole->quantidade == 1)
                                                    {{ number_format($total_quantidade, 0, ',', '.') }}
                                                @endif
                                            </h4></td>
                                            <td scope="col"><h4>
                                                @if ($pontocontrole->peso == 1)
                                                    {{ number_format($total_peso, 3, ',', '.') }}
                                                @endif
                                            </h4></td>
                                            <td scope="col"><h4>
                                                @if ($pontocontrole->valor == 1)
                                                    {{ 'R$ '.number_format($total_valor, 2, ',', '.') }}
                                                @endif</h4></td>                                            
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
 

        $("#sparkline-quantidade").sparkline([
            @foreach ($dados as $dado)            
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

        $("#sparkline-peso").sparkline([
            @foreach ($dados as $dado)            
                {{ $dado->peso }},
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

        $("#sparkline-valor").sparkline([
            @foreach ($dados as $dado)            
                {{ $dado->valor }},
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