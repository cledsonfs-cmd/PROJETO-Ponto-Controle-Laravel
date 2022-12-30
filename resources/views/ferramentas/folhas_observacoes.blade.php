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
                        <!-- ============================================================== -->
                        <!-- basic table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                 <h5 class="card-header"><a href="{{ URL::asset('/form/folha_observacoes/FolhaObservacoes') }}" class="badge badge-primary">Novo</a></h5>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th scope="col" width="100">Processo</th>
                                                <th scope="col" width="100">Folha</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($folhas as $dado)
                                                <tr bgcolor="#f0f8ff">                                            	
                                                    @foreach ($processos as $processo)
                                                        @if ($dado->idprocesso == $processo->id)
                                                            <td align="left">{{ $processo->descricao }}</td>
                                                        @endif                                            		    
                                                    @endforeach
                                                    <td align="left">{{ $dado->folha }}</td>
                                                    <td align="center" width="20%">
                                                        <a href="{{ URL::asset('folha_observacoes/'.$dado->id.'/N') }}" class="badge badge-success">Exibir</a>
                                                        <a href="{{ URL::asset('folha_observacoes/'.$dado->id.'/S') }}" class="badge badge-info">Alterar Dados</a><br/>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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