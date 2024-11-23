@extends('adminlte::page')
@extends('layouts.app')

@section('content_header')
<div class="card-header">
    <h1>Detalle Ingreso</h1>
</div>
@endsection

@section('content')
<div class="card card-primary">
   
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <p>{{$ingreso->nombre}}</p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="comprobante">Tipo Documento</label>
                        <p>{{$ingreso->comprobante}}</p>
                        @error('comprobante')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="num_comprobante">Número Documento</label>
                        <p>{{$ingreso->num_comprobante}}</p>
                        @error('num_comprobante')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table  id="detalles" class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total:</th>
                                <th><h4 id="total">$ {{number_format($ingreso->total, 2)}}</h4></th>
                            </tfoot>
                            <tbody>
                                @foreach($detalles as $det)
                                    <tr>
                                        <td>{{$det->producto}}</td>
                                        <td>{{$det->cantidad}}</td>
                                        <td>{{$det->precio_compra}}</td>
                                        <td>{{$det->precio_venta}}</td>
                                        <td>{{number_format($det->cantidad * $det->precio_compra, 2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>

@endsection