@extends('adminlte::page')
@extends('layouts.app')

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
                        <label for="proveedor">Productos</label>
                        <select name="id_proveedor" class="form-control @error('id_producto') is-invalid @enderror" id="id_producto">
                            @foreach($productos as $producto)
                            <option value="{{$producto->id}}">{{$producto->Producto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
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
                        <label for="accion">Acción</label>
                        <button type="button" id="btn_add" class="btn btn-block btn-outline-success">Agregar</button>
                    </div>
                </div> 

                <div class="col-12">
                    <div class="table-responsive">
                        <table  id="detalles" class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>TOTAL</th>
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
            datosProducto = document.getElementById('id_producto').value.split('_');
            $("#cantidad").val(datosProducto[1]);
        }
        
        function agregar(){
        
            datosProducto = document.getElementById('id_producto').value.split('_');
            id_producto = datosProducto[0];
            producto = $("#id_producto option:selected").text();
            
            cantidad = $("#cantidad").val();
            precio_compra = $("#precio_compra").val();
            precio_venta = $("#precio_venta").val();
            
            if (id_producto != "" && cantidad != "" && cantidad > 0 && precio_compra != "" && precio_venta != ""){
            
                subtotal[cont] = precio_compra * cantidad;
                total = total + subtotal[cont];
            
                var fila = '<tr class="selected" id="fila' + cont + 
                            '"> <td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + 
                                ')";>X</button></td><td><input type="hidden" name="id_producto[]" value="' + id_producto + '">' + producto +
                                    '</td><td><input type="number" name="cantidad[]" value="' + cantidad +
                                        '"></td> <td><input type="number" name="precio_compra[]" value="' + precio_compra +
                                            '"></td> <td> <input type="number" name="precio_venta[]" value="' + precio_venta +
                                                '"</td><td>' + subtotal[cont] + '</td></tr>';
                cont++;
                limpiar();
                $("#total").html("$:" + total);
                evaluar();
                $("#detalles").append(fila);
        
            }else{
                alert("Error al ingresar los datos del artículo");
            }

        }

        function limpiar(){
            $("#cantidad").val("");
            $("#precio_compra").val("");
            $("#precio_venta").val("");
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
            $("#total").html("$: " + total);
            $("#fila" + index).remove();
        }
    </script>
@endpush

@endsection