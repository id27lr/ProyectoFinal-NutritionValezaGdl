@extends('adminlte::page')

@section('content_header')
<div class="col-md-6">
    <div class="card-header">
        <h3 class="card-title">Nuevo producto</h3>
    </div>

    <form action="{{ route('producto.store') }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Ingresa el nombre del producto" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoría</label>
                <select name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror" id="id_categoria">
                    @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}" {{ old('id_categoria') == $cat->id ? 'selected' : '' }}>{{ $cat->categoria }}</option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo" placeholder="Ingresa el código del producto" value="{{ old('codigo') }}">
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Ingresa el stock del producto" value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" placeholder="Ingresa la descripción del producto" value="{{ old('descripcion') }}">
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
            <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
        </div>
    </form>
</div>

@endsection
