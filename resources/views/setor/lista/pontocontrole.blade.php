@extends('layouts.pontocontrole')

@section('title') 
    @parent
    {{ $title }}
@endsection

@section('pagina')
    @parent
    {{ $title }}
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
                                <h2 class="pageheader-title">{{ $title }}</h2>
                                <p class="pageheader-text"></p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('/') }}" class="breadcrumb-link">Inicio</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('setor/'.$setor->id.'/'.$data2) }}" class="breadcrumb-link">{{$setor->descricao}}</a></li>
                                            <li class="breadcrumb-item"><a href="{{ URL::asset('pontocontrole/'.$setor->id.'/'.$pontocontrole->id.'/'.$data2) }}" class="breadcrumb-link">{{ $pontocontrole->descricao}}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Dados de {{$data1}}</li> 
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

                                
                                    <form method="post" id="basicform" action="{{ URL::asset('pontocontrole_lista_pesquisa')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$pontocontrole->id}}">                                        
                                        <div class="form-group">
                                                <label for="">Data</label>
                                                <input type="month" name="data" class="form-control" required id="id_data">
                                        </div>
                                        
                                        <div class="col-sm-6 pl-0">                                            
                                                <button type="submit" class="badge badge-success">Pesquisar Dados</button>                                           
                                       </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                 <h5 class="card-header">
                                     <form method="post" id="basicform" action="{{ URL::asset('store')}}">
                                        @csrf                                    
                                        <input type="hidden" name="id" value="{{$pontocontrole->id}}">
                                        </form>
                                    </h5>
                                    <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Data</th>
                                                @if ($pontocontrole->produto == 1) 
                                                <th scope="col">Produto</th>
                                                @endif
                                                @if ($pontocontrole->quantidade == 1) 
                                                <th scope="col">Und</th>
                                                @endif
                                                @if ($pontocontrole->peso == 1) 
                                                <th scope="col">Kg</th>
                                                @endif
                                                @if ($pontocontrole->volume == 1) 
                                                <th scope="col">ml</th>
                                                @endif
                                                @if ($pontocontrole->valor == 1) 
                                                <th scope="col">R$</th>
                                                @endif
                                                @if ($pontocontrole->observacao == 1) 
                                                <th scope="col">Observação</th>
                                                @endif
                                                @if ($pontocontrole->estra1 == 1) 
                                                <th scope="col">Extra-1</th>
                                                @endif
                                                @if ($pontocontrole->estra2 == 1) 
                                                <th scope="col">Extra-2</th>
                                                @endif
                                                @if ($pontocontrole->estra3 == 1) 
                                                <th scope="col">Extra-3</th>
                                                @endif
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dados as $dado)                                            
                                                <tr bgcolor="#f0f8ff">
                                                    <td scope="col">{{ date('d/m/Y h:i', strtotime($dado->data_hora)) }}</td>
                                                     @if ($pontocontrole->produto == 1) 
                                                        <td scope="col">{{$pontocontrole->produto}}</td>
                                                    @endif
                                                    @if ($pontocontrole->quantidade == 1) 
                                                        <td scope="col">
                                                            {{ number_format($dado->quantidade, 0, ',', '.') }}                                                        
                                                        </td>
                                                    @endif
                                                    @if ($pontocontrole->peso == 1) 
                                                        <td scope="col">                                                       
                                                            {{ number_format($dado->peso, 3, ',', '.') }}                                                            
                                                        </td>
                                                    @endif
                                                     @if ($pontocontrole->volume == 1) 
                                                        <td scope="col">                                                       
                                                            {{ number_format($dado->volume, 3, ',', '.') }}                                                            
                                                        </td>
                                                    @endif
                                                    @if ($pontocontrole->valor == 1) 
                                                        <td scope="col">
                                                            {{ 'R$ '.number_format($dado->valor, 2, ',', '.') }}                                                        
                                                        </td>
                                                    @endif
                                                @if ($pontocontrole->observacao == 1) 
                                                    <td scope="col">{{$dado->observacao}}</td>
                                                @endif
                                                @if ($pontocontrole->extra1 == 1) 
                                                    <td scope="col">{{$dado->extra1}}</td>
                                                @endif
                                                @if ($pontocontrole->extra2 == 1) 
                                                    <td scope="col">{{$dado->extra2}}</td>
                                                @endif
                                                @if ($pontocontrole->extra3 == 1) 
                                                    <td scope="col">{{$dado->extra3}}</td>
                                                @endif   
                                                <td scope="col" width="5%">
                                                    <a href="{{ URL::asset('update/'.$tipo.'/'.$pagina.'/'.$dado->id) }}" class="badge badge-warning">alterar</a>
                                                </td>
                                                <td scope="col" width="5%">
                                                    <a href="{{ URL::asset('delete/'.$tipo.'/'.$dado->id) }}" class="badge badge-secondary">excluir</a>
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