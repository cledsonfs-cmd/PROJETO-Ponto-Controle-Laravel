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
                                            <li class="breadcrumb-item active" aria-current="page">Listagem [{{ $listagem }}]</li>
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
                                 <h5 class="card-header">{{$pagina}} ({{ $listagem }}) </h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Data</th>
                                                <th scope="col">Pedido</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Valor</th>
                                                <th scope="col" colspan="2">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $objeto)                                                                                        
                                            <tr bgcolor="#f0f8ff">
                                                <td align="left">{{ $objeto->data }}</td>
                                                <td align="left">{{ $objeto->codpedido }}</td>                                              
                                                <td align="left">{{ number_format($objeto->quantidade, 0, ',', '.') }}</td>                                              
                                                <td align="left">{{ 'R#'. number_format($objeto->valor, 2, ',', '.') }}</td>                                              
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('update/'.$tipo.'/'.$pagina.'/'.$objeto->id) }}" class="badge badge-warning">alterar</a>
                                                </td>
                                                <td align="right" width="5%">
                                                    <a href="{{ URL::asset('delete/'.$tipo.'/'.$pagina.'/'.$objeto->id) }}" class="badge badge-secondary">excluir</a>
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
            </div>
           @endsection