<?php
session_start();
require_once 'funciones.php';

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total_productos = 0;
foreach ($carrito as $producto) {
    $total_productos += $producto['precio'] * (isset($producto['cantidad']) ? intval($producto['cantidad']) : 1);
}
if (!$carrito || count($carrito) == 0) {
    manejar_error("Intento de finalizar compra con carrito vacío.");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navmenu.php'; ?>
<div class="container py-5">
    <h2 class="mb-4">Información para el envío</h2>
    <form action="procesar_compra.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo:</label>
            <input type="text" name="nombre" required class="form-control" id="nombre">
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico:</label>
            <input type="email" name="correo" required class="form-control" id="correo">
        </div>
        <div class="mb-3">
            <label for="celular" class="form-label">Celular:</label>
            <input type="text" name="celular" required class="form-control" id="celular">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de envío:</label>
            <textarea name="direccion" required class="form-control" id="direccion"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Método de envío:</label>
            <select name="envio" class="form-select" required onchange="calcularEnvio()">
                <option value="GAM">Dentro de la GAM (Envío gratuito)</option>
                <option value="FueraGAM">Fuera de la GAM (Correos de Costa Rica, ₡5000/$10)</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Costo de envío:</label>
            <input type="text" id="precio_envio" class="form-control" value="$0" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Total a pagar:</label>
            <input type="text" id="total_final" class="form-control" value="$<?php echo number_format($total_productos, 2); ?>" readonly>
        </div>
        <button type="submit" class="btn btn-success">Confirmar compra</button>
    </form>
    <div class="mt-4">
        <a href="carrito.php" class="btn btn-secondary">Volver al carrito</a>
    </div>
</div>
<script>
    let total = <?php echo $total_productos; ?>;
    function calcularEnvio() {
        let envio = document.querySelector('select[name="envio"]').value;
        let precioEnvio = envio === "GAM" ? 0 : 10;
        document.getElementById("precio_envio").value = "$" + precioEnvio;
        document.getElementById("total_final").value = "$" + (total + precioEnvio).toLocaleString('en');
    }
    document.querySelector('select[name="envio"]').addEventListener('change', calcularEnvio);
    calcularEnvio();
</script>
</body>
</html>