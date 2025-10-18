<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sistema de Préstamos - Gestión de Laptops</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<style>
  body {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  .container {
    flex: 1;
    padding-top: 20px;
    padding-bottom: 40px;
  }
  .card {
    background-color: rgba(255, 255, 255, 0.95);
    color: #333;
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  }
  .table {
    background-color: rgba(255, 255, 255, 0.95);
    color: #333;
    border-radius: 8px;
  }
  .form-control, .form-select, .btn {
    border-radius: 8px;
  }
  .alert {
    border-radius: 8px;
  }
  h2, h3 {
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
  }
</style>
</head>
<body>