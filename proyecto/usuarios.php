<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// 🟢 Crear usuario
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $query = "INSERT INTO usuarios (nombre, correo, clave) VALUES ('$nombre', '$correo', '$clave')";
    mysqli_query($conexion, $query);
    header("Location: usuarios.php");
    exit();
}

//  Actualizar usuario
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $query = "UPDATE usuarios SET nombre='$nombre', correo='$correo', clave='$clave' WHERE id=$id";
    mysqli_query($conexion, $query);
    header("Location: usuarios.php");
    exit();
}

// Eliminar usuario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $query = "DELETE FROM usuarios WHERE id=$id";
    mysqli_query($conexion, $query);
    header("Location: usuarios.php");
    exit();
}

// Seleccionar usuario para editar
$usuario_editar = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $result = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id=$id LIMIT 1");
    $usuario_editar = mysqli_fetch_assoc($result);
}

// Obtener todos los usuarios
$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="icon" href="img/milogo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .tabla-container {
            max-width: 1000px;
            margin: 0 auto;
        }
        .table {
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            font-size: 1.05rem;
        }
        .table th {
            background-color: #198754 !important;
            color: white;
        }
        .form-editar {
            max-width: 850px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 2px solid #198754;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body>

<!-- 🟩 Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: #198754;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="inicio.php">
            <img src="img/milogo.png" alt="Logo" width="40" height="40" class="rounded-circle me-2">
            Papelería Inventario
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="productos.php">Gestion de Productos</a></li>
                <li class="nav-item"><a class="nav-link active" href="usuarios.php">Gestion de Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="nosotros.php">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- 🟢 Título -->
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold mb-4">Gestión de Usuarios</h2>

    <!-- 🟩 Formulario Agregar -->
    <div class="card mb-5 shadow" style="max-width: 850px; margin: 0 auto;">
        <div class="card-header bg-success text-white fw-bold text-center">
            Registrar Nuevo Usuario
        </div>
        <div class="card-body">
            <form action="" method="POST" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="clave" class="form-control" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" name="guardar" class="btn btn-success mt-3 px-4">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🟦 Tabla de usuarios -->
    <div class="tabla-container">
        <div class="card shadow">
            <div class="card-header bg-success text-white fw-bold text-center">
                Lista de Usuarios Registrados
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Correo</th>
                                <th>Contraseña</th> <!-- ✅ Nueva columna -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($usuarios)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($row['clave']); ?></td> <!-- ✅ Mostrar contraseña -->
                                    <td>
                                        <a href="?editar=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm px-3">Editar</a>
                                        <a href="?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm px-3" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ✏️ Formulario Editar -->
    <?php if ($usuario_editar): ?>
        <div class="form-editar">
            <h5 class="text-center mb-3">Editar Usuario</h5>
            <form action="" method="POST" class="row g-3">
                <input type="hidden" name="id" value="<?php echo $usuario_editar['id']; ?>">
                <div class="col-md-4">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="<?php echo $usuario_editar['nombre']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control" value="<?php echo $usuario_editar['correo']; ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="clave" class="form-control" value="<?php echo $usuario_editar['clave']; ?>" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" name="actualizar" class="btn btn-success mt-3 px-4">Guardar cambios</button>
                    <a href="usuarios.php" class="btn btn-secondary mt-3 px-4">Cancelar</a>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>

<footer>
    &copy; Esteban 2025 | Proyecto Papelería Inventario
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
