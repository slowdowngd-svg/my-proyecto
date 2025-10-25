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
    <title>Inicio</title>
    <link rel="icon" href="img/milogo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #e8f5e9, #ffffff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .hero {
            text-align: center;
            padding: 80px 20px 50px;
        }

        .hero h1 {
            color: #9314a3ff;
            font-weight: 700;
            font-size: 2.5rem;
        }

        .hero p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding-bottom: 50px;
        }

        .card {
            width: 300px;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-7px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card img {
            border-radius: 15px 15px 0 0;
            height: 180px;
            object-fit: cover;
        }

        .card-title {
            color: #3f1987ff;
            font-weight: 600;
        }

        .btn-success {
            width: 100%;
            border-radius: 0 0 15px 15px;
        }

        footer {
            margin-top: auto;
            background-color: #361987ff;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            .card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- 🟩 Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #198754;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <img src="img/milogo.png" alt="Logo" width="40" height="40" class="rounded-circle me-2">
                Papelería Inventario
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="inicio.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="productos.php">Gestión de Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Gestión de Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="nosotros.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 🟢 Sección de bienvenida -->
    <section class="hero">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?> 👋</h1>
        <p>No sobra asi esta bonito solo para rellenar XD</p>
    </section>

    <!-- 🟣 Tarjetas de acceso rápido -->
    <section class="cards-container container">
        <div class="card text-center">
            <div class="card-body">
            <img src="img/productos.jpg" alt="">
                <h5 class="card-title">Gestión de Productos</h5>
                <p class="card-text">Agrega, edita y elimina productos de tu inventario.</p>
            </div>
            <a href="productos.php" class="btn btn-success">Ir a Productos</a>
        </div>


        <div class="card text-center">
            <div class="card-body">
            <img src="img/Nosotros.jpg" alt="">
                <h5 class="card-title">Nosotros</h5>
                <p class="card-text">Conoce más sobre los creadores del proyecto.</p>
            </div>
            <a href="nosotros.php" class="btn btn-success">Ver más</a>
        </div>
    </section>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
