<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/NikoTech.jpg" type="image/x-icon">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-3">Catálogo de Productos</h1>
                <p class="lead text-muted">Descubre nuestra selección de productos de calidad</p>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($productos)): ?>
                <?php foreach($productos as $producto): ?>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text text-muted"><?php echo htmlspecialchars($producto['detalle']); ?></p>
                            </div>
                            <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                                <strong class="text-success"><?php echo formatearPrecio($producto['precio']); ?></strong>
                                <form action="agregar_carrito.php" method="post" class="add-to-cart-form" style="margin:0;">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto['codigo']; ?>">
                                    <input type="hidden" name="cantidad" value="1">
                                    <input type="hidden" name="csrf_token" value="<?php echo generarTokenCSRF(); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Agregar al carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <h4>No hay productos disponibles</h4>
                        <p>Actualmente no tenemos productos en nuestro catálogo.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="carrito.php" class="btn btn-success">Ver Carrito</a>
            <a href="consulta.php" class="btn btn-info">Consulta</a>
        </div>
        <?php if (isset($_GET['error_cantidad'])): ?>
            <div class="alert alert-danger mt-3 text-center">La cantidad debe ser mayor a cero.</div>
        <?php endif; ?>
    </div>
    <script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let cantidad = prompt("¿Cuántas unidades desea agregar?", "1");
            if (cantidad !== null && !isNaN(cantidad) && cantidad > 0 && Number.isInteger(Number(cantidad))) {
                this.querySelector('input[name="cantidad"]').value = cantidad;
                this.submit();
            } else {
                alert("Ingrese una cantidad válida (entero positivo).");
            }
        });
    });
    </script>
    <?php if (isset($_GET['agregado'])): ?>
    <script>
        window.onload = function() {
            alert("¡Producto agregado al carrito!");
        };
    </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>