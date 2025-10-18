<?php include("verificarsesion.php"); ?>
<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrar Préstamo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php include("header.php"); ?>
<div class="container py-5">
    <h2>Registrar Préstamo de Laptop</h2>
    <form id="prestamoForm" method="POST" action="guardar_prestamo.php" class="mt-4">
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre del Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
            <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                <option value="">Seleccione...</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Profesor">Profesor</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_laptop" class="form-label">Laptop Disponible</label>
            <select class="form-select" id="id_laptop" name="id_laptop" required>
                <option value="">Seleccione una laptop disponible</option>
                <?php
                $sql = "SELECT id, numero_serie, numero_serie_cargador, marca, modelo FROM laptops WHERE estado='Disponible' ORDER BY numero_serie";
                $result = $conexion->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id'].'">Serie Laptop: '.$row['numero_serie'].' | Serie Cargador: '.$row['numero_serie_cargador'].' | Marca: '.$row['marca'].' | Modelo: '.$row['modelo'].'</option>';
                    }
                } else {
                    echo '<option disabled>No hay laptops disponibles</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Préstamo</button>
        <a href="index.php" class="btn btn-secondary ms-2">Volver</a>
    </form>
</div>

<script>
document.getElementById('prestamoForm').addEventListener('submit', function(e) {
    if (!confirm('¿Confirmar registro de préstamo?')) {
        e.preventDefault();
    }
});
</script>
<?php include("footer.php"); ?>
</body>
</html>
