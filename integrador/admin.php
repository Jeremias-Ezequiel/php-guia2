<?php
session_start();
if ($_SESSION['rol'] != '1') {
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

        button {
            padding: 5px;
            cursor: pointer;
        }

        .agregar-productos {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }


        .modificar-producto {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .formulario-producto {
            display: flex;
            flex-direction: column;
            width: 500px;
        }

        .formulario-producto button {
            margin-top: 20px;
        }

        .formulario-producto p {
            background-color: green;
            color: white;
            padding: 20px;
            border-radius: 10px;
            font-size: 15px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .tabla-productos {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .tabla-opciones {
            text-align: center;
        }

        tbody {
            background-color: white;
        }

        tbody input {
            cursor: pointer;
        }

        .comentarios li {
            background-color: white;
            list-style: none;
            padding: 5px;
            border-radius: 10px;
            margin: 10px 0px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Pagina de Administrador</h1>
        <div>
            <p>Bienvenido <b><?= $user ?></b></p>
            <a href="./logout.php?cerrar"><button>Cerrar sesion</button></a>
        </div>
    </header>
    <div class=admin>
        <ul>
            <li>
                <a href='?ingresar'><button>Ingresar Productos</button></a>
            </li>
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
            <li>
                <a href="?verComentarios"><button>Ver comentarios</button></a>
            </li>
        </ul>
    </div>

    <?php

    //#region crear
    if (isset($_GET['ingresar'])) {
    ?>
        <section class="agregar-productos">
            <h2>Ingresar producto</h2>
            <form method="post" class="formulario-producto">
                <label for="descripcion">Descripcion:</label>
                <input type="text" name="descripcion" maxlength="60" placeholder="Ingrese una descripción..." required>
                <label for="precio">Precio:</label>
                <input type="number" max="999999.99" min="1" name="precio" required placeholder="Ingrese el precio">
                <button type="submit" name="crear">Crear</button>
            <?php
        }
        if (isset($_POST['crear'])) {
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            require_once 'conexion.php';
            $con = conectar();
            $query = "INSERT INTO productos VALUES (null,'$descripcion', $precio);";
            mysqli_query($con, $query);

            if (mysqli_affected_rows($con) > 0) {
                echo "<p>El producto $descripcion se ha creado correctamente!</p>";
            } else {
                echo "<p>No se ha creado el producto</p>";
            }
        } ?>
            </form>
        </section>

        <?php
        //#endregion crear

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

        //#region MODIFICAR
        if (isset($_GET['mod'])) {
            $idProd = (float) $_GET['selec'];
            require_once 'conexion.php';
            $con = conectar();
            $query = "SELECT * FROM productos WHERE codigo=$idProd";
            $result = mysqli_query($con, $query);
            $prod = mysqli_fetch_assoc($result);
        ?>
            <section class="modificar-producto">
                <h2>Modificar producto</h2>
                <form method="post" class="formulario-producto">
                    <input type="hidden" name="codigo" value="<?= $prod['codigo'] ?>">
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" name="descripcion" maxlength="60" value="<?= $prod['descripcion'] ?>" required>
                    <label for="precio">Precio:</label>
                    <input type="number" max="999999.99" min="1" name="precio" required value="<?= $prod['precio'] ?>">
                    <button type="submit" name="modificar">Modificar</button>
                </form>
                <?php
                if (isset($_POST['modificar'])) {
                    $nuevaDes = $_POST['descripcion'];
                    $nuevoPrec = (float)$_POST['precio'];
                    $id = (int)$_POST['codigo'];
                    $query = "UPDATE productos SET descripcion='$nuevaDes', precio=$nuevoPrec WHERE codigo=$id";
                    $resultado = mysqli_query($con, $query);
                    if ($resultado) {
                        echo "<p>El producto se ha actualizado correctamente";
                    } else {
                        echo "<p>La actualizacion del producto ha fallado</p>";
                    }
                } ?>
            </section>
        <?php
        }

        //#endregion MODIFICAR

        //#region ELIMINAR
        if (isset($_GET['eliminar'])) {
            $idProd = (int) $_GET['selec'];
            require_once 'conexion.php';
            $con = conectar();
            $query = "SELECT * FROM productos WHERE codigo=$idProd";
            $result = mysqli_query($con, $query);
            $prod = mysqli_fetch_assoc($result);
        ?>
            <form method="post" style="display: flex; justify-content: center; align-items:center; flex-direction : column">
                <input type="hidden" name="codigo" value="<?= $prod['codigo']; ?>">
                <h2>Estas seguro que quieres eliminar? <?= $prod['descripcion'] ?></h2>
                <div style="display: flex; gap: 30px;">
                    <button type="submit" name="no" style="padding: 10px;">NO</button>
                    <button type="submit" name="si" style="padding: 10px;">SI</button>
                </div>
                <?php
                if (isset($_POST['si'])) {
                    $id = (int)$_POST['codigo'];
                    $q = "DELETE FROM productos WHERE codigo=$id";
                    $result = mysqli_query($con, $q);

                    # Mejorar la eliminacion, ya que elimina y se puede borrar nuevamente causando un error
                    if ($result) {
                        echo "<p>El producto " . $prod['descripcion'] . " ha sido eliminado con exito</p>";
                    } else {
                        echo "Ha ocurrido un erro al eliminar el producto";
                    }
                } else if (isset($_POST['no'])) {
                    header('Location: admin.php?listar');
                    die();
                }
                ?>
            </form>
        <?php
        }

        //#endregion ELIMINAR

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
            <table class="tabla-productos">
                <tbody>
                    <form>
                        <tr>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Seleccionar</th>
                        </tr>
                        <?php
                        while ($res = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>
                                <td><?= $res['descripcion'] ?></td>
                                <td>$<?= $res['precio'] ?></td>
                                <td>
                                    <input type="radio" name="selec" required value="<?= $res['codigo'] ?>">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="3" class="tabla-opciones">
                                <button type="submit" name="mod">Modificar</button>
                                <button type="submit" name="eliminar">Eliminar</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        <?php
        }

        #region ver Comentarios
        if (isset($_GET['verComentarios'])) {
            if (file_exists('comentarios.txt') && filesize('comentarios.txt') > 0) {
                $archivo = fopen('comentarios.txt', 'r');

                $todo = filesize('comentarios.txt');
                echo "<h2 style='text-align: center;'>Comentarios</h2>";
                echo "<ul class='comentarios'>";
                echo fread($archivo, $todo);
                echo "</ul>";
                fclose($archivo);
            } else {
                echo "<p>Nadie ha dejado un comentario aun</p>";
            }
        }
        #endregion ver comentarios
        ?>

</body>

</html>