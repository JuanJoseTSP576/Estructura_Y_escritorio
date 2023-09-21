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

$pdo = new PDO($dsn, $user, $pass, $options);
$error= "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la información del celular
    $stmt = $pdo->prepare('SELECT * FROM inventario_celulares WHERE id_celular = ?');
    $stmt->execute([$id]);
    $celular = $stmt->fetch();

    if (!$celular) {
        die('No se encontró el celular.');
    }

    // Si el formulario se envía, actualizar la información
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $marca = $_POST['marca'];
        $nombre = $_POST['nombre'];
        $almacenamiento = $_POST['almacenamiento'];
        $ram = $_POST['ram'];
        $precio = $_POST['precio'];
        $disponibilidad = $_POST['disponibilidad'];
        $precio = $_POST['precio'];
        $disponibilidad = $_POST['disponibilidad'];
        
        if ($precio < 0 || $disponibilidad < 0) {
            $error = "El precio y la disponibilidad no pueden ser negativos.";
        } else {
        // Verificar si ya existe un registro con esos valores, excluyendo el registro actual
        $stmt = $pdo->prepare('SELECT * FROM inventario_celulares WHERE nombre = ? AND almacenamiento = ? AND ram = ? AND id_celular != ?');
        $stmt->execute([$nombre, $almacenamiento, $ram, $id]);
        $existing = $stmt->fetch();

        if ($existing) {
            $error = "No puedes actualizar con estos valores ya que produciría un registro duplicado.";
        } else {
            $stmt = $pdo->prepare('UPDATE inventario_celulares SET marca = ?, nombre = ?, almacenamiento = ?, ram = ?, precio = ?, disponibilidad = ? WHERE id_celular = ?');
            $stmt->execute([$marca, $nombre, $almacenamiento, $ram, $precio, $disponibilidad, $id]);

            header('Location: inventario.php');
            exit;
        }
    }
}
} else {
    die('ID no proporcionado.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Celular</title>
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
    
    .container {
        background-color: #ffffff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        margin: 20px;
    }

    .red-btn:hover {
        background-color: darkred;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Editar Celular</h2>

    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>

    <form action="editar.php?id=<?= $id ?>" method="POST">
        <div class="form-group">
            <label for="marca">Marca:</label>
            <select class="form-control" id="marca" name="marca">
                <?php
                $marcas = ['Samsung', 'Apple', 'Huawei', 'Xiaomi', 'Motorola', 'Honor', 'Oppo', 'Realme', 'Cubot'];
                foreach ($marcas as $marca_option) {
                    echo '<option value="'.$marca_option.'"'.($celular['marca'] == $marca_option ? ' selected' : '').'>'.$marca_option.'</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= $celular['nombre'] ?>">
        </div>
        <div class="form-group">
            <label for="almacenamiento">Almacenamiento (en GB):</label>
            <select class="form-control" id="almacenamiento" name="almacenamiento">
                <?php
                $almacenamientos = [8, 16, 32, 64, 128, 256, 512];
                foreach ($almacenamientos as $almacenamiento_option) {
                    echo '<option value="'.$almacenamiento_option.'"'.($celular['almacenamiento'] == $almacenamiento_option ? ' selected' : '').'>'.$almacenamiento_option.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ram">RAM (en GB):</label>
            <select class="form-control" id="ram" name="ram">
                <?php
                $rams = [1, 2, 4, 8, 16, 32, 64];
                foreach ($rams as $ram_option) {
                    echo '<option value="'.$ram_option.'"'.($celular['ram'] == $ram_option ? ' selected' : '').'>'.$ram_option.'</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="precio">Precio ($COP):</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required value="<?= $celular['precio'] ?>">
        </div>
        <div class="form-group">
    <label for="disponibilidad">Disponibilidad:</label>
    <input type="number" class="form-control" id="disponibilidad" name="disponibilidad" required value="<?= $celular['disponibilidad'] ?>">
</div>

        <div class="btn-group text-center btn-group d-flex justify-content-center">
            <button type="submit" class="btn btn-primary ">Guardar</button>
            <a href="inventario.php" class="btn btn-secondary ">Cancelar</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
