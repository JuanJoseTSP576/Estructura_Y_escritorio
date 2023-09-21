<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al Inventario de Celulares</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- CSS de Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/Styles.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f6f6f6;
            height: 100vh; /* Ocupar el alto total de la vista */
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            transform: scale(1.1); /* Aumentar el tamaño del formulario */
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: scale(1.15); /* Efecto de zoom al pasar el mouse */
        }




    
        .text-center {
            text-align: center;
        }


        .welcome-text {
        text-align: center;
        margin-bottom: 30px;
        font-size: 40px;
        font-weight: bold;

        
    }
    </style>
</head>

<body>

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

    $pdo = null;
    $mensaje = '';

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $stmt = $pdo->prepare('SELECT * FROM login WHERE usuario = ? AND contraseña = ?');
            $stmt->execute([$usuario, $password]);
            $user = $stmt->fetch();

            if ($user) {
                header('Location: inventario.php');
                exit;
            } else {
                $mensaje = 'El usuario o la contraseña no son válidos.';
            }
        }
    } catch (\PDOException $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
    ?>

<div class="container">
    <!-- Texto de bienvenida -->
    <div class="welcome-text">
        ¡Bienvenido de vuelta!
    </div>

    <div class="row justify-content-center d-flex">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header bg-primary text-white" style="text-align: center;">Iniciar sesión</div>
                <div class="card-body">
                    <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-danger">
                        <?php echo $mensaje; ?>
                    </div>
                    <?php endif; ?>

                    <form action="login.php" method="POST">
                    <div class="form-group">
    <label for="usuario">Usuario:</label>
    <input type="text" class="form-control" id="usuario" placeholder="Ingresa el usuario" name="usuario" value="" required>
</div>
<div class="form-group">
    <label for="password">Contraseña:</label>
    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" name="password" value="" required>
</div>

<div class="text-center btn-group d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">Continuar</button>
    <a href="index.php" class="btn btn-secondary">Regresar</a>   
</div>

                    </form>

                    <!-- Texto y enlace para registro -->
                    <div class="mt-3 text-center">
                        ¿No tienes una cuenta aún? <a href="registrar.php">Registrate.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Scripts de Bootstrap 4 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
