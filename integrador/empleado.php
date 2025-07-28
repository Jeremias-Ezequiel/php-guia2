<?php
session_start();
if ($_SESSION['rol'] != '2') {
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

        th,
        td {
            padding: 5px;
            border: 2px solid black;
        }

        .contactarAdmin {
            display: flex;
            flex-direction: column;
            width: 400px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Pagina de empleado</h1>
        <div>
            <p>Bienvenido <b><?= $user ?></b></p>
            <a href="./logout.php?cerrar"><button>Cerrar sesion</button></a>
        </div>
    </header>
    <main style="display: flex;gap: 30px;">
        <div class=admin>
            <ul>
                <li>
                    <form method=get>
                        <!-- generar la busqueda dependiendo de la opcion ingresada
            por el usuario, puede ser en la misma pag o en otra-->
                        <input type=text name=buscado required>

                        <input type=radio name=op value=codigo required>Código
                        <input type=radio name=op value=descripcion required>Descripción

                        <input type=submit name="buscar" value=Buscar>

                    </form>
                </li>
                <li>
                    <a href='?listar'><button>Lista de Productos</button></a>
                </li>
            </ul>
        </div>
        <section style="display: flex; justify-content:center; align-items:center;">
            <form action="" class="contactarAdmin">
                <h2>Enviar comentario al administrador</h2>
                <textarea name="mensaje" id="comentario" style="height: 100px;">

                </textarea>
                <button style="padding: 5px; margin: 10px 0px;" type="submit" name="enviarMsj">Enviar comentario</button>
                <?php
                if (isset($_GET['enviarMsj'])) {
                    echo "<p><b>El mensaje se ha enviado correctamente</b></p>";

                    $archivo = fopen('comentarios.txt', 'a');
                    $fechaHora = date('Y-m-d H:i:s');
                    $comentario = $_GET['mensaje'];
                    $empleado = $_SESSION['usuario'];

                    $mensaje = "<li><p>$fechaHora - <b style='color : red'>$empleado</b> - <b>$comentario</b></p></li>";
                    fwrite($archivo, $mensaje);
                    fclose($archivo);
                }
                ?>
            </form>
        </section>
    </main>


    <?php

    //#region LISTAR
    if (isset($_GET['listar'])) {
        require_once 'conexion.php';
        $query = "SELECT * FROM productos;";
        $con = conectar();
        $result = mysqli_query($con, $query);
        if ($result) {
            mostrarProductos($result);
        } else {
            echo "<p>No hay productos</p>";
        }
    }
    //#endregion LISTAR

    //#region BUSCAR
    if (isset($_GET['buscar'])) {
        $busqueda = $_GET['buscado'];
        $opcion = $_GET['op'];
        require_once 'conexion.php';
        $con = conectar();
        switch ($opcion) {
            case 'codigo':
                $busqueda = (int)$busqueda;
                $query = "SELECT * FROM productos WHERE $opcion=$busqueda";
                $result = mysqli_query($con, $query);
                if (mysqli_affected_rows($con) > 0) {
                    mostrarProductos($result);
                } else {
                    echo "<p>No hay productos con compatibles con la busqueda</p>";
                }
                break;
            case 'descripcion':
                $query = "SELECT * FROM productos WHERE $opcion LIKE '%$busqueda%'";
                $result = mysqli_query($con, $query);
                if (mysqli_affected_rows($con) > 0) {
                    mostrarProductos($result);
                } else {
                    echo "<p>No hay productos con compatibles con la busqueda</p>";
                }
                break;
            default:
                echo "<p>Sucedio algo inesperado</p>";
                break;
        }
    }
    //#endregion BUSCAR

    function mostrarProductos($resultado)
    {
    ?>
        <table>
            <form>
                <tr>
                    <th>Descripcion</th>
                    <th>Precio</th>
                </tr>
                <?php
                while ($res = mysqli_fetch_assoc($resultado)) {
                ?>
                    <tr>
                        <td><?= $res['descripcion'] ?></td>
                        <td><?= $res['precio'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </form>
        </table>
    <?php
    }
    ?>

</body>

</html>