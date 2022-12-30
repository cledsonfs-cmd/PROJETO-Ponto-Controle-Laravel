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
                        <!-- basic form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Cadastro</h5>
                                <div class="card-body">
                               	<!--<c:if test="${erro_retorno != ''}">
                                    <div class="alert alert-danger" role="alert">
                                        ${erro_retorno}
                                    </div>
                                </c:if>-->                               

                                    <form method="post" id="basicform" action="{{ URL::asset('store')}}">
                                        @csrf
                                        <input type="hidden" name="tipo" value="folha_observacao">                                        
                                        <div class="form-group">
                                                <label for="">Folha</label>
                                                <input type="text" name="folha" value="{{ $obj->folha }}" class="form-control" placeholder="" required id="id_folha">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Processo</label>
                                                <select name="idprocesso" class="form-control form-control-sm" data-toggle="dropdown" id="id_processo">
                                                @foreach ($processos as $processo)
                                                        <option value="{{$processo->id}}" 
                                                        @if ($processo->id == $obj->idprocesso)
                                                            selected='selected'
                                                        @endif
                                                        >{{ $processo->descricao }}</option>  							  							
  						@endforeach
						</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Nome da Peça</label>
                                                <input type="text" name="nome_peca" value="{{$obj->nome_peca}}" class="form-control" placeholder="" required id="id_nome_peca">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Nome da Máquina</label>
                                                <select name="idmaquina" class="form-control form-control-sm" data-toggle="dropdown" id="id_maquina">
                                                @foreach ($maquinas as $maquina)
                                                        <option value="{{$maquina->id}}" 
                                                        @if ($maquina->id == $obj->idmaquina)
                                                            selected='selected'
                                                        @endif
                                                        >{{ $maquina->descricao }}</option>  							  							
  						@endforeach
  						</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Operador</label>                                                
                                                <select name="idoperador" class="form-control form-control-sm" data-toggle="dropdown" id="id_operador">
                                                @foreach ($operadores as $operador)
                                                        <option value="{{$operador->id}}" 
                                                        @if ($operador->id == $obj->idoperador)
                                                            selected='selected'
                                                        @endif
                                                        >{{ '('.$operador->codigo.') '.$operador->nome }}</option>  							  							
  						@endforeach
                                        	</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Experiência do Serviço</label>
                                                <input type="text" name="experiencia_servico" class="form-control" value="{{ $obj->experiencia_servico }}" required id="id_experiencia_servico">
                                        </div>

                                        <div class="form-group">
                                                <label for="">Sexo</label>
                                                <select name="sexo" class="form-control form-control-sm" data-toggle="dropdown" id="id_sexo">  						
  						<option value="masculino"                                                 
                                                @if ($obj->sexo == 'masculino')
                                                            selected='selected'
                                                @endif                                                  
                                                >Masculino</option>
  														
  						<option value="feminino" 
                                                @if ($obj->sexo == 'feminino')
                                                        selected='selected'
                                                @endif
                                                >Feminino</option>
  						
						</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Mestre</label>
                                                <select name="idmestre" class="form-control form-control-sm" data-toggle="dropdown" id="id_mestre">
                                                @foreach ($operadores as $operador)
                                                        <option value="{{$operador->id}}" 
                                                        @if ($operador->id == $obj->idmestre)
                                                            selected='selected'
                                                        @endif
                                                        >{{ '('.$operador->codigo.') '.$operador->nome }}</option>  							  							
  						@endforeach
  						</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Data</label>
                                                <input type="date" name="data" value="{{ $obj->data }}" class="form-control" required id="id_data">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Operação</label>
                                                <input type="text" name="operacao" value="{{ $obj->operacao}}" class="form-control" placeholder="0" required id="operacao">
                                        </div>

                                        <div class="form-group">
                                                <label for="">Número da Operação</label>
                                                <input type="text" name="numero_operacao" value="{{ $obj->numero_operacao}}" class="form-control" placeholder="0" required id="id_numero_operacao">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Número da Peça</label>
                                                <input type="text" name="numero_peca" value="{{$obj->numero_peca}}" class="form-control" placeholder="" required id="id_numero_peca">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Número da Máquina</label>
                                                <input type="text" name="numero_maquina" value="{{$obj->numero_maquina}}" class="form-control" placeholder="" required id="id_numero_maquina">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Material</label>
                                                <select name="idmateraprima" class="form-control form-control-sm" data-toggle="dropdown" id="id_operador">
                                                @foreach ($materiais as $material)
                                                        <option value="{{$material->id}}" 
                                                        @if ($material->id == $obj->idmateraprima)
                                                            selected='selected'
                                                        @endif
                                                        >{{ $material->descricao }}</option>  							  							
  						@endforeach
  						</select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Número da Seção</label>
                                                <input type="text" name="numero_secao" value="{{$obj->numero_secao}}" class="form-control" placeholder="" required id="id_numero_secao">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Início</label>
                                                <input type="datetime-local" value="{{$obj->inicio}}" name="inicio" class="form-control" placeholder="" id="id_inicio">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Fim</label>
                                                <input type="datetime-local" value="{{$obj->fim}}" name="fim" class="form-control" placeholder="" id="id_fim">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">N&uacute;mero Máquinas</label>
                                                <input type="text" name="numero_maquinas" value="{{$obj->numero_maquinas}}" class="form-control" placeholder="" id="id_numero_maquinas">
                                        </div>
                                        <div class="form-group">
                                                <label for="">Unidades Produzidas</label>
                                                <input type="text" name="unidades_acabadas" value="{{$obj->unidades_acabadas}}" class="form-control" placeholder="" id="id_numero_maquinas">
                                        </div>
                                        <div class="form-group">
                                                <label for="">Tempo Concedido - Fadiga;Necessidades (minutos)</label>
                                                <input type="text" name="fadiga" value="{{$obj->fadiga}}" class="form-control" placeholder="" id="id_numero_maquinas">
                                        </div>
                                        <div class="form-group">
                                                <label for="">Carga Hor&aacute;ria Di&aacute;ria (minutos)</label>
                                                <input type="text" name="jornada" value="{{$obj->jornada}}" class="form-control" placeholder="" id="id_numero_maquinas">
                                        </div>
                                        <div class="form-group">
                                                <label for="">Setup (minutos)</label>
                                                <input type="text" name="setup" value="{{$obj->setup}}" class="form-control" placeholder="" id="id_numero_maquinas">
                                        </div>
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">
                                            	<input type="hidden" name="tipo" value="folha_observacoes"/>
                                                
                                                @if ($obj->id >0)
                                                	<input type="hidden" name="id" value="{{$obj->id}}"/>
                                                @endif
                                                <button type="submit" class="btn btn-rounded btn-primary">Gravar Dados</button>
                                                <button type="reset" class="btn btn-rounded btn-light">Limpar Formul&aacute;rio</button>
                                            </p>
                                       </div>

                                    </form>
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