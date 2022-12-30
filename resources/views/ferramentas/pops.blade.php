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
                                 <h5 class="card-header"><a href="{{ URL::asset('/form/pop/POP') }}" class="badge badge-primary">Novo</a></h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Setor</th>                                                
                                                <th scope="col">Tarefa</th>
                                                <th scope="col">Revis&atilde;o</th>
                                                <th scope="col">Data</th>
                                                <th scope="col" colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($objetos as $objeto)
                                            <tr bgcolor="#f0f8ff">
                                                <td align="left">
                                                    @foreach ($setores as $setor)                                                    
                                                        @if ($setor->id == $objeto->idsetor)
                                                            {{$setor->descricao}}
                                                        @endif                                                		
                                                	@endforeach
                                                </td>                                                
                                                <td align="left">{{$objeto->tarefa}}</td>
                                                <td align="left">{{$objeto->revisor}} ({{$objeto->revisao}})</td>
                                                <td align="left">{{ date('d/m/Y', strtotime($objeto->data)) }}</td>
                                                 <td align="center" width="20%">
                                                        <a href="{{ URL::asset('pop/'.$objeto->id.'/N') }}" class="badge badge-success">Exibir</a>
                                                        <a href="{{ URL::asset('pop/'.$objeto->id.'/S') }}" class="badge badge-info">Alterar Dados</a><br/>
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
                        </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection