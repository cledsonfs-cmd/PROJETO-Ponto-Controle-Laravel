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
                                <h2 class="pageheader-title">Cadastro - {{ $pagina }} </h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('devolucao') }}" class="breadcrumb-link">{{ $pagina}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $objeto}}</li>                                            
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
                               <!--{% if messages %}
                                    <div class="alert alert-danger" role="alert">
                                        {% for key, value in form.errors.items %}
                                             key : value 
                                        {% endfor %}

                                    </div>
                                {% elif form.errors %}
                                   <div class="alert alert-danger" role="alert">
                                         form.errors 
                                    </div>
                                {% endif %}-->

                                
                                    <form method="post" id="basicform" action="{{ URL::asset('store')}}">
                                        @csrf

                                        <input type="hidden" name="tipo" value="devolucao">                                        
                                        <input type="hidden" name="id" value="{{$obj->id}}">                                        
                                        
                                        <div class="form-group">
                                                <label for="">Empresa</label>
                                                <select name="idempresa" class="form-control form-control-sm" data-toggle="dropdown" id="id_idempresa">
                                                    @foreach ($empresas as $empresa)
                                                        <option value="{{ $empresa->id }}"
                                                            @if ($empresa->id == $obj->idempresa)
                                                                selected
                                                            @endif
                                                    >{{ $empresa->nome}}</option>    
                                                    @endforeach                                                    
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Codigo do Pedido</label>
                                                <input type="text" name="codpedido" value="{{$obj->codpedido}}" class="form-control" placeholder="10 Caracteres" required id="id_codpedido">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Produto</label>
                                                <select name="produto" class="form-control form-control-sm" data-toggle="dropdown" id="id_produto">
                                                    @foreach ($produtos as $produto)
                                                        <option value="{{ $produto->id }}"
                                                            @if ($empresa->id == $obj->id)
                                                                selected
                                                            @endif
                                                    >{{ $produto->descricao}}</option>    
                                                    @endforeach                                                    
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Valor</label>
                                                <input type="number" step="0.01" name="valor" value="{{$obj->valor}}" class="form-control" placeholder="0" required id="id_valor">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Quantidade</label>
                                                <input type="number" step="0.001" name="quantidade" value="{{$obj->quantidade}}" class="form-control" placeholder="0" required id="id_quantidade">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Unidade</label>
                                                <input type="text" name="unidade" value="{{$obj->unidade}}" class="form-control" placeholder="20 Caracteres" required id="id_unidade">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Data Faturamento</label>
                                                <input type="date" name="data_faturada" value="{{$obj->data_faturada}}" class="form-control" required id="id_data_faturada">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Data Devolução</label>
                                                <input type="date" name="data_devolucao" value="{{$obj->data_devolucao}}" class="form-control" required id="id_data_devolucao">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tipo</label>
                                                <select name="tipot" class="form-control" id="id_tipo">
                                                    <option value="DEVOLUÇÃO" @if ($obj->tipo == 'DEVOLUÇÃO') selected @endif >Devolução</option>
                                                    <option value="CONSERTO" @if ($obj->tipo == 'CONSERTO') selected @endif >Conserto</option>
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Motivo</label>
                                                <textarea name="motivo" cols="40" rows="10" class="form-control" placeholder="1000 Caracteres" required id="id_motivo">{{$obj->motivo}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Representante</label>
                                                <input type="text" name="representante" value="{{$obj->representante}}" class="form-control" size="55" placeholder="50 Caracteres" required id="id_representante">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Cliente</label>
                                                <input type="text" name="cliente" value="{{$obj->cliente}}" class="form-control" size="55" placeholder="50 Caracteres" required id="id_cliente">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Origem do Erro</label>
                                                <select name="origem_erro" class="form-control" id="id_origem_erro">
                                                    <option value="CLIENTE" @if ($obj->origem == 'CLIENTE') selected @endif >Cliente</option>
                                                    <option value="FABRICA" @if ($obj->origem == 'FABRICA') selected @endif >Fábrica</option>
                                                    <option value="REPRESENTANTE" @if ($obj->origem == 'REPRESENTANTE') selected @endif>Representante</option>
                                                </select>
                                        </div>
                                        
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-rounded btn-primary">Gravar Dados</button>
                                                <button type="reset" class="btn btn-rounded btn-light">Limpar Formulário</button>
                                            </p>
                                       </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                           

                        </div>
                        </div>
                    </div>
            </div>
@endsection