<?php
session_start();
require_once 'funciones.php';

function validar_telefono($telefono) {
    return preg_match('/^[0-9\-\+\s\(\)]+$/', $telefono);
}
function validar_correo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $detalle = trim($_POST['detalle']);

    if (empty($nombre) || empty($telefono) || empty($correo) || empty($detalle)) {
        manejar_error("Campos vacíos en el formulario de consulta.");
        header("Location: consulta.php?error=1");
        exit;
    }
    if (!validar_telefono($telefono)) {
        manejar_error("Teléfono inválido en consulta: $telefono");
        header("Location: consulta.php?error=1");
        exit;
    }
    if (!validar_correo($correo)) {
        manejar_error("Correo inválido en consulta: $correo");
        header("Location: consulta.php?error=1");
        exit;
    }

    $conexion = obtenerConexion();
    if (!$conexion) exit;

    $stmt = $conexion->prepare("INSERT INTO consultas (nombre, telefono, correo, detalle) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        manejar_error("Error al preparar la consulta SQL: " . $conexion->error);
        header("Location: consulta.php?error=1");
        exit;
    }
    $stmt->bind_param("ssss", $nombre, $telefono, $correo, $detalle);
    if (!$stmt->execute()) {
        manejar_error("Error al ejecutar la consulta SQL: " . $stmt->error);
        header("Location: consulta.php?error=1");
        exit;
    }
    $stmt->close();
    $conexion->close();

    header("Location: consulta.php?exito=1");
    exit;
} else {
    manejar_error("Acceso no permitido a procesar_consulta.php");
    header("Location: consulta.php?error=1");
    exit;
}