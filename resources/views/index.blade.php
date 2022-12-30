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
            <a class="nav-link" href="setor/{{ $setor->id.'/'.date('Y-m-d') }}"><i class="m-r-10 mdi mdi-format-wrap-square">&nbsp;&nbsp;{{ $setor->descricao }}</i></a>
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
                                <h2 class="pageheader-title">Dashboard </h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                            <!-- Carteiras  -->
                            <!-- ============================================================== -->
                            @foreach ($empresas as $empresa)
                               <div class="col-xl-4 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    @foreach ($carteiras as $carteira)
                                    @if ($empresa->id == $carteira->idempresa)                                    
                                    <h5 class="card-header">Carteira - Atual </h5>
                                    <div class="card-body">
                                        <h5 class="text-muted">{{ $empresa->apelido }}</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ 'R$ '.number_format($carteira->valor,2, ',', '.') }}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                                @foreach ($atualf as $atuf)
                                                    @if ($atuf->idempresa == $empresa->id)
                                                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">Giro {{number_format($atuf->valor/$carteira->valor,2)}}%</span>
                                                    @endif
                                                @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                            <!-- ============================================================== -->
                            <!-- end Carteiras  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
                    <div class="row">
                    <!-- ============================================================== -->
                    <!-- Faturamento  -->
                    <!-- ==============================================================-->
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Faturamento - Evolução no Mês</h5>
                            <div class="card-body">
                               <div id="fat_bar"></div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================================== -->
                    <!-- end Faturamento  -->
                    <!-- ============================================================== -->
                </div>
              <div class="row">
                   <!-- ============================================================== -->
                        <!--bar chart  -->
                        <!-- ============================================================== -->
                       <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Devolução Atual</h5>
                                <div class="card-body">
                                    <div id="dev_bar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!--end bar chart  -->
                        <!-- ============================================================== -->
                   <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Reprogramação & Retrabalho Atual</h5>
                                <div class="card-body">
                                    <div id="rep_bar"></div>
                                </div>
                            </div>
                        </div>
              </div>
            </div>
              
            </div>
@endsection
@section('scripts')
    @parent
    <script>
     Morris.Bar({
                element: 'fat_bar',
             hideHover: 'auto',
                data: [
                    @foreach ($graficofat as $dado)
                        {{ $dado }}
                    @endforeach
                	
                ],



                xkey: 'x',
                ykeys: [
                	@foreach ($empresas as $empresa)
                        '{{ $empresa->id }}',
                    @endforeach 
                ],
                labels: [
                    @foreach ($empresas as $empresa)
                        '{{ $empresa->nome }}',
                    @endforeach               	
                ],
                barColors: ['#ff407b', '#25d5f2', '#3CB371','#FFFF00'],
                resize: false,
                gridTextSize: '12px'

            });

            Morris.Bar({
                element: 'dev_bar',
             hideHover: 'auto',
                data: [
                    @foreach ($graficodev as $dev)
                        { x:'{{$dev->tipo}}', y: {{$dev->valor}} },
                    @endforeach 
                	
                ],
                xkey: 'x',
                ykeys: ['y'],
                labels: ['Valor R$'],
                   barColors: ['#ff407b'],
                     resize: true,
                        gridTextSize: '12px'

            });

            Morris.Bar({
                element: 'rep_bar',
             hideHover: 'auto',
                data: [
                    @foreach ($graficorep as $rep)
                        @if ($rep->retrabalho == 0) 
                            { x:'REPROGRAMAÇÃO', y: {{ $rep->valor }} },
                        @else
                            { x:'RETRABALHO', y: {{$rep->valor}} },
                        @endif                        
                    @endforeach 
                	
                ],
                xkey: 'x',
                ykeys: ['y'],
                labels: ['Valor Atual R$ '],
                   barColors: ['#ff407b'],
                     resize: true,
                        gridTextSize: '12px'

            });
            </script>
@endsection