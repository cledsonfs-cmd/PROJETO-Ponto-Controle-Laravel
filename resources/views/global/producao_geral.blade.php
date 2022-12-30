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
                        <!--Carteira Char  -->
                        <!-- ============================================================== -->
                       <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                        <h5 class="card-header">Produção Atual ({{ $pecaproduzidas }} peças)</h5>
                                <div class="card-body">
                                    <div id="graf_atual"></div>
                                    <div id="legend" class="donut-legend"></div>
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
                                   Produção Atual por Setor (Und)
                                </h4>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Dia</th>
                                                @foreach ($setores as $setor)
                                                    <th>{{ $setor->descricao }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ( $dia=1 ;  $dia<=$ultimo_dia ; $dia++)          
                                                <tr bgcolor="#f0f8ff">
                                                    <td scope="col"> {{ $dia }} </td>
                                                    @foreach ($setores as $setor)
                                                        @foreach ($dados as $dado)
                                                            @if ($setor->id == $dado->idsetor && $dia == date('d', strtotime($dado->data)))
                                                                 <td scope="col"> {{ number_format($dado->quantidade, 0, ',', '.') }}</td>
                                                            @endif                                                    
                                                        @endforeach                                                        
                                                    @endforeach                                                   
                                                </tr>
                                            @endfor
                                            
                                          <!--{%  for valores in faturamento_atual_list%}
                                            {% if  empresa1.idempresa == valores.idempresa and anos.ano == valores.ano %}
                                                <tr bgcolor="#f0f8ff">
                                                    <td align="left"> valores.data|date:"d" </td>
                                                    <td align="right"> valores.faturamento </td>
                                                </tr>
                                            {% endif %}
                                          {% endfor %}
                                           {% for dia in dias_mes_list %}
                                                <tr bgcolor="#f0f8ff">
                                                    <td align="center"> dia </td>
                                                    {% for objeto in setor_list %}
                                                    <td align="right">
                                                    { for dados in  producao_atual_list
                                                        {% if dados.dia == dia and dados.codigo == objeto.codigo %}
                                                             dados.quantidade 
                                                        {% endif %}
                                                    {% endfor %}
                                                    </td>
                                                    {% endfor %}
                                                </tr>
                                            {% endfor %}-->
                                        </tbody>
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
var Data= [
    @foreach ($grafico as $dado)
        @foreach ($setores as $setor)
            @if ($dado->idsetor == $setor->id)
                {label: '{{ $setor->descricao }}', value: {{ $dado->total }} },
            @endif
        @endforeach 
    @endforeach 
  ];
 var total = {{ $pecaproduzidas }};
var browsersChart = Morris.Donut({
  element: 'graf_atual',
  data: Data,
  formatter: function (value, data) {
  	return Math.floor(value/total*100) + '%';
  }
});

  browsersChart.options.data.forEach(function(label, i) {
    var legendItem = $('<span></span>').text( label['label'] + " ( " +label['value'] + " )" ).prepend('<br><span>&nbsp;</span>');
    legendItem.find('span')
      .css('backgroundColor', browsersChart.options.colors[i])
      .css('width', '20px')
      .css('display', 'inline-block')
      .css('margin', '5px');
    $('#legend').append(legendItem)
  });
    </script>
@endsection