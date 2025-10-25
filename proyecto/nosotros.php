<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="icon" href="img/milogo.png">
<link rel="stylesheet" href="css/estilos.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #711987ff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            color: #d4edda !important;
        }
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .card img {
            object-fit: cover;
            height: 250px;
        }
        footer {
            background: #7e1987ff;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <!-- 🔹 Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="inicio.php">
                <img src="img/milogo.png" alt="Logo" width="40" height="40" class="rounded-circle me-2">
                Papelería Inventario
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php">Gestión de Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Gestión de Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link active" href="nosotros.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 🔹 Contenido -->
    <div class="container mt-5">
        <h2 class="text-center text-success fw-bold mb-4">Conoce a los creadores</h2>
        <p class="text-center mb-5 text-muted">
            Este proyecto fue desarrollado por aprendices apasionados (no tanto) por la tecnología, el desarrollo web y la organización empresarial.
        </p>

        <div class="row justify-content-center g-4">
            <!-- 🧍 Aprendiz 1 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Danny Arciniegas</h5>
                    </div>
                </div>
            </div>

            <!-- 🧍 Aprendiz 2 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Jose Navarro</h5>
                    </div>
                </div>
            </div>

            <!-- 🧍 Aprendiz 3 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Andres Simanca</h5>
                    </div>
                </div>
            </div>
        </div>

            <!-- 🧍 Aprendiz 4 -->
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">Jose Varon</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <h4 class="text-success">Nuestra misión</h4>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Desarrollar herramientas digitales que optimicen la gestión de inventarios para pequeñas empresas, fomentando la eficiencia,
                el ahorro de recursos y la transformación tecnológica en el ámbito educativo y empresarial.
            </p>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
