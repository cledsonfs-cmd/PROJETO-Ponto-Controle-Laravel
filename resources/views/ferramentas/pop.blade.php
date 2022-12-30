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
                                            @if ($setor != '')
                                                <li class="breadcrumb-item"><a href="{{ URL::asset('/setor/'.$setor->id.'/'.date('y-m-d')) }}" class="breadcrumb-link">{{$setor->descricao}}</a></li>                                                
                                            @else
                                                <li class="breadcrumb-item"><a href="{{ URL::asset('pops') }}" class="breadcrumb-link">Procedimentos Operacionais Padrão</a></li>                                                
                                            @endif
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
                                    <h3 class="card-header"><B>PROCEDIMENTO OPERACIONAL PADR&Atilde;O - CODIGO: {{$objeto->codigo}}</B></h3>
                                    <div class="card-body">
                                        @if ($alteracao == 'S')
                                            <a href="{{ URL::asset('/update/pop/POP/'.$objeto->id) }}" class="badge badge-warning">Alterar</a>
                                        	&nbsp;
                                        	<a href="{{ URL::asset('delete/pop/'.$objeto->id) }}" class="badge badge-secondary">Excluir</a>
                                        @endif                                    	
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td align="left" colspan="4" class="align-text-top"><b>SETOR: </b>
                                                    @foreach ($setores as $setor)
                                                        @if ($objeto->idsetor == $setor->id)
                                                            {{$setor->descricao}}
                                                        @endif
                                                    @endforeach                                                
                                                </td>                                                
                                            </tr>
                                            <tr>
                                                <td align="left" rowspan="3" colspan="3"><b>TAREFA: </b>{{$objeto->tarefa}}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-text-top"><b>REVIS&Atilde;O:</b> {{$objeto->revisao}}</td>
                                            </tr>
                                            <tr>
                                                <td class="align-text-top"><b>DATA:</b> {{ date('d/m/Y', strtotime($objeto->data)) }}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" colspan="2" class="align-text-top"><b>RESULTADO: </b>{{$objeto->resultado}}</td>
                                                <td align="left" colspan="2" class="align-text-top"><b>ENCARREGADO:</b> {{$objeto->responsavel}}</td>
                                            </tr>
                                            <tr>
                                                <td align="left" class="align-text-top" width="25%"><b>ITENS DE TRABALHO</b><br>{{$objeto->equipamentos}}</td>
                                                <td align="left" class="align-text-top" width="25%"><b>ITENS DE SEGURAN&Ccedil;A</b><br><b>EPI:</b> {{$objeto->epi}}<br><b>EPC:</b> {{$objeto->epc}}</td>
                                                <td align="left" class="align-text-top" width="25%"><b>RECOMENDA&Ccedil;&Atilde;O</b><br>{{$objeto->recomendacao}}</td>
                                                <td align="left" class="align-text-top" width="25%"><b>OBSERVA&Ccedil;&Atilde;O</b><br>{{$objeto->observacao}}</td>
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
                                @if ($alteracao == 'S')
                                	<h3 class="card-header"><a href="{{ URL::asset('/form/tarefa/'.$objeto->id) }}" class="badge badge-primary">NOVA TAREFA</a>&nbsp;</h3>
                                @endif 	
                                    <div class="card-body">
                                    <table class="table table-bordered" WIDTH="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" class="align-text-top" WIDTH="40%"><b>TAREFAS</b></td>
                                                <td align="center" class="align-text-top" WIDTH="60%"><b>PROCEDIMENTOS</b></td>
                                            </tr>
                                            @foreach ($tarefas as $tarefa)                                                                                     
                                            <tr>
                                                <td align="left" class="align-text-top" WIDTH="30%">
                                                    <div class="col-xl-10 col-lg-6 col-md-6 col-sm-12 col-12">
                                                              <div class="card">
                                                                  <div class="card-body">
                                                                      <h3 class="card-title">{{$tarefa->ordinal}}</h3>
                                                                      <p class="card-text">{{$tarefa->descricao}}</p>
                                                                      @if ($alteracao == 'S')
                                                                      	<a href="{{ URL::asset('delete/tarefa/'.$tarefa->id) }}" class="badge badge-danger">Excluir</a>
                                                                      @endif 
                                                                  </div>
                                                              </div>
                                                          </div>
                                                </td>
                                                <td align="left" class="align-text-top" WIDTH="70%">
                                                @if ($alteracao == 'S')
                                                    <h3 class="card-header"><a href="{{ URL::asset('/form/procedimento/'.$tarefa->id)}}" class="badge badge-primary">NOVO PROCEDIMENTO</a></h3>
                                                @endif 
                                                        @foreach ($procedimentos as $procedimento)
                                                        @if ($tarefa->id == $procedimento->idtarefa)
                                                          <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                                              <div class="card">
                                                                  <div class="card-body">
                                                                      <h3 class="card-title">{{$tarefa->ordinal.'.'.$procedimento->ordinal}}</h3>
                                                                      <p class="card-text">{{$procedimento->descricao}}</p>
                                                                      @foreach ($arquivos as $arquivo)   
                                                                      @if ($arquivo == ($procedimento->id.'.jpg') || $arquivo == ($procedimento->id.'.jpeg') || $arquivo == ($procedimento->id.'.png'))
                                                                          <div class="card" id="images">                                                                          
                                                                          		<div class="card-body">
                                                                          			<img src="{{ URL::asset('public/pop/'.$arquivo) }}" class="img-fluid mr-3" alt="Responsive image" width="100%">
    																			</div>
																			</div>
                                                                      @endif                                                                                                                                         	
                                                                      @endforeach
                                                                      @if ($procedimento->observacao != '')
                                                                        <h6 class="card-subtitle mb-2 text-muted">Obs.: {{$procedimento->observacao}}</h6>  
                                                                      @endif
                                                                      @if ($alteracao == 'S')
                                                                      <table border=1>
																	  	<tr>
                                                                            <td> 
                                                                                <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data" >
                                                                                @csrf
                                                                                <input type="hidden" name="tipo" value="pop">                                        
                                                                                <input type="hidden" name="id" value="{{$procedimento->id}}">                                        
                                                                                <input type="file" name="image" class="btn btn-rounded btn-light">                                                
                                                                                <button type="submit" class="badge badge-primary">Upload</button>
                                                                            </form>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                      	        <a href="{{ URL::asset('delete/procedimento/'.$procedimento->id) }}" class="badge badge-danger">Excluir Procedimento</a>
                                                                            </td>
                                                                        </tr>
                                                                      </table>
                                                                      @endif 
                                                                  </div>
                                                              </div>
                                                          </div>
                                                        @endif 
                                                    @endforeach
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
                        </div>
                        </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection