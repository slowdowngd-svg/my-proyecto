<?php
include("conexion.php");

// Registrar usuario nuevo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre_apellidos'];

    // Verificar si ya existe el usuario
    $verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$correo'");
    if (mysqli_num_rows($verificar) > 0) {
        $mensaje = ["tipo" => "warning", "texto" => "Este correo ya está registrado."];
    } else {
        $sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$correo', '$password')";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = ["tipo" => "success", "texto" => " Registro exitoso. Ya puedes iniciar sesión."];
        } else {
            $mensaje = ["tipo" => "danger", "texto" => "Error al registrar usuario: " . mysqli_error($conexion)];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="icon" href="img/milogo.png" />
<link rel="stylesheet" href="css/estilos.css">

    <style>
        body {
            background-image: url('img/azul.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body>

<main class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow w-auto border border-5 border-white" style="max-width: 500px;">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-3">
                <img class="mb-3" src="img/milogo.png" alt="Logo" width="120" height="110">
                <h5 class="fw-bold text-body">REGÍSTRATE</h5>
            </div>

            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $mensaje['tipo']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $mensaje['texto']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="mt-3">
                <div class="mb-3">
                    <label class="form-label">Nombre y Apellidos</label>
                    <input type="text" class="form-control" name="nombre_apellidos" required placeholder="Nombre completo">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico (será tu usuario)</label>
                    <input type="email" class="form-control" name="correo" required placeholder="tu@correo.com">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" required placeholder="Contraseña">
                </div>

                <button class="btn btn-success w-100 mt-2" type="submit">Registrar</button>

                <p class="text-center mt-3">
                    <a href="index.php" class="text-decoration-none text-success">
                        ¿Ya tienes cuenta? Inicia sesión aquí.
                    </a>
                </p>
            </form>
        </div>
    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
