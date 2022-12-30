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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('prazo_entrega') }}" class="breadcrumb-link">{{ $pagina}}</a></li>
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
                                <h5 class="card-header">Calcular Prazos</h5>
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
                                        <input type="hidden" name="tipo" value="prazo_entrega">                                        
                                        <input type="hidden" name="id" value="{{$obj->id}}">                                        
                                        
                                        <div class="form-group">
                                                <label for="">Linha de Produção</label>
                                                <select name="idlinhaproducao" class="form-control form-control-sm" data-toggle="dropdown" id="id_linhaproducao">
                                                    @foreach ($linhas as $linha)
                                                        <option value="{{ $linha->id}}" 
                                                             @if ($linha->id == $obj->idlinhaproducao)
                                                                selected
                                                            @endif
                                                            >{{ $linha->descricao}}</option>    
                                                    @endforeach
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                                <label for="">Data</label>
                                                <input type="date" name="data" value="{{$obj->data}}" class="form-control" required id="id_data">
                                        </div>                                        
                                        
                                        <div class="col-sm-6 pl-0">
                                            <p class="text-center">
                                                <button type="submit" class="btn btn-rounded btn-primary">GerarDados</button>                                                
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