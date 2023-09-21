<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Inventario de inventarios</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .left {
            flex: 1.5;
            background-color: #581845 ;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .title {
            font-size: 32px;
            margin-bottom: 30px;
            color: #007bff;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
        }

        .btn-signup {
            background-color: #6c757d;
            color: white;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-signup:hover {
            background-color: #565e68;
        }
    </style>
</head>
<body>
    <div class="left"></div>
    <div class="right">
        <div class="container">
            <div class="title">Bienvenido al inventario para celulares</div>
    <!-- Enlace para Iniciar Sesión -->
<a href="login.php" class="btn btn-login">Iniciar Sesión</a>

<!-- Enlace para Registrarse -->

        </div>
    </div>
</body>
</html>
