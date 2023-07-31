<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos CSS para la factura */
        /* ... */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/images/brand/sercolf.png') }}" >
            <h1>Factura de Venta</h1>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosVendidos as $producto)
                        <tr>
                            <td>{{ $producto['titulo'] }}</td>
                            <td>{{ $producto['cantidad_vendida'] }}</td>
                            <td>{{ $producto['precio'] }}</td>
                            <td>{{ $producto['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total:</th>
                        <td>{{ $venta->total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>
