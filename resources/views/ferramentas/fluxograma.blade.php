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
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- images  -->
                                    <!-- ============================================================== -->
                                    <div class="card" id="images">
                                        <h5 class="card-header">
                                            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="tipo" value="fluxo">                                        
                                            <div class="row">    
                                                <div class="col-md-6">
                                                    <input type="file" name="image" class="btn btn-rounded btn-light">
                                                
                                                    <button type="submit" class="badge badge-primary">Upload</button>
                                                </div>
     
                                            </div>
                                            </form>
                                        </h5>
                                        
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end images -->
                                    <!-- ============================================================== -->
                                </div>
                            </div> 
                            @foreach ($files as $file)
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- images  -->
                                    <!-- ============================================================== -->
                                    <div class="card" id="images">
                                        <h5 class="card-header">                                            
                                            <a href="{{ URL::asset('fluxo_delete/'.$file) }}" class="badge badge-secondary">Excluir</a>
                                        </h5>
                                        <div class="card-body">
                                            <img src="{{ URL::asset('public/fluxos/'.$file) }}" class="img-fluid mr-3" alt="Responsive image" width="100%">
                                        </div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end images -->
                                    <!-- ============================================================== -->
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
@endsection
@section('scripts')
    @parent
    <script>
     
            </script>
@endsection