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
                                            <li class="breadcrumb-item"><a href="javascript: window.history.go(-2)" class="breadcrumb-link">Procedimento Operacional Padrão</a></li>
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
                                    <form method="post" id="basicform" action="{{ URL::asset('store')}}">
                                        @csrf
                                        <input type="hidden" name="tipo" value="pop">
                                        <input type="hidden" name="id" value="{{$obj->id}}"> 

                                        <div class="form-group">
                                                <label for="">C&oacute;digo</label>
                                                <input type="text" name="codigo" value="{{$obj->codigo}}" class="form-control" required id="id_codigo">
                                        </div>

                                        <div class="form-group">
                                                <label for="">Data</label>
                                                <input type="date" name="data" value="{{$obj->data}}" class="form-control" required id="id_data">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Setor</label>
                                                <select name="idsetor" class="form-control form-control-sm" data-toggle="dropdown" id="id_setor">
                                                	@foreach ($setores as $setor)                                                
                                                    <option value="{{$setor->id}}"
                                                        @if ($setor->id == $obj->idsetor)
                                                            selected="selected"
                                                        @endif
                                                        >{{$setor->descricao}}</option> 														
                                                    @endforeach
												</select>
                                        </div>                                       
                                        
                                        <div class="form-group">
                                                <label for="">Revis&atilde;o</label>
                                                <input type="text" name="revisao" class="form-control" value="{{$obj->revisao}}" required id="id_revisao">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Respons&aacute;vel</label>
                                                <input type="text" name="responsavel" class="form-control" value="{{$obj->responsavel}}" required id="id_responsavel">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Revisor</label>
                                                <input type="text" name="revisor" class="form-control" value="{{$obj->revisor}}" required id="id_revisor">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tarefa</label>
                                                <textarea name="tarefa" cols="40" rows="3" class="form-control" required id="id_tarefa">{{$obj->tarefa}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Resultado</label>
                                                <textarea name="resultado" cols="40" rows="3" class="form-control" id="id_resultado">{{$obj->resultado}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Equipamentos</label>
                                                <textarea name="equipamentos" cols="40" rows="4" class="form-control" id="id_equipamentos">{{$obj->equipamentos}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">EPI</label>
                                                <textarea name="epi" cols="40" rows="4" class="form-control" id="id_epi">{{$obj->epi}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">EPC</label>
                                                <textarea name="epc" cols="40" rows="4" class="form-control" id="id_epc">{{$obj->epc}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Recomenda&ccedil;&atilde;o</label>
                                                <textarea name="recomendacao" cols="40" rows="4" class="form-control" id="id_recomendacao">{{$obj->recomendacao}}</textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Observa&ccedil;&atilde;o</label>
                                                <textarea name="observacao" cols="40" rows="4" class="form-control" id="id_observacao">{{$obj->observacao}}</textarea>
                                        </div>
                                        
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">
                                            <input type="hidden" name="tipo" value="pop"/>
                                            @if ($obj->id>0)
                                                <input type="hidden" name="id" value="${objeto.id}"/>
                                            @endif                                            
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
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection