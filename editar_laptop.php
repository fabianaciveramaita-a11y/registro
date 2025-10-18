<?php
include("conexion.php");
include("header.php");

$id = intval($_GET['id'] ?? 0);
$msg = ""; // inicializar mensaje vacío

if ($id <= 0) {
    header('Location: admin_laptops.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero_serie = $conexion->real_escape_string($_POST['numero_serie']);
    $marca = $conexion->real_escape_string($_POST['marca']);
    $modelo = $conexion->real_escape_string($_POST['modelo']);
    $estado = $conexion->real_escape_string($_POST['estado']);
    $numero_serie_bateria = $conexion->real_escape_string($_POST['numero_serie_bateria']);

    // Validar si el número de serie existe en otra laptop
    $check = $conexion->query("SELECT id FROM laptops WHERE numero_serie = '$numero_serie' AND id != $id");
    if ($check->num_rows > 0) {
        $msg = "Error: El número de serie ya está en uso.";
    } else {
        $conexion->query("UPDATE laptops 
            SET numero_serie='$numero_serie', 
                marca='$marca', 
                modelo='$modelo', 
                estado='$estado', 
                numero_serie_bateria='$numero_serie_bateria' 
            WHERE id = $id");
        $msg = "Laptop actualizada correctamente.";
    }
}

// Obtener datos actuales
$laptop = [];
$res = $conexion->query("SELECT * FROM laptops WHERE id = $id");
if ($res && $res->num_rows > 0) {
    $laptop = $res->fetch_assoc();
} else {
    header('Location: admin_laptops.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Editar Laptop</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
    <h2>Editar Laptop</h2>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="numero_serie" class="form-label">Número de Serie</label>
            <input type="text" id="numero_serie" name="numero_serie" class="form-control" 
                   value="<?= htmlspecialchars($laptop['numero_serie'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" 
                   value="<?= htmlspecialchars($laptop['marca'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" 
                   value="<?= htmlspecialchars($laptop['modelo'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="numero_serie_bateria" class="form-label">Número de Serie del cargador</label>
            <input type="text" id="numero_serie_bateria" name="numero_serie_bateria" class="form-control" 
                   value="<?= htmlspecialchars($laptop['numero_serie_bateria'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select" required>
                <?php
                $estados = ['Disponible', 'Prestada', 'Perdida', 'Dañada'];
                foreach ($estados as $estadoOption) {
                    $sel = (($laptop['estado'] ?? '') === $estadoOption) ? 'selected' : '';
                    echo "<option value='$estadoOption' $sel>$estadoOption</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="admin_laptops.php" class="btn btn-secondary ms-2">Volver</a>
    </form>
</div>

<?php include("footer.php"); ?> 
</body>
</html>
