@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LISTADO DE VENTAS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12">
                        <form action="{{ route('venta.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" name="texto" placeholder="Buscar venresos" value="{{ $texto }}">
                                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-plus-circle-fill"></i></span>
                                        <a href="{{ route('venta.create') }}" class="btn btn-success">Nuevo</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Comprobante</th>
                                    <th>Impuesto</th>
                                    <th>Total</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $ven)
                                <tr>
                                    <td>
                                        <a href="{{route('venta.show', $ven->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#"><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    <td>{{ $ven->fecha_hora }}</td>
                                    <td>{{ $ven->nombre }}</td>
                                    <td>{{ $ven->tipo_comprobante.': '. $ven->num_comprobante}}</td>
                                    <td>{{ $ven->impuesto }}</td>
                                    <td>{{ $ven->total_venta}}</td>
                                    <td>{{ $ven->estatus }}</td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                        {{ $ventas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
