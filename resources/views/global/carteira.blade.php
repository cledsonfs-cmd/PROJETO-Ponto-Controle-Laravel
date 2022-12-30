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
    <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">{{ $paginanome }} </h2>
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
                            <!-- Carteiras  -->
                            <!-- ============================================================== -->
                            <!-- A{% for objeto in carteira_atual_valor_list %}-->
                            @foreach ($empresas as $empresa)
                                <div class="col-xl-4 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> {{ $empresa->nome }}</h5>
                                    <div class="card-body">
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">
                                            @foreach ($atual as $atu)
                                                @if ($atu->idempresa == $empresa->id)
                                                    {{ 'R$ '.number_format($atu->valor,2, ',','.') }}
                                                @endif
                                            @endforeach
                                            </h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            @foreach ($atual as $atu)
                                                @foreach ($atualf as $atuf)
                                                    @if ($atu->idempresa == $empresa->id && $atuf->idempresa == $empresa->id)
                                                        <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">Giro {{number_format($atuf->valor/$atu->valor,2)}}%</span>
                                                    @endif
                                                @endforeach
                                            @endforeach                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                               
                            <!-- A{% endfor %}-->

                            <!-- ============================================================== -->
                            <!-- end Carteiras  -->
                            <!-- ============================================================== -->
                        </div>

                        <div class="row">
                        <!-- ============================================================== -->
                        <!--Carteira Char  -->
                        <!-- ============================================================== -->
                       <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Evolução</h5>
                                <div class="card-body">
                                    <div id="carteira_bar"></div>
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
                        <!-- A{% for empresa1 in empresa_list %}-->
                        @foreach ($empresas as $empresa)
                            
                        
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h4 class="card-header"> {{$empresa->nome}} </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Data</th>
                                                <th scope="col">Média/Dia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $dado)   
                                                @if ($dado->idempresa == $empresa->id)
                                                    <tr bgcolor="#f0f8ff">
                                                        <td align="center">{{ date('d/m/Y', strtotime($dado->data)) }}</td>
                                                        <td align="right">{{  'R$ '.number_format($dado->valor, 2, ',','.') }}</td>
                                                    </tr>                                        
                                                @endif                                             
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- ============================================================== -->
                        <!-- end striped table -->
                        <!-- ============================================================== -->
                         <!-- A{% endfor %} -->
                        </div>


                        </div>
                    </div>
@endsection
@section('scripts')
    @parent
    <script>
     Morris.Bar({
                element: 'carteira_bar',
             hideHover: 'auto',
                data: [
                    @foreach ($grafico as $dado)
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
                resize: true,
                gridTextSize: '12px'

            });
            </script>
@endsection