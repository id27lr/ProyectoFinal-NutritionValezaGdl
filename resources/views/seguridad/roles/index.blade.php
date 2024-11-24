@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">LISTADO DE ROLES</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Roles</li>
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
                        <form action="{{ route('roles.index') }}" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" name="texto" placeholder="Buscar usuarios" value="{{ $texto }}">
                                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
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
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $usu)
                                <tr>
                                    <td>{{ $usu->id }}</td>
                                    <td>{{ $usu->name }}</td>
                                    <td>
                                        <form action="{{ route('seguridad.roles.update', $usu->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="form-control" onchange="this.form.submit()">
                                                <option value="admin" {{ $usu->hasRole('admin') ? 'selected' : '' }}>Administrador</option>
                                                <option value="user" {{ $usu->hasRole('user') ? 'selected' : '' }}>Usuario</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @include('seguridad.usuarios.modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection