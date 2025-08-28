<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navmenu.php'; ?>
    <div class="container py-5">
        <h2 class="mb-4">Formulario de Consultas</h2>
        <?php if (isset($_GET['exito'])): ?>
            <div class="alert alert-success">¡Consulta enviada correctamente!</div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Ocurrió un error al enviar la consulta. Por favor, intente de nuevo.</div>
        <?php endif; ?>
        <form action="procesar_consulta.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" required class="form-control" id="nombre">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" required class="form-control" id="telefono">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" name="correo" required class="form-control" id="correo">
            </div>
            <div class="mb-3">
                <label for="detalle" class="form-label">Detalle de la consulta:</label>
                <textarea name="detalle" required class="form-control" id="detalle"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Consulta</button>
        </form>
    </div>
</body>
</html>