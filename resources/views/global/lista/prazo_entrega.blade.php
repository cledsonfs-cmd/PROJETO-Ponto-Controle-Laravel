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
                                <h2 class="pageheader-title">{{ $pagina }}</h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('global/'.$tipo.'/'.date('Y-m-d')) }}" class="breadcrumb-link">{{$pagina}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Listagem</li>
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
                        @foreach ($linhas as $linha)
                        
                        <div class="row">
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                 <h5 class="card-header">
                                
                                    {{ $linha->descricao }}
                                    
                                </h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th scope="col">Data</th>
                                                <th scope="col">Ocorrências</th>
                                                <th scope="col">Prazo Mínimo</th>
                                                <th scope="col">Prazo Máximo</th>
                                                <th scope="col">Prazo Médio</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $objeto)  
                                            @if ($linha->id == $objeto->idlinhaproducao)                                                                                      
                                            <tr bgcolor="#f0f8ff">
                                                <td scope="col">{{ $objeto->data }}</td>
                                                <td scope="col">{{ $objeto->registros }}</td>  
                                                <td scope="col">{{ $objeto->prazo_minimo }}</td>  
                                                <td scope="col">{{ $objeto->prazo_maximo }}</td>  
                                                <td scope="col">{{ $objeto->prazo_medio }}</td>                                     
                                                <td scope="col" width="5%">
                                                    <a href="{{ URL::asset('delete/'.$tipo.'/'.$pagina.'/'.$objeto->id) }}" class="badge badge-secondary">excluir</a>
                                                </td>
                                            </tr>
                                             @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach


                        <div class="row">
                        </div>
                        </div>
                    </div>
            </div>
           @endsection