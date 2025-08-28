<?php
session_start();
require_once 'funciones.php';

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
if (!$carrito || count($carrito) == 0) {
    manejar_error("Intento de finalizar compra con carrito vacío.");
    exit;
}

$total = 0;
foreach ($carrito as $producto) {
    $total += $producto['precio'] * (isset($producto['cantidad']) ? intval($producto['cantidad']) : 1);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h2>¡Compra finalizada con éxito!</h2>
        <p>Estos son los artículos que compraste:</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($carrito as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['detalle']); ?></td>
                    <td>$<?php echo number_format($producto['precio'],2); ?></td>
                    <td><?php echo intval($producto['cantidad']); ?></td>
                    <td>$<?php echo number_format($producto['precio']*intval($producto['cantidad']),2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 class="text-end">Monto total: $<?php echo number_format($total,2); ?></h4>
        <a href="productos.php" class="btn btn-success">Volver a la tienda</a>
    </div>
</body>
</html>
<?php
unset($_SESSION['carrito']);
?>