<?php

$usuario = "";
$pass = "";

if (isset($_GET['rol'])) {
    $rol = $_GET['rol'];
    switch ($rol) {
        case 'admin':
            $usuario = "jeremias";
            $pass = "jere123";
            break;
        case 'empleado':
            $usuario = "ezequiel";
            $pass = "eze123";
            break;
        case 'profesor':
            $usuario = "omonte";
            $pass = "omonte123";
            break;
        default:
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        ul {
            display: flex;
            justify-content: space-around;
        }

        li {
            list-style: none;
            background-color: #e1e1e1;
            padding: 20px;
            border-radius: 20px;
        }

        .contenedor-login {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .formulario-login {
            display: flex;
            flex-direction: column;
            width: 300px;
            gap: 10px;
            background-color: #e1e1e1;
            padding: 20px;
            border-radius: 10px;
        }

        .formulario-login button,
        .formulario-login input {
            padding: 5px;
        }

        .formulario-login button {
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .user-list {
            cursor: pointer;

            &:hover {
                background-color: #a7a7a7ff;
            }
        }
    </style>
</head>

<body>
    <main>
        <section class="contenedor-login">
            <form action="verificacion.php" class="formulario-login" method="post">
                <label for="usuario">Usuario:</label>
                <input type="text" autofocus name="usuario" id="usuario" placeholder="Ingrese su usuario.." value="<?= $usuario ?>" required>
                <br>
                <label for="pass">Contraseña:</label>
                <input type="password" id="pass" name="pass" placeholder="Ingrese su contraseña" value="<?= $pass ?>" required>
                <br>
                <button type="submit" name="iniciar">Iniciar Sesion</button>
            </form>
            <?php
            if (isset($_GET['nouser'])) {
                echo "<p>El usuario es incorrecto</p>";
            }
            if (isset($_GET['nopass'])) {
                echo "<p>La contraseña es incorrecta</p>";
            }
            ?>
        </section>


        <ul>
            <li class="user-list" class="user-list">
                <a href="?rol=admin">
                    <p>Administrador</p>
                    <p><b>Usuario: jeremias</b></p>
                    <p><b>Contraseña: jere123</b></p>
                </a>
            </li>
            <li class="user-list">
                <a href="?rol=empleado">
                    <p>Empleado</p>
                    <p><b>Usuario: ezequiel</b></p>
                    <p><b>Contraseña: eze123</b></p>
                </a>
            </li>
            <li class="user-list">
                <a href="?rol=profesor">
                    <p>Profesor</p>
                    <p><b>Usuario: omonte</b></p>
                    <p><b>Contraseña: omonte123</b></p>
                </a>
            </li>
        </ul>
    </main>


</body>

</html>