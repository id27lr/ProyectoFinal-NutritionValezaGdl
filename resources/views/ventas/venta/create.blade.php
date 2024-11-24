@extends('adminlte::page')
@extends('layouts.app')

@section('title', 'Nueva Venta')

@section('content_header')
<div class="card-header">
    <h1>Nueva Venta</h1>
</div>
@endsection

@section('content')
<div class="card card-primary">
    <form action="{{ route('venta.store') }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select name="id_cliente" class="form-control @error('id_proveedor') is-invalid @enderror" id="id_cliente">
                            @foreach($personas as $persona)
                            <option value="{{$persona->id}}">{{$persona->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="comprobante">Tipo Documento</label>
                        <select name="comprobante" class="form-control @error('comprobante') is-invalid @enderror" id="comprobante">
                            <option value="RFC" {{ old('comprobante') == 'RFC' ? 'selected' : '' }}>RFC</option>
                            <option value="INE" {{ old('comprobante') == 'INE' ? 'selected' : '' }}>INE</option>
                        </select>
                        @error('comprobante')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="num_comprobante">Número Documento</label>
                        <input type="text" class="form-control @error('num_comprobante') is-invalid @enderror" name="num_comprobante" id="num_comprobante" placeholder="Ingresa el número del documento" value="{{ old('num_comprobante') }}">
                        @error('num_comprobante')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="producto">Productos</label>
                        <select name="id_articulo" class="form-control @error('id_articulo') is-invalid @enderror" id="id_articulo">
                            @foreach($productos as $producto)
                            <option value="{{$producto->id}}">{{$producto->Producto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="Cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="Cantidad">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="pcompra">Stock</label>
                        <input type="number" disabled class="form-control" name="pstock" id="pstock" placeholder="Stock">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="pventa">P. Venta</label>
                        <input type="number" class="form-control" name="pprecio_venta" id="pprecio_venta" step="0.01" min="0" placeholder="Precio Venta">
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <label for="descuento">Descuento</label>
                        <input type="number" class="form-control" name="pdescuento" id="pdescuento" step="0.01" min="0" placeholder="Descuento" value="0">
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <label for="accion">Accion</label>
                        <button type="button" id="btn_add" class="btn btn-block btn-outline-success">Agregar</button>
                    </div>
                </div> 

                <div class="col-12">
                    <div class="table-responsive">
                        <table id="detalles" class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <div class="card-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                        <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@push('scipts')
    <script>
        $(document).ready(function(){
            $("#btn_add").click(function(){
                agregar();
            });
        });

        var cont = 0;
        total = 0;
        subtotal = [];

        $("#guardar").hide();
        $("#id_producto").change(mostrarValores);

        function mostrarValores(){
            datosArticulo = document.getElementById('id_articulo').value.split('_');
            $("#pprecio_venta").val(datosArticulo[2]);
            $("#pstock").val(datosArticulo[1]);
        }

        function agregar(){
            datosArticulo = document.getElementById('id_articulo').value.split('_');

            id_articulo = datosArticulo[0];
            articulo = $("#id_articulo option:selected").text();
            cantidad = $("#pcantidad").val();
            descuento = $("#pdescuento").val();
            precio_venta = $("#pprecio_venta").val();
            stock = parseInt($("#pstock").val());
            unidad = datosArticulo[3];

            if (id_articulo != "" && cantidad != "" && cantidad > 0 && descuento != "" && precio_venta != ""){

                console.log(cantidad);
                console.log(stock);
                console.log(unidad);
                if(unidad == 'kilos'){
                    cantidadFinal = cantidad / 1000;
                } else {
                    cantidadFinal = cantidad;
                }

                if (cantidadFinal <= stock){
                    subtotal[cont] = (cantidadFinal * precio_venta) - descuento;
                    total = total + subtotal[cont];

                    var fila = '<tr class="selected" id="fila' + cont + '">'
                            + '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td>'
                            + '<td><input type="hidden" name="id_articulo[]" value="' + id_articulo + '">' + articulo + '</td>'
                            + '<td><input type="number" name="cantidad[]" value="' + cantidadFinal + '"></td>'
                            + '<td><input type="number" name="precio_venta[]" value="' + precio_venta + '"></td>'
                            + '<td><input type="number" name="descuento[]" value="' + descuento + '"></td>'
                            + '<td>' + subtotal[cont] + '</td>'
                            + '</tr>';

                    cont++;
                    limpiar();
                    $("#total").html("$ " + total);
                    $("#total_venta").html("$ " + total);
                    evaluar();
                    $("#detalles").append(fila);
                } else {
                    alert('La cantidad a vender supera el stock');
                }

            } else {
                alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
            }
        }

        function limpiar(){
            $("#pcantidad").val("");
            $("#pdescuento").val("");
            $("#pprecio_venta").val("");
        }

        function evaluar(){
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").show();
            }
        }

        function eliminar(index){
            total = total - subtotal[index];
            $("#total").html("$ " + total);
            $("#total_venta").val(total);
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
@endpush

@endsection
