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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('reprogramacao_retrabalho') }}" class="breadcrumb-link">{{ $pagina}}</a></li>
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
                                        <input type="hidden" name="tipo" value="reprogramacao_retrabalho">                                        
                                        <input type="hidden" name="id" value="{{$obj->id}}">                                        
                                        
                                        <div class="form-group">
                                                <label for="">Data</label>
                                                <input type="date" name="data" value="2021-04-19" class="form-control" required id="id_data">
                                        </div>
                                        
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
                                                <label for="">Setor</label>
                                                <select name="idsetor" class="form-control form-control-sm" data-toggle="dropdown" id="id_idsetor">
                                                    @foreach ($setores as $setor)
                                                        <option value="{{$setor->id}}" 
                                                         @if ($setor->id == $obj->idsetor)
                                                                selected
                                                        @endif    
                                                        >{{ $setor->descricao}}</option>    
                                                    @endforeach
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Produto</label>
                                                <select name="idsetor" class="form-control form-control-sm" data-toggle="dropdown" id="id_idsetor">
                                                    @foreach ($produtos as $produto)
                                                        <option value="{{$produto->id}}" 
                                                        @if ($produto->id == $obj->idproduto)
                                                                selected
                                                        @endif 
                                                        >{{ $produto->descricao}}</option>    
                                                    @endforeach
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tipo</label>
                                                <select name="retrabalho" class="form-control form-control-sm" data-toggle="dropdown" id="id_retrabalho">
                                                    <option value="false" @if ($obj->retrabalho == 'true') selected @endif >Reprogramação</option>
                                                    <option value="true" @if ($obj->retrabalho == 'false') selected @endif >Retrabalho</option>
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Quantidade</label>
                                                <input type="number" step="0.001" name="quantidade" value="{{$obj->quantidade}}" class="form-control" placeholder="0" required id="id_quantidade">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Custo</label>
                                                <input type="number" step="0.001" name="custo" value="{{$obj->custo}}" class="form-control" placeholder="0" required id="id_custo">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Motivo</label>
                                                <select name="idmotivo" class="form-control form-control-sm" data-toggle="dropdown" id="id_idsetor">
                                                    @foreach ($motivos as $motivo)
                                                        <option value="{{$motivo->id}}" @if ($obj->idmotivo == $motivo->id) selected @endif >{{ $motivo->descricao}}</option>    
                                                    @endforeach
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