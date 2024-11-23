@extends('adminlte::page')

@section('title', 'Editar Proveedores')

@section('content_header')
    <div class="card-header">
        <h1>Editar Proveedor: {{ $proveedor->nombre }}</h1>
    </div>
@endsection

@section('content')
<div class="col-md-6">

    <form action="{{ route('proveedor.update', $proveedor->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Ingresa el nombre del proveedor" value="{{ old('nombre', $proveedor->nombre) }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_documento">Tipo Documento</label>
                <select name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror" id="tipo_documento">
                    <option value="RFC" {{ old('tipo_documento', $proveedor->tipo_documento) == 'RFC' ? 'selected' : '' }}>RFC</option>
                    <option value="INE" {{ old('tipo_documento', $proveedor->tipo_documento) == 'INE' ? 'selected' : '' }}>INE</option>
                </select>
                @error('tipo_documento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="num_documento">Número Documento</label>
                <input type="text" class="form-control @error('num_documento') is-invalid @enderror" name="num_documento" id="num_documento" placeholder="Ingresa el número del documento" value="{{ old('num_documento', $proveedor->num_documento) }}">
                @error('num_documento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" id="direccion" placeholder="Ingresa la dirección" value="{{ old('direccion', $proveedor->direccion) }}">
                @error('direccion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Ingresa el correo" value="{{ old('email', $proveedor->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" placeholder="Ingresa el teléfono" value="{{ old('telefono', $proveedor->telefono) }}">
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
            <a href="{{ route('proveedor.index') }}" class="btn btn-danger me-1 mb-1">Cancelar</a>
        </div>
    </form>
</div>
@endsection
