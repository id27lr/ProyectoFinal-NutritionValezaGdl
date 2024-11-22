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
                            <option value="{{$persona->id}}">{{$persona->nombre}}</option>
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

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="proveedor">Productos</label>
                        <select name="id_proveedor" class="form-control @error('id_productos') is-invalid @enderror" id="id_productos">
                            @foreach($productos as $producto)
                            <option value="{{$producto->id}}">{{$producto->Producto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="Cantidad">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="pcompra">P. Compra</label>
                        <input type="number" class="form-control" name="precio_compra" id="precio_compra" step="0.01" min="0" placeholder="P. Compra">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="pventa">P. Venta</label>
                        <input type="number" class="form-control" name="precio_venta" id="precio_venta" step="0.01" min="0" placeholder="P. Venta">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="proveedor">Acción</label>
                        <button type="button" id="btn_add" class="btn btn-success me-1 mb-1"></button>
                    </div>
                </div> 

                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subotal</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$ 0.00</h4></th>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-footer">
                    <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                    <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                </div>
            </div>

    </form>
</div>
@endsection