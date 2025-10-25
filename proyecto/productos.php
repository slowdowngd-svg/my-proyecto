<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

//  Crear producto
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $query = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('$nombre', '$precio', '$cantidad')";
    mysqli_query($conexion, $query);
    header("Location: productos.php");
    exit();
}

//  Editar producto
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $query = "UPDATE productos SET nombre='$nombre', precio='$precio', cantidad='$cantidad' WHERE id=$id";
    mysqli_query($conexion, $query);
    header("Location: productos.php");
    exit();
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $query = "DELETE FROM productos WHERE id=$id";
    mysqli_query($conexion, $query);
    header("Location: productos.php");
    exit();
}

// Seleccionar producto a editar
$producto_editar = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $result = mysqli_query($conexion, "SELECT * FROM productos WHERE id=$id LIMIT 1");
    $producto_editar = mysqli_fetch_assoc($result);
}

// Obtener todos los productos
$productos = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="icon" href="img/milogo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .tabla-container {
            max-width: 1100px;
            margin: 0 auto;
            text-align: center;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            font-size: 1.05rem;
        }

        .table th {
            background-color: #198754 !important;
            color: white;
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
        }

        .table td, .table th {
            padding: 14px;
        }

        .card {
            border-radius: 15px;
        }

        .form-editar {
            max-width: 900px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 2px solid #5b1987ff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        .form-editar h5 {
            color: #198754;
            font-weight: 600;
        }

        .btn {
            font-size: 1rem;
        }

        h2 {
            font-size: 2rem;
        }

        .card-header {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="inicio.php">
                <img src="img/milogo.png" alt="Logo" width="40" height="40" class="rounded-circle me-2">
                Papelería Inventario
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link active" href="productos.php">Gestión de Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="usuarios.php">Gestión de Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="nosotros.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!--  Contenido principal -->
    <div class="container mt-5">
        <h2 class="text-center text-success fw-bold mb-4">Gestión de Productos</h2>

        <!--  Formulario para agregar producto -->
        <div class="card mb-5 shadow" style="max-width: 900px; margin: 0 auto;">
            <div class="card-header bg-success text-white fw-bold text-center">
                Agregar Producto
            </div>
            <div class="card-body">
                <form action="" method="POST" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" name="guardar" class="btn btn-success mt-3 px-4">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de productos centrada -->
        <div class="tabla-container">
            <div class="card shadow">
                <div class="card-header bg-success text-white fw-bold text-center">
                    Lista de Productos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($productos)): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                        <td>$<?php echo number_format($row['precio'], 2); ?></td>
                                        <td><?php echo $row['cantidad']; ?></td>
                                        <td>
                                            <a href="?editar=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm px-3">Editar</a>
                                            <a href="?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm px-3" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para editar producto -->
        <?php if ($producto_editar): ?>
            <div class="form-editar">
                <h5 class="text-center mb-3">Editar Producto</h5>
                <form action="" method="POST" class="row g-3">
                    <input type="hidden" name="id" value="<?php echo $producto_editar['id']; ?>">
                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $producto_editar['nombre']; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" step="0.01" class="form-control" value="<?php echo $producto_editar['precio']; ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" value="<?php echo $producto_editar['cantidad']; ?>" required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" name="actualizar" class="btn btn-success mt-3 px-4">Guardar cambios</button>
                        <a href="productos.php" class="btn btn-secondary mt-3 px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
