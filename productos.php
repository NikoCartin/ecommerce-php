<?php
/**
 * Controlador de Productos
 * 
 * Maneja la lógica para mostrar el catálogo de productos
 */

require_once 'includes/functions.php';

iniciarSesion();

$conexion = obtenerConexion();
if (!$conexion) {
    manejarError("No se pudo conectar a la base de datos");
    exit();
}

$sql = "SELECT * FROM productos ORDER BY nombre ASC";
$resultado = $conexion->query($sql);

$productos = [];
if ($resultado && $resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $productos[] = $row;
    }
}

$conexion->close();

include 'vista_productos.php';
