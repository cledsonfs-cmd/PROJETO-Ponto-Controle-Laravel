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
                        <!-- ============================================================== -->
                        <!--Carteira Char  -->
                        <!-- ============================================================== -->
                       
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Evolução Custo(R$) Reprogramação</h5>
                                <div class="card-body">
                                    <div id="rep_bar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!--end Carteira Char  -->
                        <!-- ============================================================== -->
                        </div>
                        <div class="row">
                        <!-- ============================================================== -->
                        <!--Carteira Char  -->
                        <!-- ============================================================== -->
                       <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Evolução Custo(R$) Retrabalho</h5>
                                <div class="card-body">
                                    <div id="ret_bar"></div>
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
                        @foreach ($empresas as $empresa)                        
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h4 class="card-header">
                                    {{ $empresa->apelido }} (Reprogramação)
                                </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">DIA</th>
                                                <th scope="col">Qtd(und)</th>
                                                <th scope="col">Vlr($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $dado) 
                                               @if ($dado->idempresa == $empresa->id && $dado->tipo='Reprogramação')                                            
                                                <tr bgcolor="#f0f8ff">
                                                    <td scope="col">{{ date('d/m/Y', strtotime($dado->data)) }}</td>
                                                    <td scope="col">{{ number_format($dado->quantidade, 0, ',', '.') }}</td>
                                                    <td scope="col">{{ 'R$ '.number_format($dado->custo, 2, ',', '.') }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end striped table -->
                        <!-- ============================================================== -->
                        @endforeach
                        </div>
                        <div class="row">
                              <!-- ============================================================== -->
                        <!-- striped table -->
                        <!-- ============================================================== -->
                        @foreach ($empresas as $empresa)
                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h4 class="card-header">
                                    {{ $empresa->apelido }} (Retrabalho)
                                </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                               <th>DIA</th>
                                                <th>Qtd(und)</th>
                                                <th>Vlr($)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($dados1 as $dado) 
                                               @if ($dado->idempresa == $empresa->id && $dado->tipo='Reprogramação')                                            
                                                <tr bgcolor="#f0f8ff">
                                                    <td scope="col">{{ date('d/m/Y', strtotime($dado->data)) }}</td>
                                                    <td scope="col">{{ number_format($dado->quantidade, 0, ',', '.') }}</td>
                                                    <td scope="col">{{ 'R$ '.number_format($dado->custo, 2, ',', '.') }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end striped table -->
                        <!-- ============================================================== -->
                        @endforeach
                        </div>


                        </div>
                    </div>
            </div>
           @endsection
           @section('scripts')
    @parent
<script>
     Morris.Bar({
                element: 'rep_bar',
             hideHover: 'auto',
                data: [
                        @foreach ($graficorep as $dado)
                            {{ $dado }}
                        @endforeach            	
                ],
                xkey: 'x',
                ykeys: [
                    @foreach ($empresas as $empresa)
                        {{ $empresa->id }},
                    @endforeach            	                     
                ],
                labels: [
                        @foreach ($empresas as $empresa)
                            '{{ $empresa->apelido }}',
                        @endforeach                                    	
                ],
                barColors: ['#ff407b', '#25d5f2', '#3CB371','#FFFF00'],
                resize: false,
                gridTextSize: '12px'

            });

            Morris.Bar({
                element: 'ret_bar',
             hideHover: 'auto',
                data: [
                       @foreach ($graficoret as $dado)
                        {{ $dado }}
                    @endforeach            	
                ],
                xkey: 'x',
                ykeys: [
                	     @foreach ($empresas as $empresa)
                        {{ $empresa->id }},
                    @endforeach            	                     
                ],
                labels: [
                        @foreach ($empresas as $empresa)
                            '{{ $empresa->apelido }}',
                        @endforeach                                    	
                ],
                barColors: ['#ff407b', '#25d5f2', '#3CB371','#FFFF00'],
                resize: false,
                gridTextSize: '12px'

            });
            </script>
@endsection