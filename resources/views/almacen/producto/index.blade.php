@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LISTADO DE PRODUCTOS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
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
                        <form action="{{ route('producto.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" name="texto" placeholder="Buscar productos" value="{{ $texto }}" aria-label="Recipient´s username" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-plus-circle-fill"></i></span>
                                        <a href="{{ route('producto.create') }}" class="btn btn-success">Nuevo</a>
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
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $prod)
                                <tr>
                                    <td>
                                        <a href="{{ route('producto.edit', $prod->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $prod->id }}"><i class="fas fa-trash-alt"></i>
                                    </td>
                                    <td>{{ $prod->codigo }}</td>
                                    <td>{{ $prod->nombre }}</td>
                                    <td>{{ $prod->descripcion }}</td>
                                    <td>{{ $prod->stock }}</td>
                                    <td>
                                        <!-- Mostrar la imagen con la ruta correcta -->
                                        <img src="{{ asset('/' . $prod->imagen) }}" alt="{{ $prod->nombre }}" style="width: 50px; height: auto;">
                                    </td>
                                    <td>{{ $prod->estatus }}</td>
                                </tr>
                                @include('almacen.producto.modal')
                                @endforeach
                            </tbody>
                        </table>
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
