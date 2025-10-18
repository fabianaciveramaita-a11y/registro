<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inventario de Laptops</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
@media print {
    .no-print { display: none; }
}
</style>
</head>
<body>
<div class="container py-5">
    <h2>Inventario de Laptops</h2>
    <p>Fecha de impresión: <?= date('d/m/Y H:i') ?></p>

    <table class="table table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>N°</th>
                <th>Serie Laptop</th>
                <th>Serie Cargador</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT id, numero_serie, numero_serie_cargador, marca, modelo, estado FROM laptops ORDER BY id";
        $result = $conexion->query($sql);
        $contador = 1;
        $resumen = ['Disponible'=>0, 'Prestada'=>0, 'Dañada'=>0, 'Perdida'=>0];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Color según estado
                $color = 'secondary';
                if ($row['estado'] == 'Disponible') $color = 'success';
                elseif ($row['estado'] == 'Prestada') $color = 'warning';
                elseif ($row['estado'] == 'Dañada') $color = 'danger';
                elseif ($row['estado'] == 'Perdida') $color = 'dark';

                echo '<tr>';
                echo '<td>'.$contador.'</td>';
                echo '<td>'.$row['numero_serie'].'</td>';
                echo '<td>'.$row['numero_serie_cargador'].'</td>';
                echo '<td>'.$row['marca'].'</td>';
                echo '<td>'.$row['modelo'].'</td>';
                echo '<td><span class="badge bg-'.$color.'">'.$row['estado'].'</span></td>';
                echo '</tr>';
                $contador++;

                if (isset($resumen[$row['estado']])) {
                    $resumen[$row['estado']]++;
                }
            }
        }
        ?>
        </tbody>
    </table>

    <h4>Resumen de Estado:</h4>
    <ul>
        <li>Disponible: <?= $resumen['Disponible'] ?></li>
        <li>Prestada: <?= $resumen['Prestada'] ?></li>
        <li>Dañada: <?= $resumen['Dañada'] ?></li>
        <li>Perdida: <?= $resumen['Perdida'] ?></li>
        <li><strong>Total de Laptops: <?= array_sum($resumen) ?></strong></li>
    </ul>

    <p>Este documento es un registro oficial del sistema de préstamos de laptops.</p>

    <button class="btn btn-primary no-print" onclick="window.print()">Imprimir</button>
    <a href="index.php" class="btn btn-secondary no-print">Volver</a>
</div>
</body>
</html>
