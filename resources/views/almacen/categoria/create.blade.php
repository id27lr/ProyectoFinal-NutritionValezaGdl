@extends('adminlte::page')

@section('title', 'Crear Categorías')

@section('content_header')
    <div class="card-header">
        <h1>Nueva Categoria</h1>
    </div>
@endsection

@section('content')
    <div class="col-md-6">
        <form action="{{ route('categoria.store') }}" method="POST" class="form">
        @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="categoria">Nombre</label>
                    <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Ingresa el nombre de la categoria">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresa la descripcion">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                    <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                </div>
        </form>
    </div>
@endsection