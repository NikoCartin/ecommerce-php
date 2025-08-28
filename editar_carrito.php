<?php
session_start();

if (isset($_POST['codigo']) && isset($_POST['accion'])) {
    $codigo = $_POST['codigo'];
    $accion = $_POST['accion'];

    if (!isset($_SESSION['carrito'])) {
        header("Location: carrito.php");
        exit;
    }

    foreach ($_SESSION['carrito'] as $idx => $producto) {
        if ($producto['codigo'] == $codigo) {
            if ($accion == "actualizar" && isset($_POST['cantidad'])) {
                $cantidad = intval($_POST['cantidad']);
                if ($cantidad > 0) {
                    $_SESSION['carrito'][$idx]['cantidad'] = $cantidad;
                }
            } elseif ($accion == "eliminar") {
                array_splice($_SESSION['carrito'], $idx, 1);
            }
            break;
        }
    }
}
header("Location: carrito.php");
exit;