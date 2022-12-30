@extends('layouts.admin')

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
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('admin') }}" class="breadcrumb-link">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('admin/pontocontrole') }}" class="breadcrumb-link">{{ $pagina}}</a></li>
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
                                        <input type="hidden" name="tipo" value="pontocontrole">
                                        <input type="hidden" name="id" value="{{$obj->id}}">                                         
                                        <div class="form-group">
                                                <label for="">Descrição</label>
                                                <input type="text" name="descricao" class="form-control" placeholder="25 Caracteres" value="{{$obj->descricao}}" required id="id_setor">
                                        </div>

                                        <div class="form-group">
                                                <label for="">Setor</label>
                                                <select name="idsetor" class="form-control form-control-sm" data-toggle="dropdown" id="id_idempresa">
                                                    @foreach ($setores as $setor)
                                                        <option value="{{ $setor->id }}"
                                                            @if ($setor->id == $obj->idsetor)
                                                                selected
                                                            @endif
                                                    >{{ $setor->descricao}}</option>    
                                                    @endforeach                                                    
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="">Campos</label>
                                                <p>
                                                 <label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="observacao" class="filled" id="filled-state-1"  
                                                        @if ($obj->observacao == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Observação
												    </label>
                                                <br/>
                                                    <label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="peso" class="filled" id="filled-state-1" 
                                                        @if ($obj->peso == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Peso
												    </label>
                                                <br/>

													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="produto_componente" class="filled" id="filled-state-1" 
                                                        @if ($obj->produto_componente == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Produto Componente
												    </label>
											    <br/>												
                                                
													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="quantidade" class="filled" id="filled-state-1" 
                                                        @if ($obj->quantidade == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Quantidade
												    </label>
                                                <br/>												
                                                
													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="valor" class="filled" id="filled-state-1" 
                                                        @if ($obj->valor == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Valor
												    </label>
                                                <br/>
                                                    <label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="volume" class="filled" id="filled-state-1" 
                                                        @if ($obj->volume == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Volume
												    </label>
                                                <br/>												
                                                
													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="extra1" class="filled" id="filled-state-1" 
                                                        @if ($obj->extra1 == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Extra-1
												    </label>
                                                <br/>												
                                                
													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="extra2" class="filled" id="filled-state-1" 
                                                        @if ($obj->extra2 == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Extra-2
												    </label>
                                                <br/>												
                                                
													<label for="filled-state-1" class="checkbox-filled">
														<input type="checkbox" name="extra3" class="filled" id="filled-state-1" 
                                                        @if ($obj->extra3 == 1)
                                                            checked="checked" 
                                                        @endif
                                                        />
														<i class="highlight"></i>
														Extra-3
												    </label>
											    </p>
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
@endsection