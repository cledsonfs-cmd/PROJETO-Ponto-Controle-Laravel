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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('folhas_observacoes') }}" class="breadcrumb-link">Folha Observações</a></li>
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
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h3 class="card-header"><center><B>FOLHA DE OBSERVA&Ccedil;&Atilde;O</B></center></h3>
                                    <div class="card-body">
                                        @if ($alteracao == 'S')
                                            <a href="{{ URL::asset('/update/folha_observacoes/folhaobservacoes/'.$objeto->id)}}" class="badge badge-info">Alterar</a>
                                            &nbsp;&nbsp;
                                            <a href="{{ URL::asset('delete/folha_observacoes/'.$objeto->id) }}" class="badge badge-secondary">Excluir</a>
                                            <br/>
                                        @endif                                    	
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Folha:</b></td><td align="center">{{$objeto->folha}}</td>                                      
                                                 <td align="left" class="align-text-top"><b>Data:</b></td><td align="center">{{ date('d/m/Y', strtotime($objeto->data)) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Opera&ccedil;&atilde;o:</b></td><td align="center">{{$objeto->operacao}}</td>
                                                <td align="left" class="align-text-top"><b>N. Opera&ccedil;&atilde;o:</b></td><td align="center">{{$objeto->numero_operacao}}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Nome da Pe&ccedil;a:</b></td><td align="center">{{$objeto->nome_peca}}</td>
                                                <td align="left" class="align-text-top"><b>N. Pe&ccedil;a:</b></td><td align="center">{{$objeto->numero_peca}}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Nome M&aacute;quina:</b></td><td align="center">
                                                	@foreach ($maquinas as $maquina)
                                                        @if ($maquina->id == $objeto->idmaquina)
                                                            {{$maquina->descricao}}
                                                        @endif
  						                            @endforeach
                                                </td>
                                                <td align="left" class="align-text-top"><b>N. M&aacute;quina:</b></td><td align="center">{{$objeto->numero_maquina}}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Operador:</b></td><td align="center">
                                                	@foreach ($operadores as $operador)                                                        
                                                        @if ($operador->id == $objeto->idoperador)
                                                            {{'('.$operador->codigo.') '.$operador->nome}}
                                                        @endif							  							
  						                            @endforeach                                               	
                                                </td>
                                                <td align="left" class="align-text-top"><b>Sexo:</b></td><td align="center">
                                                	{{ucwords($objeto->sexo)}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Experi&ecirc;ncia do Servi&ccedil;o:</b></td><td align="center">{{$objeto->experiencia_servico}}</td>
                                                <td align="left" class="align-text-top"><b>Material:</b></td><td align="center">
                                                	@foreach ($materiais as $material)
                                                        @if ($material->id == $objeto->idmateraprima)
                                                             {{ $material->descricao }}
                                                        @endif                                                       							  							
  						                            @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Mestre:</b></td><td align="center">
                                                	@foreach ($operadores as $operador)                                                        
                                                        @if ($operador->id == $objeto->idmestre)
                                                            {{'('.$operador->codigo.') '.$operador->nome}}
                                                        @endif							  							
  						                            @endforeach
                                                </td>
                                                <td align="left" class="align-text-top"><b>N. da Se&ccedil;&atilde;o:</b></td><td align="center">{{$objeto->numero_secao}}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Concedido(Fadiga,Necessidades):</b></td><td align="center">{{number_format($objeto->fadiga, 0, ',', '.')}} min</td>
                                                <td align="left" class="align-text-top"><b>Carga Horaria Di&aacute;ria:</b></td><td align="center">{{number_format($objeto->jornada, 0, ',', '.')}} min</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Setup:</b></td><td align="center">{{number_format($objeto->setup, 0, ',', '.')}} min</td>
                                                <td align="left" class="align-text-top"><b></b></td><td align="center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>                                                                                                
                                            	<td align="center" class="align-text-top"><b>In&iacute;cio<br/></b>{{date('d/m/Y h:i', strtotime($objeto->inicio))}}</td>
                                                <td align="center" class="align-text-top"><b>Fim<br/></b>{{date('d/m/Y h:i', strtotime($objeto->fim)) }}</td>
                                                <td align="center" class="align-text-top"><b>Tempo Percorrido<br/></b>{{$tempo_percorrido}} min</td>
                                                <td align="center" class="align-text-top"><b>Unidades Acabadas<br/></b>{{number_format($objeto->unidades_acabadas)}} und</td>
                                                <td align="center" class="align-text-top"><b>Tempo Efetivo<br/></b>{{number_format($tempo_efetivo,2)}}</td>
                                                <td align="center" class="align-text-top"><b>N. M&aacute;quinas<br/></b>{{$objeto->numero_maquinas}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="5"></th>
                                                <td align="center">
                                                    Elemento
                                                @if ($alteracao == 'S')
                                                    <br/><a href="{{ URL::asset('/form/elemento_folha/'.$objeto->id)}}" class="badge badge-primary">Adicionar</a>                                                    
                                                @endif
                                                </td>
                                                <td align="center" WIDTH="10">Vel.</td>
                                                <td align="center" WIDTH="30" colspan="2">Avan.</td>
                                                <td align="center" WIDTH="30">1</td>
                                                <td align="center" WIDTH="30">2</td>
                                                <td align="center" WIDTH="30">3</td>
                                                <td align="center" WIDTH="30">4</td>
                                                <td align="center" WIDTH="30">5</td>
                                                <td align="center" WIDTH="30">6</td>
                                                <td align="center" WIDTH="30">7</td>
                                                <td align="center" WIDTH="30">8</td>
                                                <td align="center" WIDTH="30">9</td>
                                                <td align="center" WIDTH="30">10</td>
                                                <td align="center" WIDTH="30">Tempo Normal</td>
                                                                                                
                                                @if ($alteracao == 'S')
                                                	<td align="center"  WIDTH="30"></td>
                                                @endif                                               
                                            </tr>
                                                @php
                                            	    $a1 = 0;
                                                    $a2 = 0;
                                                    $a3 = 0;
                                                    $a4 = 0;
                                                    $a5 = 0;
                                                    $a6 = 0;
                                                    $a7 = 0;
                                                    $a8 = 0;
                                                    $a9 = 0;
                                                    $a10 = 0;
                                                @endphp
                                            @foreach ($elementos as $elemento)
                                            <tr>
                                                <td width="5" rowspan="2">
                                                    {{$elemento->ordinal}}
                                                </td>
                                                <td rowspan="2">
                                                    {{$elemento->elemento}}
                                                </td>
                                                <td rowspan="2" WIDTH="10">
                                                    @if ($elemento->velocidade > 0)                                                	
                                                		{{$elemento->velocidade}}%
                                                	@endif                                                 
                                                </td>
                                                <td rowspan="2" WIDTH="10">
                                                    @if ($elemento->avanco > 0)                                                 	
                                                		{{$elemento->avanco.'%'}}
                                                	@endif
                                                </td>
                                                <td WIDTH="10">T</td>  
                                                 @php $t=0; @endphp
                                                    
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo1; @endphp                                                            
                                                        	{{number_format($elemento->tempo1, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo2; @endphp
                                                        	{{number_format($elemento->tempo2, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo3; @endphp
                                                        	{{number_format($elemento->tempo3, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo4; @endphp
                                                        	{{number_format($elemento->tempo4, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo5; @endphp
                                                        	{{number_format($elemento->tempo5, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo6; @endphp
                                                        	{{number_format($elemento->tempo6, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo7; @endphp
                                                        	{{number_format($elemento->tempo7, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo8; @endphp
                                                        	{{number_format($elemento->tempo8, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo9; @endphp
                                                        	{{number_format($elemento->tempo9, 2)}}
                                                        </td>
                                                        <td WIDTH="10">  
                                                        	@php $t+=$elemento->tempo10; @endphp
                                                        	{{number_format($elemento->tempo10, 2)}}
                                                        </td>
                                                        @php $a1+=$elemento->tempo1; @endphp
                                                        @php $a2+=$elemento->tempo2; @endphp
                                                        @php $a3+=$elemento->tempo3; @endphp
                                                        @php $a4+=$elemento->tempo4; @endphp
                                                        @php $a5+=$elemento->tempo5; @endphp
                                                        @php $a6+=$elemento->tempo6; @endphp
                                                        @php $a7+=$elemento->tempo7; @endphp
                                                        @php $a8+=$elemento->tempo8; @endphp
                                                        @php $a9+=$elemento->tempo9; @endphp
                                                        @php $a10+=$elemento->tempo10; @endphp                                                                      
                                                <td>
                                                    @if ($elemento->velocidade > 0)
                                                        {{number_format((($elemento->velocidade/100) * $t), 2)}}
                                                    @endif
                                                </td>
                                                
                                                @if ($alteracao == 'S')
                                                    <td rowspan="2">
                                                        <a href="{{ URL::asset('/update/elemento_folha/ElementoFolha/'.$elemento->id)}}" class="badge badge-info">Alterar</a>&nbsp;&nbsp;
                                                        <a href="mvc?logica=Excluir&tipo=elemento&id=${elemento.id}&idfolha=${folha.id}" class="badge badge-secondary">Excluir</a>                                                    
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td WIDTH="20"><b>R</b></td>
                         	                       <td WIDTH="10">
                                                      	<b>{{number_format($a1,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a2,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a3,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a4,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a5,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a6,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a7,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a8,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a9,2)}}</b>
                                                   </td>
                                                   <td WIDTH="10">
                                                        <b>{{number_format($a10,2)}}</b>
                                                   </td>                                                
                                                <td WIDTH="10">
                                                	
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
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    
                                    <div class="card-body">                                    	
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Normal da Opera&ccedil;&atilde;o:</b> 
                                                {{number_format($tempo_normal_operacao,2)}} min</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Fator de Tolerancia:</b> 
                                                {{number_format($fator_tolerancia,2)}} </td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Pad&atilde;o da Opera&ccedil;&atilde;o:</b> 
                                                    {{number_format($tempo_padrao_operacao,2)}} min</td>                                                
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Pad&atilde;o da Opera&ccedil;&atilde;o (Com o tempo de SETUP p/ {{$objeto->unidades_acabadas}} unidades):</b>                                                 
                                                {{number_format($tempo_padrao_operacao_setup,2)}} min</td>                                                
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top"><b>N&uacute;mero de Pe&ccedil;as por Dia:</b> 
                                                {{number_format($numero_pecas,2)}} unidades </td>                                                
                                            </tr>
                                            
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Normal por Pe&ccedil;a:</b> 
                                                {{number_format($tempo_normal_peca,4)}} min</td>   
                                            </tr>                                            
                                            <tr>
                                                <td align="left" class="align-text-top"><b>Tempo Pad&atilde;o por Pe&ccedil;a:</b> 
                                                {{number_format($tempo_padrao_peca,4)}} min</td>   
                                            </tr>                                         
                                        </tbody>
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