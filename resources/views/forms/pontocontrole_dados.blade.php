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
                                <h2 class="pageheader-title">Cadastro - {{ $pagina }} </h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('setor/'.$setor->id.'/'.$data2) }}" class="breadcrumb-link">{{$setor->descricao}}</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('pontocontrole/'.$setor->id.'/'.$pontocontrole->id.'/'.$data2) }}" class="breadcrumb-link">{{ $pontocontrole->descricao}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $objeto }}</li>                                            
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
                                        <input type="hidden" name="tipo" value="pontocontrole_dados">
                                        <input type="hidden" name="id" value="{{$obj->id}}">  
                                        <input type="hidden" name="idponto" value="{{$pontocontrole->id}}">  
                                        <div class="form-group">
                                                <label for="">Data/Hora</label>
                                                <input type="datetime-local" value="{{$obj->data_hora}}" name="data_hora" class="form-control" placeholder="" id="id_fim">
                                        </div> 
                                        @if ($pontocontrole->produto == 1)
                                        <div class="form-group">
                                                <label for="">Produto</label>
                                                <input type="text" name="produto_componente" class="form-control" placeholder="" value="{{$obj->produto_componente}}" required id="id_descricao">
                                        </div>                             
                                        @endif
                                        @if ($pontocontrole->quantidade == 1)         
                                        <div class="form-group">
                                                <label for="">Quantidade (und)</label>
                                                <input type="number" step="1" name="quantidade" value="{{$obj->quantidade}}" class="form-control" placeholder="0" required id="id_quantidade">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->peso == 1)
                                        <div class="form-group">
                                                <label for="">Peso (kg)</label>
                                                <input type="number" step="0.001" name="peso" value="{{$obj->peso}}" class="form-control" placeholder="0" required id="id_quantidade">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->volume == 1)
                                        <div class="form-group">
                                                <label for="">Volume (ml)</label>
                                                <input type="number" step="0.001" name="volume" value="{{$obj->volume}}" class="form-control" placeholder="0" required id="id_quantidade">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->valor == 1)
                                        <div class="form-group">
                                                <label for="">Valor</label>
                                                <input type="number" step="0.01" name="valor" value="{{$obj->valor}}" class="form-control" placeholder="0" required id="id_valor">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->observacao == 1)
                                        <div class="form-group">
                                                <label for="">Observa&ccedil;&atilde;o</label>
                                                <textarea name="observacao" cols="40" rows="4" class="form-control" id="id_observacao">{{$obj->observacao}}</textarea>
                                        </div>
                                        @endif
                                        @if ($pontocontrole->extra1 == 1)
                                        <div class="form-group">
                                                <label for="">Extra-1</label>
                                                <input type="text" name="extra1" class="form-control" placeholder="" value="{{$obj->extra1}}" required id="id_descricao">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->extra2 == 1)
                                        <div class="form-group">
                                                <label for="">Extra-2</label>
                                                <input type="text" name="extra2" class="form-control" placeholder="" value="{{$obj->extra2}}" required id="id_descricao">
                                        </div>
                                        @endif
                                        @if ($pontocontrole->extra3 == 1)
                                        <div class="form-group">
                                                <label for="">Extra-3</label>
                                                <input type="text" name="extra3" class="form-control" placeholder="" value="{{$obj->extra3}}" required id="id_descricao">
                                        </div>
                                        @endif
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
@endsection