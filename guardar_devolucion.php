<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_prestamo = intval($_POST['id_prestamo'] ?? 0);

    if ($id_prestamo > 0) {
        // Buscar id_laptop del préstamo activo
        $res = $conexion->query("SELECT id_laptop FROM prestamos WHERE id = $id_prestamo AND fecha_devolucion IS NULL");
        if ($res->num_rows == 0) {
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
                    title: 'Error',
                    text: 'No se encontró préstamo activo para devolver.',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = 'registrar_devolucion.php';
                });
            </script>
            </body>
            </html>
            <?php
            exit;
        }
        $id_laptop = $res->fetch_assoc()['id_laptop'];

        // Actualizar fecha_devolucion
        $update = $conexion->query("UPDATE prestamos SET fecha_devolucion = NOW() WHERE id = $id_prestamo");

        if ($update) {
            // Cambiar estado laptop a Disponible
            $conexion->query("UPDATE laptops SET estado = 'Disponible' WHERE id = $id_laptop");

            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8" />
                <title>Devolución exitosa</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Devolución registrada correctamente',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = 'registrar_devolucion.php';
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
                    title: 'Error al registrar la devolución',
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = 'registrar_devolucion.php';
                });
            </script>
            </body>
            </html>
            <?php
        }
    } else {
        header('Location: registrar_devolucion.php');
        exit;
    }
} else {
    header('Location: registrar_devolucion.php');
    exit;
}
