<?php
session_start();
if ($_SESSION['rol'] != '3') {
    echo "<p>No tienes acceso a esta pagina</p>";
    die();
}
$user = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href=estilo.css rel=stylesheet>
    <style>
        header {
            display: flex;
            justify-content: space-around;
        }

        header div {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        table {
            border-collapse: collapse;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <h1>Pagina de profesor</h1>
        <div>
            <p>Bienvenido <b><?= $user ?></b></p>
            <p>Nuestra próxima clase es el dia: 15/08/2025</p>
            <a href="./logout.php?cerrar"><button>Cerrar sesion</button></a>
        </div>
    </header>
    <main>
        <div>
            <ul>
                <li><a href="../ejercicios/ejercicio1.php"><button>Ejercicio 1</button></a></li>
                <li><a href="../ejercicios/ejercicio2.php"><button>Ejercicio 2</button></a></li>
                <li><a href="../ejercicios/ejercicio3.php"><button>Ejercicio 3</button></a></li>
                <li><a href="../ejercicios/ejercicio4.php"><button>Ejercicio 4</button></a></li>
                <li><a href="../ejercicios/ejercicio5.php"><button>Ejercicio 5</button></a></li>
            </ul>
        </div>
    </main>

</body>

</html>