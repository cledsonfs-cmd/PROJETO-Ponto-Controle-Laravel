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
                                            <li class="breadcrumb-item"><a href="javascript: window.history.go(-2)" class="breadcrumb-link">Folha de Observa&ccedil;&atilde;o</a></li>
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
                        <!-- horizontal form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Inser&ccedil;&atilde;o de Dados</h5>
                                <div class="card-body">
                                    <form method="post" id="basicform" action="{{ URL::asset('store')}}">
                                        @csrf
                                        <input type="hidden" name="tipo" value="elemento_folha"/>                                         
                                        <input type="hidden" name="idfolha" value="{{$folha->id}}" id="id_idfolhaobservacao"/>
                                        <input type="hidden" name="id" value="{{$obj->id}}"/>                                        
                                        <div class="form-group">
                                                <label for="">Ordinal</label>
                                                <input type="text" name="ordinal" value="{{$obj->ordinal}}" class="form-control" placeholder="" required id="id_ordinal">
                                        </div>
                                        <div class="form-group">
                                                <label for="">Elemento</label>
                                                <input type="text" name="elemento" value="{{$obj->elemento}}" class="form-control" placeholder="" required id="id_elemento">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Velocidade</label>
                                                <input type="text" name="velocidade" value="{{$obj->velocidade}}" class="form-control" placeholder="" id="id_velocidade">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Avanço</label>
                                                <input type="text" name="avanco" value="{{$obj->avanco}}" class="form-control" placeholder="" id="id_avanco">
                                        </div>                                                                              
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 1</label>
                                                <input type="text" name="t1" value="{{$obj->tempo1}}" class="form-control" id="id_t1">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 2</label>
                                                <input type="text" name="t2" value="{{$obj->tempo2}}" class="form-control" id="id_t2">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 3</label>
                                                <input type="text" name="t3" value="{{$obj->tempo3}}" class="form-control"  id="id_t3">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 4</label>
                                                <input type="text" name="t4" value="{{$obj->tempo4}}" class="form-control"  id="id_t4">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 5</label>
                                                <input type="text" name="t5" value="{{$obj->tempo5}}" class="form-control" id="id_t5">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 6</label>
                                                <input type="text" name="t6" value="{{$obj->tempo6}}" class="form-control" id="id_t6">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 7</label>
                                                <input type="text" name="t7" value="{{$obj->tempo7}}" class="form-control" id="id_t7">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 8</label>
                                                <input type="text" name="t8" value="{{$obj->tempo8}}" class="form-control" id="id_t8">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 9</label>
                                                <input type="text" name="t9" value="{{$obj->tempo9}}" class="form-control" id="id_t9">
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Tempo 10</label>
                                                <input type="text" name="t10" value="{{$obj->tempo10}}" class="form-control" id="id_t10">
                                        </div>                                                                              
                                                                                                                                                             
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">                                            	
                                                <button type="submit" class="btn btn-rounded btn-primary">Gravar Dados</button>
                                                <button type="reset" class="btn btn-rounded btn-light">Limpar Formul&aacute;rio</button>
                                            </p>
                                       </div>
				</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end horizontal form -->
                        <!-- ============================================================== -->
                        </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection