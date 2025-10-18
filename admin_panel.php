<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel Administrador - Historial</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include("header.php"); ?>

<div class="container py-5">
    <h2>Historial de Préstamos</h2>
    <div class="mb-3">
        <a href="imprimir_historial.php" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir Historial
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <input type="text" id="busquedaPrestamo" class="form-control" placeholder="Buscar por usuario, laptop, cargador...">
        </div>
        <div class="col-md-3 mb-2">
            <select id="filtroTipoUsuario" class="form-select">
                <option value="">Todos los tipos</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Profesor">Profesor</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered mt-4 align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th><i class="fas fa-user"></i> Usuario</th>
                <th><i class="fas fa-user-graduate"></i> Tipo Usuario</th>
                <th><i class="fas fa-barcode"></i> Serie Laptop</th>
                <th><i class="fas fa-battery-full"></i> Serie Cargador</th>
                <th><i class="fas fa-laptop"></i> Marca</th>
                <th><i class="fas fa-list"></i> Modelo</th>
                <th><i class="fas fa-calendar-plus"></i> Fecha Préstamo</th>
                <th><i class="fas fa-calendar-check"></i> Fecha Devolución</th>
            </tr>
        </thead>
        <tbody id="tablaPrestamos">
        <?php
        $sql = "SELECT p.id, p.usuario, p.tipo_usuario, 
                       l.numero_serie, l.numero_serie_cargador, l.marca, l.modelo, 
                       p.fecha_prestamo, p.fecha_devolucion 
                FROM prestamos p 
                INNER JOIN laptops l ON p.id_laptop = l.id 
                ORDER BY p.fecha_prestamo DESC";
        $result = $conexion->query($sql);

        if (!$result) {
            die("Error en la consulta SQL: " . $conexion->error);
        }

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.htmlspecialchars($row['usuario']).'</td>';
            echo '<td>'.htmlspecialchars($row['tipo_usuario']).'</td>';
            echo '<td>'.htmlspecialchars($row['numero_serie']).'</td>';
            echo '<td>'.htmlspecialchars($row['numero_serie_cargador']).'</td>';
            echo '<td>'.htmlspecialchars($row['marca']).'</td>';
            echo '<td>'.htmlspecialchars($row['modelo']).'</td>';
            echo '<td>'.$row['fecha_prestamo'].'</td>';
            echo '<td>'.($row['fecha_devolucion'] ?? 'No devuelto').'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    </div>

    <script>
    // Filtro y búsqueda en tiempo real para préstamos
    document.getElementById('busquedaPrestamo').addEventListener('input', filtrarPrestamos);
    document.getElementById('filtroTipoUsuario').addEventListener('change', filtrarPrestamos);

    function filtrarPrestamos() {
        var texto = document.getElementById('busquedaPrestamo').value.toLowerCase();
        var tipo = document.getElementById('filtroTipoUsuario').value;
        var filas = document.querySelectorAll('#tablaPrestamos tr');
        filas.forEach(function(fila) {
            var celdas = fila.querySelectorAll('td');
            var coincide = false;
            for (var i = 1; i <= 6; i++) {
                if (celdas[i] && celdas[i].textContent.toLowerCase().includes(texto)) {
                    coincide = true;
                }
            }
            var tipoCelda = celdas[2].textContent.trim();
            var tipoOk = !tipo || tipoCelda === tipo;
            fila.style.display = (coincide && tipoOk) ? '' : 'none';
        });
    }
    </script>

    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
</div>

<?php include("footer.php"); ?>
</body>
</html>
