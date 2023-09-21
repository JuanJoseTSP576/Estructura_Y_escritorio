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

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']);

        // Marcar el registro con el ID proporcionado como "inactivo"
        $stmt = $pdo->prepare('UPDATE inventario_celulares SET estado = "inactivo" WHERE id_celular = :id AND estado != "inactivo"');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Si se cambió algún registro, redireccionar al inventario
        if ($stmt->rowCount() > 0) {
            header("Location: inventario.php");
        } else {
            echo "ID no válido o ya está inactivo.";
        }

    } else {
        echo "ID no proporcionado o no es numérico.";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
