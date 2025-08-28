<?php
session_start();
require_once 'funciones.php';

function validar_correo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}
function validar_celular($celular) {
    return preg_match('/^[0-9\-\+\s\(\)]+$/', $celular);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $celular = trim($_POST['celular']);
    $direccion = trim($_POST['direccion']);
    $envio = $_POST['envio'];

    if (empty($nombre) || empty($correo) || empty($celular) || empty($direccion) || empty($envio)) {
        manejar_error("Campos vacíos en formulario de compra.");
        exit;
    }
    if (!validar_correo($correo)) {
        manejar_error("Correo electrónico inválido al procesar compra: $correo");
        exit;
    }
    if (!validar_celular($celular)) {
        manejar_error("Celular inválido al procesar compra: $celular");
        exit;
    }

    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    if (!$carrito || count($carrito) == 0) {
        manejar_error("Intento de finalizar compra con carrito vacío.");
        exit;
    }

    $total_productos = 0;
    foreach ($carrito as $producto) {
        $total_productos += $producto['precio'] * intval($producto['cantidad']);
    }
    $precio_envio = ($envio === "GAM") ? 0 : 10; // Envío en dólares
    $total_final = $total_productos + $precio_envio;
    $texto_envio = ($envio === "GAM") ? "Dentro de la GAM (Envío gratuito)" : "Fuera de la GAM (Correos de Costa Rica, $10)";

    // Guardar la orden en la base de datos
    $conexion = obtenerConexion();
    if (!$conexion) exit;

    $stmt = $conexion->prepare(
        "INSERT INTO ordenes (nombre, correo, celular, direccion, metodo_envio, precio_envio, total_productos, total_final)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssiis", $nombre, $correo, $celular, $direccion, $texto_envio, $precio_envio, $total_productos, $total_final);
    if ($stmt->execute()) {
        $orden_id = $stmt->insert_id;
        $stmt->close();

        $detalle_stmt = $conexion->prepare(
            "INSERT INTO orden_detalle (orden_id, producto_codigo, producto_nombre, producto_detalle, producto_precio, cantidad, subtotal)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        foreach ($carrito as $producto) {
            $subtotal = $producto['precio'] * intval($producto['cantidad']);
            $detalle_stmt->bind_param(
                "iissiii", $orden_id, $producto['codigo'], $producto['nombre'],
                $producto['detalle'], $producto['precio'], $producto['cantidad'], $subtotal
            );
            $detalle_stmt->execute();
        }
        $detalle_stmt->close();
    } else {
        manejar_error("Error al guardar la orden: " . $stmt->error);
    }
    $conexion->close();

} else {
    manejar_error("Acceso no permitido a procesar_compra.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra finalizada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navmenu.php'; ?>
<div class="container py-5">
    <h2>¡Compra finalizada con éxito!</h2>
    <h4>Datos del cliente</h4>
    <ul>
        <li><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></li>
        <li><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></li>
        <li><strong>Celular:</strong> <?php echo htmlspecialchars($celular); ?></li>
        <li><strong>Dirección:</strong> <?php echo htmlspecialchars($direccion); ?></li>
        <li><strong>Método de envío:</strong> <?php echo $texto_envio; ?></li>
    </ul>
    <div class="alert alert-info my-4">
        Recibirás un enlace a tu correo electrónico con el link de pago para que hagas el pago de forma segura.<br>
        Una vez que recibamos la confirmación, el envío se agendará y se te notificará por mensaje de texto.
    </div>
    <h4>Artículos comprados</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Detalle</th>
                <th>Precio ($)</th>
                <th>Cantidad</th>
                <th>Subtotal ($)</th>
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
    <h5>Costo de envío: $<?php echo number_format($precio_envio,2); ?></h5>
    <h4 class="text-end">Monto total: $<?php echo number_format($total_final,2); ?></h4>
    <a href="productos.php" class="btn btn-success">Volver a la tienda</a>
</div>
</body>
</html>
<?php
// Vacía el carrito al finalizar la compra
unset($_SESSION['carrito']);
?>