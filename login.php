<?php
session_start();
include("conexion.php");

// Si ya está logueado, redirigir al index
if (isset($_SESSION['usuario_logueado'])) {
    header("Location: index.php");
    exit();
}

$mensaje_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    // Consulta simple sin hash
    $query = "SELECT * FROM usuarios WHERE usuario = '" . $conexion->real_escape_string($usuario) . "' AND password = '" . $conexion->real_escape_string($password) . "'";
    $result = $conexion->query($query);
    
    if ($result && $result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $_SESSION['usuario_logueado'] = $user_data['usuario'];
        $_SESSION['nombre_usuario'] = $user_data['nombre'];
        $_SESSION['user_id'] = $user_data['id'];
        
        header("Location: index.php");
        exit();
    } else {
        $mensaje_error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Iniciar Sesión - Sistema de Préstamos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.login-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    padding: 40px;
    width: 100%;
    max-width: 400px;
}
.login-header {
    text-align: center;
    margin-bottom: 30px;
}
.login-header i {
    font-size: 3rem;
    color: #6a11cb;
    margin-bottom: 15px;
}
.login-header h2 {
    color: #333;
    font-weight: 600;
}
.form-control {
    border-radius: 10px;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}
.form-control:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.25);
}
.btn-login {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}
.alert {
    border-radius: 10px;
}
</style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <i class="fas fa-laptop"></i>
        <h2>Sistema de Préstamos</h2>
        <p class="text-muted">Iniciar Sesión</p>
    </div>
    
    <?php if (!empty($mensaje_error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <?= htmlspecialchars($mensaje_error) ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">
                <i class="fas fa-user"></i> Usuario
            </label>
            <input type="text" 
                   class="form-control" 
                   id="usuario" 
                   name="usuario" 
                   placeholder="Ingresa tu usuario" 
                   required>
        </div>
        
        <div class="mb-4">
            <label for="password" class="form-label">
                <i class="fas fa-lock"></i> Contraseña
            </label>
            <input type="password" 
                   class="form-control" 
                   id="password" 
                   name="password" 
                   placeholder="Ingresa tu contraseña" 
                   required>
        </div>
        
        <button type="submit" class="btn btn-primary btn-login w-100">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </button>
    </form>
    
    <div class="text-center mt-4">
        <small class="text-muted">
            <i class="fas fa-info-circle"></i> 
            Usuario: admin | Contraseña: admin123
        </small>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>