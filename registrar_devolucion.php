<?php include("verificarsesion.php"); ?>
<?php
include("conexion.php");
include("header.php"); // ✅ encabezado común
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrar Devolución</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container py-5">
    <h2>Registrar Devolución de Laptop</h2>
    <?php
    $sql = "SELECT p.id, p.usuario, p.tipo_usuario, l.numero_serie, l.marca, l.modelo, p.fecha_prestamo 
            FROM prestamos p 
            INNER JOIN laptops l ON p.id_laptop = l.id 
            WHERE p.fecha_devolucion IS NULL 
            ORDER BY p.fecha_prestamo";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered mt-4">
                <thead class="table-light">
                  <tr>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Serie Laptop</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Fecha Préstamo</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>'.htmlspecialchars($row['usuario']).'</td>
                    <td>'.htmlspecialchars($row['tipo_usuario']).'</td>
                    <td>'.htmlspecialchars($row['numero_serie']).'</td>
                    <td>'.htmlspecialchars($row['marca']).'</td>
                    <td>'.htmlspecialchars($row['modelo']).'</td>
                    <td>'.htmlspecialchars($row['fecha_prestamo']).'</td>
                    <td>
                      <form method="POST" action="guardar_devolucion.php" onsubmit="return confirmarDevolucion(event, \''.htmlspecialchars($row['numero_serie']).'\');">
                        <input type="hidden" name="id_prestamo" value="'.$row['id'].'">
                        <button type="submit" class="btn btn-success btn-sm">Devolver</button>
                      </form>
                    </td>
                  </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-info mt-4">No hay préstamos activos para devolver.</div>';
    }
    ?>
    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
</div>

<script>
function confirmarDevolucion(event, numeroSerie) {
    event.preventDefault();
    Swal.fire({
        title: 'Confirmar devolución',
        text: "¿Desea registrar la devolución de la laptop con serie: " + numeroSerie + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, devolver',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });
    return false;
}
</script>
<?php include("footer.php"); // ✅ pie de página común ?>

</body>
</html>
