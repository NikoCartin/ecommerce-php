<?php
/**
 * Funciones Auxiliares
 * 
 * Este archivo contiene funciones comunes utilizadas en toda la aplicación.
 * 
 * @author Nícolas Cartín Reyes
 * @email nicolascartinreyes@gmail.com
 * @version 1.0
 */

require_once __DIR__ . '/../config/config.php';

/**
 * Inicializa la sesión si no está activa
 */
function iniciarSesion() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Obtiene conexión a la base de datos usando mysqli
 * @return mysqli|null Conexión a la base de datos o null en caso de error
 */
function obtenerConexion() {
    try {
        return getMysqliConnection();
    } catch (Exception $e) {
        manejarError("Error de conexión: " . $e->getMessage());
        return null;
    }
}

/**
 * Maneja errores de la aplicación
 * @param string $mensaje Mensaje de error
 * @param bool $mostrarUsuario Si mostrar el error al usuario
 */
function manejarError($mensaje, $mostrarUsuario = false) {
    error_log($mensaje);
    
    if ($mostrarUsuario || DEBUG_MODE) {
        echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($mensaje) . '</div>';
    } else {
        echo '<div class="alert alert-danger">Ocurrió un error, por favor intente de nuevo.</div>';
    }
}

/**
 * Sanitiza entrada de usuario
 * @param string $input Entrada del usuario
 * @return string Entrada sanitizada
 */
function sanitizarEntrada($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Valida email
 * @param string $email Email a validar
 * @return bool True si es válido
 */
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Formatea precio para mostrar
 * @param float $precio Precio a formatear
 * @return string Precio formateado
 */
function formatearPrecio($precio) {
    return '$' . number_format($precio, 2);
}

/**
 * Redirige a una página
 * @param string $url URL de destino
 */
function redirigir($url) {
    header("Location: $url");
    exit();
}

/**
 * Verifica si el carrito está vacío
 * @return bool True si está vacío
 */
function carritoVacio() {
    iniciarSesion();
    return empty($_SESSION['carrito']);
}

/**
 * Obtiene el total de items en el carrito
 * @return int Número de items
 */
function contarItemsCarrito() {
    iniciarSesion();
    if (carritoVacio()) {
        return 0;
    }
    
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['cantidad'];
    }
    return $total;
}

/**
 * Calcula el total del carrito
 * @return float Total del carrito
 */
function calcularTotalCarrito() {
    iniciarSesion();
    if (carritoVacio()) {
        return 0;
    }
    
    $total = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
}

/**
 * Genera un token CSRF
 * @return string Token CSRF
 */
function generarTokenCSRF() {
    iniciarSesion();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verifica token CSRF
 * @param string $token Token a verificar
 * @return bool True si es válido
 */
function verificarTokenCSRF($token) {
    iniciarSesion();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Registra actividad del usuario
 * @param string $actividad Descripción de la actividad
 */
function registrarActividad($actividad) {
    $log = date('Y-m-d H:i:s') . " - " . $actividad . PHP_EOL;
    file_put_contents(__DIR__ . '/../logs/actividad.log', $log, FILE_APPEND | LOCK_EX);
}
?>
