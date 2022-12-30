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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('pops') }}" class="breadcrumb-link">Procedimentos Operacionais Padrão</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: window.history.go(-1)" class="breadcrumb-link">Procedimento Operacional Padrão</a></li>
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
                                        <input type="hidden" name="tipo" value="tarefa">                                        
                                        <input type="hidden" name="idpop" value="{{$idpop}}"/>

                                        <div class="form-group">
                                                <label for="">Ordinal</label>
                                                <input type="text" name="ordinal" value="{{$obj->ordinal}}" class="form-control" placeholder="" required id="id_descricao">
                                        </div> 

                                        <div class="form-group">
                                                <label for="">Nome</label>
                                                <input type="text" name="descricao" value="{{$obj->descricao}}" class="form-control" placeholder="" required id="id_descricao">
                                        </div>                                                                                
                                                                                                                                                             
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">                                            	
                                                @if ($obj->id>0)
                                                    <input type="hidden" name="id" value="{{$obj->id}}"/>
                                                @endif                                                
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

                       
                    </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection