<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $conexion->real_escape_string($_POST['usuario']);
    $tipo_usuario = $conexion->real_escape_string($_POST['tipo_usuario']);
    $id_laptop = intval($_POST['id_laptop']);

    $check = $conexion->query("SELECT estado FROM laptops WHERE id = $id_laptop");
    if ($check->num_rows == 0) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Laptop no encontrada',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'registrar_prestamo.php';
            });
        </script>
        </body>
        </html>
        <?php
        exit;
    }
    $estado = $check->fetch_assoc()['estado'];
    if ($estado !== 'Disponible') {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Laptop no disponible',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'registrar_prestamo.php';
            });
        </script>
        </body>
        </html>
        <?php
        exit;
    }

    $insert = $conexion->query("INSERT INTO prestamos (usuario, tipo_usuario, id_laptop, fecha_prestamo) VALUES ('$usuario', '$tipo_usuario', $id_laptop, NOW())");
    if ($insert) {
        $conexion->query("UPDATE laptops SET estado = 'Prestada' WHERE id = $id_laptop");
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <title>Éxito</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Préstamo registrado correctamente',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>
        </body>
        </html>
        <?php
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error al registrar préstamo',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'registrar_prestamo.php';
            });
        </script>
        </body>
        </html>
        <?php
    }
    exit;
} else {
    header('Location: registrar_prestamo.php');
    exit;
}
