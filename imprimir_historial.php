<?php
include("conexion.php");
date_default_timezone_set('America/La_Paz');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Historial de Préstamos de Laptops</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    text-align: center;
}

.container {
    max-width: 1200px;
    margin: auto;
}

@media print {
    .no-print { display: none; }
    table { page-break-inside: auto; }
    tr { page-break-inside: avoid; page-break-after: auto; }
    th, td {
        text-align: center !important;
        vertical-align: middle !important;
    }
}
table th, table td {
    text-align: center;
    vertical-align: middle;
}
</style>
</head>
<body>
<div class="container py-5">
    <h2>Historial de Préstamos de Laptops</h2>
    <p>Fecha de impresión: <?= date('d/m/Y H:i') ?></p>

    <table class="table table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo Usuario</th>
                <th>Serie Laptop</th>
                <th>Serie Cargador</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Fecha Préstamo</th>
                <th>Fecha Devolución</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT p.id, p.usuario, p.tipo_usuario, l.numero_serie, l.numero_serie_cargador, l.marca, l.modelo, 
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

    <button class="btn btn-primary no-print" onclick="window.print()">Imprimir</button>
    <a href="admin_panel.php" class="btn btn-secondary no-print">Volver</a>
</div>
</body>
</html>
