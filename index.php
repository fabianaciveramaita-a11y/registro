<?php include("verificarsesion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sistema de Préstamos - Inicio</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<style>
  body {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  .container {
    flex: 1;
    padding-top: 60px;
    padding-bottom: 40px;
  }
  .card {
    background-color: rgba(255, 255, 255, 0.95);
    color: #333;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  }
  .navbar {
    background-color: rgba(0,0,0,0.6);
  }
  footer {
    text-align: center;
    padding: 10px;
    background-color: rgba(0,0,0,0.6);
    color: #ccc;
  }
  a.text-decoration-none:hover {
    text-decoration: none;
  }
</style>
</head>
<body>

<nav class="navbar fixed-top navbar-dark" style="background-color: transparent;">
  <div class="container">
    <a class="navbar-brand" href="#">Sistema de Préstamos de Laptops</a>
    <a href="logout.php" class="btn btn-outline-light" onclick="return confirm('¿Estás seguro que deseas cerrar sesión?')" style="border: 2px solid white; padding: 8px 20px;">
      <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
    </a>
  </div>
</nav>
<div class="container">
  <h1 class="mb-4 text-center">Bienvenido</h1>
  <div class="row g-4 justify-content-center">

    <div class="col-12 col-md-4 col-lg-3">
      <a href="registrar_prestamo.php" class="text-decoration-none">
        <div class="card shadow-sm h-100 text-center p-4">
          <i class="bi bi-laptop-fill display-1 text-primary"></i>
          <h5 class="card-title mt-3">Registrar Préstamo</h5>
          <p class="card-text text-muted">Préstamo de laptops</p>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <a href="registrar_devolucion.php" class="text-decoration-none">
        <div class="card shadow-sm h-100 text-center p-4">
          <i class="bi bi-arrow-return-left display-1 text-success"></i>
          <h5 class="card-title mt-3">Registrar Devolución</h5>
          <p class="card-text text-muted">Devolver laptops prestadas</p>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <a href="admin_panel.php" class="text-decoration-none">
        <div class="card shadow-sm h-100 text-center p-4">
          <i class="bi bi-clipboard-data display-1 text-warning"></i>
          <h5 class="card-title mt-3">Historial de Préstamos</h5>
          <p class="card-text text-muted">Ver préstamos y devoluciones</p>
        </div>
      </a>
    </div>

    <div class="col-12 col-md-4 col-lg-3">
      <a href="admin_laptops.php" class="text-decoration-none">
        <div class="card shadow-sm h-100 text-center p-4">
          <i class="bi bi-hdd-network display-1 text-danger"></i>
          <h5 class="card-title mt-3">Gestión de Laptops</h5>
          <p class="card-text text-muted">Administrar laptops disponibles</p>
        </div>
      </a>
    </div>

  </div>
</div>

<footer>
  <?php include("footer.php"); ?>
  &copy; Derechos reservados - 2025 BTH
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
