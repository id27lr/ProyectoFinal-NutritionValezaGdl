@extends('adminlte::page')

@section('content_header')
    <div class="card-header">
        <h1>Editar producto</h1>
    </div>
@endsection

@section('content')

<div class="col-md-6">

    <form action="{{ route('producto.update', $producto->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Indica que el método de la solicitud es PUT para la actualización -->
        
        <div class="card-body">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" placeholder="Ingresa el nombre del producto">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoría</label>
                <select name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror" id="id_categoria">
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $producto->id_categoria ? 'selected' : '' }}>{{ $cat->categoria }}</option>
                    @endforeach
                </select>
                @error('id_categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo" value="{{ old('codigo', $producto->codigo) }}" placeholder="Ingresa el código del producto">
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}" placeholder="Ingresa el stock del producto">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" placeholder="Ingresa la descripción del producto">
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mostrar la imagen actual -->
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" id="imagen">
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Mostrar imagen actual -->
                @if ($producto->imagen)
                    <div class="mt-2">
                        <strong>Imagen actual:</strong>
                        <img src="{{ asset('/' . $producto->imagen) }}" alt="Imagen del producto" class="img-fluid" style="max-width: 200px;">
                    </div>
                @endif
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
            <a href="{{ route('producto.index') }}" class="btn btn-danger me-1 mb-1">Cancelar</a>
        </div>
    </form>
</div>

@endsection
