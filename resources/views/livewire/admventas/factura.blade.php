<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Factura - {{ $venta->id }}</title>
    <style>
        /* Estilos CSS para la factura */
        /* ... */
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura</h1>
        <p>Número de venta: {{ $venta->id }}</p>
        <p>Fecha: {{ $venta->created_at }}</p>
    </div>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>Codigo de venta</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
               
                  <td>{{ $venta->codigo }}</td>
                  @foreach (json_decode($venta->cant, true) as $producto)
                    <tr>
                        <td>{{$producto['id_producto'] }}</td>
                        <td>{{ $producto['cantidad_vendida'] }}</td>
                        <td>{{ $producto['precio'] }}</td>
                        <td>{{ $producto['total'] }}</td>
                    </tr>
                @endforeach
              
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total:</th>
                    <td>{{ $total }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>