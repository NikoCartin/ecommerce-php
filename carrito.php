<?php
session_start();
require_once 'funciones.php';

// Vaciar el carrito si el usuario lo solicita
if (isset($_POST['vaciar_carrito'])) {
    unset($_SESSION['carrito']);
    header("Location: carrito.php");
    exit;
}

// Inicializar el carrito desde la sesión
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total = 0;
foreach ($carrito as $producto) {
    $total += $producto['precio'] * (isset($producto['cantidad']) ? intval($producto['cantidad']) : 1);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navmenu.php'; ?>
    <div class="container py-4">
        <h1 class="mb-4 text-center">Carrito de Compras</h1>
        <?php if (count($carrito) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($carrito as $idx => $producto): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($producto['imagen']); ?>" width="80"></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['detalle']); ?></td>
                            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                            <!-- Formulario para editar cantidad o eliminar producto -->
                            <form method="post" action="editar_carrito.php">
                                <td>
                                    <input type="number" name="cantidad" min="1" value="<?php echo intval($producto['cantidad']); ?>" style="width:60px;">
                                    <input type="hidden" name="codigo" value="<?php echo $producto['codigo']; ?>">
                                </td>
                                <td>$<?php echo number_format($producto['precio'] * intval($producto['cantidad']), 2); ?></td>
                                <td>
                                    <button type="submit" name="accion" value="actualizar" class="btn btn-sm btn-primary">Actualizar</button>
                                    <button type="submit" name="accion" value="eliminar" class="btn btn-sm btn-danger">Eliminar</button>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="text-end">Total: $<?php echo number_format($total, 2); ?></h4>
            <form method="post">
                <button type="submit" name="vaciar_carrito" class="btn btn-danger">Vaciar Carrito</button>
            </form>
            <!-- Botón para finalizar compra lleva al formulario de datos del cliente -->
            <form method="post" action="datos_cliente.php" class="mt-2">
                <button type="submit" class="btn btn-primary">Finalizar compra</button>
            </form>
        <?php else: ?>
            <div class="alert alert-info text-center">El carrito está vacío.</div>
        <?php endif; ?>
        <div class="mt-4 text-center">
            <a href="productos.php" class="btn btn-secondary">Volver a la galería</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>