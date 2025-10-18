<?php include("verificarsesion.php"); ?>
<?php
include("header.php");
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_laptop'])) {
    $numero_serie = $conexion->real_escape_string($_POST['numero_serie']);
    $marca = $conexion->real_escape_string($_POST['marca']);
    $modelo = $conexion->real_escape_string($_POST['modelo']);
    $numero_serie_cargador = $conexion->real_escape_string($_POST['numero_serie_cargador']);

    // Validar si número de serie ya existe
    $check = $conexion->query("SELECT id FROM laptops WHERE numero_serie = '$numero_serie'");
    if ($check->num_rows > 0) {
        $msg = "Error: El número de serie ya está registrado.";
    } else {
        $conexion->query("INSERT INTO laptops (numero_serie, marca, modelo, numero_serie_cargador) VALUES ('$numero_serie', '$marca', '$modelo', '$numero_serie_cargador')");
        $msg = "Laptop agregada correctamente.";
    }
}
?>
<div class="container py-5">
    <h2>Gestión de Laptops</h2>
    <div class="mb-3">
        <a href="imprimir_inventario.php" class="btn btn-primary">
            <i class="fas fa-print"></i> Imprimir Inventario
        </a>
    </div>

    <?php if (!empty($msg)) : ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" class="mb-4">
        <input type="hidden" name="add_laptop" value="1">
        <div class="mb-3">
            <label for="numero_serie" class="form-label">Número de Serie</label>
            <input type="text" id="numero_serie" name="numero_serie" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" id="marca" name="marca" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" id="modelo" name="modelo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero_serie_cargador" class="form-label">Número de Serie del cargador</label>
            <input type="text" id="numero_serie_cargador" name="numero_serie_cargador" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Laptop</button>
        <a href="index.php" class="btn btn-secondary ms-2">Volver</a>
    </form>

    <h3>Listado de Laptops</h3>
    <div class="row mb-3">
        <div class="col-md-6 mb-2">
            <input type="text" id="busquedaLaptop" class="form-control" placeholder="Buscar por serie, marca, modelo o cargador...">
        </div>
        <div class="col-md-3 mb-2">
            <select id="filtroEstado" class="form-select">
                <option value="">Todos los estados</option>
                <option value="Disponible">Disponible</option>
                <option value="Prestada">Prestada</option>
                <option value="Perdida">Perdida</option>
                <option value="Dañada">Dañada</option>
            </select>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th><i class="fas fa-barcode"></i> Serie</th>
                <th><i class="fas fa-laptop"></i> Marca</th>
                <th><i class="fas fa-list"></i> Modelo</th>
                <th><i class="fas fa-battery-full"></i> Serie Cargador</th>
                <th><i class="fas fa-info-circle"></i> Estado</th>
                <th><i class="fas fa-cogs"></i> Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaLaptops">
        <?php
        $result = $conexion->query("SELECT * FROM laptops ORDER BY id DESC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['numero_serie']) . "</td>";
                echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                echo "<td>" . htmlspecialchars($row['numero_serie_cargador']) . "</td>";
                echo "<td><span class='badge bg-" . ($row['estado']=='Disponible'?'success':($row['estado']=='Prestada'?'warning':($row['estado']=='Perdida'?'danger':'secondary'))) . "'>" . htmlspecialchars($row['estado']) . "</span></td>";
                echo "<td>
                        <a href='editar_laptop.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'><i class='fas fa-edit'></i> Editar</a>
                      </td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
    </div>
    <script>
    // Filtro y búsqueda en tiempo real
    document.getElementById('busquedaLaptop').addEventListener('input', filtrarLaptops);
    document.getElementById('filtroEstado').addEventListener('change', filtrarLaptops);

    function filtrarLaptops() {
        var texto = document.getElementById('busquedaLaptop').value.toLowerCase();
        var estado = document.getElementById('filtroEstado').value;
        var filas = document.querySelectorAll('#tablaLaptops tr');
        filas.forEach(function(fila) {
            var celdas = fila.querySelectorAll('td');
            var coincide = false;
            for (var i = 0; i < 4; i++) {
                if (celdas[i].textContent.toLowerCase().includes(texto)) {
                    coincide = true;
                }
            }
            var estadoCelda = celdas[4].textContent.trim();
            var estadoOk = !estado || estadoCelda === estado;
            fila.style.display = (coincide && estadoOk) ? '' : 'none';
        });
    }
    </script>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>