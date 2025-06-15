@extends('layouts.argo')

@section('content')
<div class="col">
    <div class="card mb-4">
        <div class="card-header">
            <h3>Detalhes</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                    <div class="card bg-gradient-success">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Novos</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $novos }}</span>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                        {{-- <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> --}}
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                
                <div class="col-xl-6 col-sm-6 mb-xl-6 mb-4">
                    <div class="card card-stats">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Clientes</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $clientes }}</span>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-sm-6 mb-xl-6 mb-4">
                    <div class="card card-stats">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Anúncios</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $anuncios }}</span>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-sm-6 mb-xl-6 mb-4">
                    <div class="card card-stats">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Categorias</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $categorias }}</span>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                        <i class="fas fa-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-sm-6 mb-xl-6 mb-4">
                    <div class="card card-stats">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Subcategorias</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $subcategorias }}</span>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                        <i class="fas fa-stream"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="card-footer">
            <h3></h3>
        </div>
    </div>
</div>
@endsection
