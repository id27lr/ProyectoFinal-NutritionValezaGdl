@extends('adminlte::page')

@section('content_header')
    <div class="card-header">
        <h1>Nuevo Ingreso</h1>
    </div>
@endsection

@section('content')
<div class="card card-primary">
    <form action="{{ route('ingreso.store') }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <select name="id_proveedor" class="form-control @error('id_proveedor') is-invalid @enderror" id="id_proveedor">
                            @foreach($personas as $persona)
                                <option value="{{$persona->id}}"{{$persona->nombre}}</option>
                            @endforeach
                        </select>    
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="tipo_documento">Tipo Documento</label>
                        <select name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror" id="tipo_documento">
                            <option value="RFC" {{ old('tipo_documento') == 'RFC' ? 'selected' : '' }}>RFC</option>
                            <option value="INE" {{ old('tipo_documento') == 'INE' ? 'selected' : '' }}>INE</option>
                        </select>
                        @error('tipo_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="num_documento">Número Documento</label>
                        <input type="text" class="form-control @error('num_documento') is-invalid @enderror" name="num_documento" id="num_documento" placeholder="Ingresa el número del documento" value="{{ old('num_documento') }}">
                        @error('num_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endsection
