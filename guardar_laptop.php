<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_serie = $_POST["numero_serie"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO laptops (numero_serie, estado) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$numero_serie, $estado])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Laptop registrada',
                text: 'Se ha guardado correctamente',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la laptop',
                confirmButtonText: 'Intentar de nuevo'
            }).then(() => {
                window.location.href = 'admin_laptops.php';
            });
        </script>";
    }
}
?>
