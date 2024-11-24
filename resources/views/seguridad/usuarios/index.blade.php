@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LISTADO DE USUARIOS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section class="section">
    <div class="row" id="table-hover-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12">
                        <form action="{{ route('usuarios.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" name="texto" placeholder="Buscar usuarios" value="{{ $texto }}">
                                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-plus-circle-fill"></i></span>
                                        <a href="{{ route('usuarios.create') }}" class="btn btn-success">Nuevo</a>
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
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usu)
                                <tr>
                                    <td>
                                        <a href="{{ route('usuarios.edit', $usu->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $usu->id }}"><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    <td>{{ $usu->id }}</td>
                                    <td>{{ $usu->name }}</td>
                                    <td>{{ $usu->email }}</td>
                                </tr>
                                @include('seguridad.usuarios.modal')
                                @endforeach
                            </tbody>
                        </table>
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
