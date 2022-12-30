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
                                <h2 class="pageheader-title">Empresa</h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('admin') }}" class="breadcrumb-link">Admin</a></li>
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
                                 <h5 class="card-header"><a href="{{ URL::asset('form/'.$form.'/'.$form ) }}" class="badge badge-primary">Novo</a></h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col"  width="18%">Setor</th>
                                                <th scope="col"  width="20%">Descrição</th>
                                                <th scope="col">Campos</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($setores as $setor)                                                                                        
                                                @foreach ($objetos as $dado)
                                                    @if ($dado->idsetor == $setor->id)
                                                        <tr bgcolor="#f0f8ff">
                                                            <td>
                                                                {{ $setor->descricao }}
                                                            </td>
                                                            <td>
                                                                {{ $dado->descricao }}
                                                            </td>
                                                            <td align="left">
                                                            @if ($dado->produto_componente)  
                                                                <span class="badge badge-pill badge-success">Produto</span>                                                           
                                                            @endif
                                                            @if ($dado->quantidade == 1)  
                                                                <span class="badge badge-pill badge-success">Quantidade</span>                                                           
                                                            @endif
                                                            @if ($dado->peso)  
                                                                <span class="badge badge-pill badge-success">Peso</span>                                                           
                                                            @endif
                                                            @if ($dado->volume)  
                                                                <span class="badge badge-pill badge-success">Volume</span>                                                            
                                                            @endif
                                                            @if ($dado->valor)  
                                                                <span class="badge badge-pill badge-success">Valor</span>                                                                                                                      
	                                                        @endif
                                                            @if ($dado->observacao)  
                                                                <span class="badge badge-pill badge-success">Observacao</span>
                                                            @endif
	                                                        @if ($dado->extra1)  
                                                                <span class="badge badge-pill badge-success">Extra1</span>                                                           
                                                            @endif
	                                                        @if ($dado->extra2)  
                                                                <spanclass="badge badge-pill badge-success">Extra2</span>
                                                            @endif
	                                                        @if ($dado->extra3)  
                                                                <span class="badge badge-pill badge-success">Extra3</span>
                                                            @endif
                                                            </td>
                                                            <td align="right" width="15%">
                                                                <a href="{{ URL::asset('update/'. $form .'/'. $form .'/'. $dado->id) }}" class="badge badge-warning">alterar</a>
                                                            &nbsp;
                                                                <a href="{{ URL::asset('delete/'. $form .'/'. $dado->id) }}" class="badge badge-secondary">excluir</a>
                                                            </td>
                                            </tr>
                                                @endif
                                            @endforeach
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