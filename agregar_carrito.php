<?php
/**
 * Agregar Producto al Carrito
 * 
 * Procesa la adición de productos al carrito de compras
 */

require_once 'includes/functions.php';

iniciarSesion();

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    manejarError("Método no permitido");
    redirigir('productos.php?error=metodo');
}

// Verificar token CSRF
if (!isset($_POST['csrf_token']) || !verificarTokenCSRF($_POST['csrf_token'])) {
    manejarError("Token de seguridad inválido");
    redirigir('productos.php?error=token');
}

// Validar datos recibidos
if (!isset($_POST['id_producto']) || !isset($_POST['cantidad'])) {
    manejarError("Datos incompletos");
    redirigir('productos.php?error=datos');
}

$idProducto = filter_var($_POST['id_producto'], FILTER_VALIDATE_INT);
$cantidad = filter_var($_POST['cantidad'], FILTER_VALIDATE_INT);

// Validar cantidad
if (!$cantidad || $cantidad <= 0 || $cantidad > 100) {
    manejarError("Cantidad inválida");
    redirigir('productos.php?error=cantidad');
}

// Obtener producto de la base de datos
$conexion = obtenerConexion();
if (!$conexion) {
    manejarError("Error de conexión");
    redirigir('productos.php?error=conexion');
}

$stmt = $conexion->prepare("SELECT * FROM productos WHERE codigo = ? LIMIT 1");
$stmt->bind_param("i", $idProducto);
$stmt->execute();
$resultado = $stmt->get_result();

if ($producto = $resultado->fetch_assoc()) {
    // Inicializar carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    // Buscar si el producto ya está en el carrito
    $encontrado = false;
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['codigo'] == $producto['codigo']) {
            $item['cantidad'] += $cantidad;
            $encontrado = true;
            registrarActividad("Cantidad actualizada en carrito: Producto {$producto['nombre']}, nueva cantidad: {$item['cantidad']}");
            break;
        }
    }
    unset($item);
    
    // Si no está en el carrito, agregarlo
    if (!$encontrado) {
        $producto['cantidad'] = $cantidad;
        $_SESSION['carrito'][] = $producto;
        registrarActividad("Producto agregado al carrito: {$producto['nombre']}, cantidad: $cantidad");
    }
    
    $stmt->close();
    $conexion->close();
    
    redirigir('productos.php?agregado=1');
} else {
    $stmt->close();
    $conexion->close();
    manejarError("Producto no encontrado");
    redirigir('productos.php?error=producto');
}
exit;