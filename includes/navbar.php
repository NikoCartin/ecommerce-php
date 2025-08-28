<?php
/**
 * Barra de Navegación
 * 
 * Componente de navegación común para todas las páginas
 */

require_once __DIR__ . '/functions.php';
iniciarSesion();

$itemsCarrito = contarItemsCarrito();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="assets/images/NikoTech.jpg" alt="NikoTech Logo" height="50" class="me-2" style="width:auto;">
      <?php echo APP_NAME; ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="productos.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="carrito.php">
            Carrito
            <?php if ($itemsCarrito > 0): ?>
              <span class="badge bg-danger"><?php echo $itemsCarrito; ?></span>
            <?php endif; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="consulta.php">Consultas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
