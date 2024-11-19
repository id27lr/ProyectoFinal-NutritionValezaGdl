@extends('adminlte::page')

@section('content_header')
    <div class="card-header">
        <h1>Editar Categoria {{ $categoria->categoria}}</h1>
    </div>
@endsection

@section('content')

    <div class="col-md-6">
        <form action="{{ route('categoria.update', $categoria->id) }}" method="POST" class="form">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="categoria">Nombre</label>
                    <input type="text" class="form-control" name="categoria" id="categoria" value="{{$categoria->categoria}}" placeholder="Ingresa el nombre de la categoria">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{$categoria->descripcion}}" placeholder="Ingresa la descripcion">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                    <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                </div>
        </form>
    </div>

@endsection