<?php
include("conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// 🟩 Consultar los productos
$query = "SELECT * FROM productos ORDER BY id DESC";
$result = mysqli_query($conexion, $query);

// 🟦 Calcular totales
$totalProductos = mysqli_num_rows($result);
$totalValor = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $totalValor += ($row['precio'] * $row['cantidad']);
}
mysqli_data_seek($result, 0); // volver el puntero al inicio
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: #f6f7f8;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1100px;
            margin-top: 50px;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h2 {
            color: #198754;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            font-size: 15px;
        }
        th {
            background-color: #198754;
            color: #fff;
            text-align: center;
        }
        tfoot {
            background-color: #e8f5e9;
            font-weight: bold;
        }
        .btn-print {
            background-color: #198754;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            float: right;
            margin-top: 10px;
        }
        .btn-print:hover {
            background-color: #157347;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Informe General de Productos</h2>
    <p class="text-center">Sistema de Papelería Inventario — <?php echo date('d/m/Y'); ?></p>

    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Producto</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td>$<?php echo number_format($row['precio'], 0, ',', '.'); ?></td>
                    <td>$<?php echo number_format($row['precio'] * $row['cantidad'], 0, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end">TOTAL PRODUCTOS:</td>
                <td><?php echo $totalProductos; ?></td>
                <td colspan="2" class="text-end">Valor Total: $<?php echo number_format($totalValor, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>

    <button class="btn-print" onclick="window.print()"> Imprimir / Guardar PDF</button>
</div>

</body>
</html>
