<?php
session_start();
if ($_SESSION['rol'] != '3') {
    echo "<p>No tienes acceso a esta pagina</p>";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <a href="../integrador/profesor.php"><button>Volver</button></a>
    </div>
    <h2>Tablas</h2>

    <form>
        <label for="columnas">Columnas:</label>
        <input type="number" autofocus id="columnas" name="columnas" required>
        <label for="filas">Filas:</label>
        <input type="number" id="filas" name="filas" required>
        <br>
        <label for="pixel">Borde:</label>
        <select name="pixel" id="pixel" required>
            <option value="1">1px</option>
            <option value="2">2px</option>
            <option value="3">3px</option>
            <option value="4">4px</option>
            <option value="5">5px</option>
        </select>
        <select name="tipo" id="tipo" required>
            <option value="solid">Solido</option>
        </select>
        <label for="color-borde">Color de borde:</label>
        <input type="color" name="color-borde" required>
        <label for="color-fondo">Color de fondo:</label>
        <input type="color" name="color-fondo" required>
        <button name="crear" type="submit">Crear</button>
    </form>

    <?php
    if (isset($_GET['crear'])) {
        $columnas = $_GET['columnas'];
        $filas = $_GET['filas'];
        $pixel = $_GET['pixel'] . 'px';
        $tipo_borde = $_GET['tipo'];
        $color_borde = $_GET['color-borde'];
        $color_fondo = $_GET['color-fondo'];

        echo "<h2> Matriz de $columnas x $filas</h2>";
        echo "<table style='border-collapse : collapse'>";
        for ($i = 0; $i < $filas; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $columnas; $j++) {
                echo "<td style='border : $pixel $tipo_borde $color_borde; padding : 3px; background-color: $color_fondo'>[$i][$j]</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "<h2>Array formado</h2>";
        for ($i = 0; $i < $filas; $i++) {
            for ($j = 0; $j < $columnas; $j++) {
                echo "<p>fila $i columna $j => valor: [$i][$j]</p>";
            }
        }
    }
    ?>

</body>

</html>