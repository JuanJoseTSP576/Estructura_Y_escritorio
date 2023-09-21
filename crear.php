<?php
$host = 'localhost';
$db = 'estructuradatos';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $marca = $_POST['marca'];
        $nombre = $_POST['nombre'];
        $almacenamiento = $_POST['almacenamiento'];
        $ram = $_POST['ram'];
        $precio = $_POST['precio'];
        $disponibilidad = $_POST['disponibilidad'];
        $estado = 'activado';
        
        // Consulta para verificar si el registro ya existe
        $stmtCheck = $pdo->prepare('SELECT * FROM inventario_celulares WHERE nombre = ? AND almacenamiento = ? AND ram = ?');
        $stmtCheck->execute([$nombre, $almacenamiento, $ram]);

        if (!is_numeric($precio) || $precio < 0) {
            $errorMsg = "Ingrese un precio válido.";
        } elseif (!is_numeric($disponibilidad) || $disponibilidad < 0) {
            $errorMsg = "Ingrese una cantidad de disponibilidad válida.";
        } elseif ($stmtCheck->fetch()) {
            $errorMsg = "No se pueden crear valores duplicados";
        } else {
            // Si no hay registros duplicados, insertar el nuevo registro
            $stmtInsert = $pdo->prepare('INSERT INTO inventario_celulares (marca, nombre, almacenamiento, ram, precio, disponibilidad, estado) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmtInsert->execute([$marca, $nombre, $almacenamiento, $ram, $precio, $disponibilidad, $estado]);
        
            header('Location: inventario.php');
            exit;
        }
    } 
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de nuevo celular</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/Styles.css">
    <style>
          body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5; /* Color de fondo para que el contraste con el contenedor sea visible */
    }
    .error-msg {
    color: red;
    border: 1px solid red;
    background-color: #ffe6e6;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
}
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .red-btn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .red-btn:hover {
            background-color: darkred;
        }

        .btn-group {
            display: flex;
            justify-content: start; 
            gap: 10px;
        }

        /* Efecto de zoom al pasar el mouse */
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Inventario de Celulares</h2>

        <form action="crear.php" method="POST">
        <?php
if (isset($errorMsg)) {
    echo "<div class='error-msg'>{$errorMsg}</div>";
}
?>
        <!-- Marca con combobox -->
        <div class="form-group">
            <label for="marca">Marca:</label>
            <select class="form-control" id="marca" name="marca">
                <option>Samsung</option>
                <option>Apple</option>
                <option>Huawei</option>
                <option>Xiaomi</option>
                <option>Motorola</option>
                <option>Honor</option>
                <option>Oppo</option>
                <option>Realme</option>
                <option>Cubot</option>
            </select>
        </div>

        <!-- Resto de campos del formulario -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="almacenamiento">Almacenamiento (en GB):</label>
            <select class="form-control " id="almacenamiento" name="almacenamiento">
                <option>8</option>
                <option>16</option>
                <option>32</option>
                <option>64</option>
                <option>128</option>
                <option>256</option>
                <option>512</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ram">RAM (en GB):</label>
            <select class="form-control " id="ram" name="ram">
                <option>1</option>
                <option>2</option>
                <option>4</option>
                <option>8</option>
                <option>16</option>
                <option>32</option>
                <option>64</option>
            </select>
        </div>
        <div class="form-group">
    <label for="precio">Precio ($COP):</label>
    <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
</div>
<div class="form-group">
    <label for="disponibilidad">Disponibilidad:</label>
    <input type="number" min="0" class="form-control" id="disponibilidad" name="disponibilidad" required>
</div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary ">Guardar</button>
            <a href="inventario.php" class="btn btn-secondary">Cancelar</a>
        </div>

        </form>
    </div>

    <!-- Scripts de Bootstrap 4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>






</html>

