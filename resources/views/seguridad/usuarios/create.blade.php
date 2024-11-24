@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
<div class="card-header">
    <h1>Nuevo Usuario</h1>
</div>
@endsection

@section('content')
<div class="col-md-6">
    <form action="{{ route('usuarios.store') }}" method="POST" class="form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Ingresa el nombre del usuario" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Ingresa el email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Ingresa la contraseña">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirma la contraseña">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
            </div>
        </div>
    </form>
</div>
@endsection