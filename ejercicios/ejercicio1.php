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
    <link rel="stylesheet" href="ejercicio1.css">
    <title>Document</title>
</head>

<body>
    <div>
        <a href="../integrador/profesor.php"><button>Volver</button></a>
    </div>

    <p>En una clase hay 20 alumnos y se necesita dividirlos en 4 grupos (A,B,C y D) de 5 personas. Se pide crear un programa que divida los grupos aleatoriamente y me muestre quienes sno los integrantes de cada grupo. Crear un array $alumno que contenga los nombres de los 20 alumnos. Cada vez que se refresque la página deben rearmarse los grupos de manera aleatoria. Los grupos deben mostrarse en tablas</p>

    <?php
    $grupos = 4;
    $alumnos = [
        "Andrea",
        "Beatriz",
        "Cristian",
        "Diego",
        "Enrique",
        "Fabián",
        "Gustavo",
        "Hernán",
        "Irma",
        "Juan",
        "Kiara",
        "Leonardo",
        "Mario",
        "Nicolás",
        "Oscar",
        "Patricia",
        "Quentin",
        "Rodrigo",
        "Sergio",
        "Tamara"
    ];

    $abecedario = range('A', 'Z');

    function getGroups($groupsQuantity, $elements)
    {
        $quantity = count($elements) / $groupsQuantity;
        shuffle($elements);
        return array_chunk($elements, $quantity);
    }

    function showGroups($groups, $indices)
    {
        foreach ($groups as $index => $grupo) {
    ?>
            <table>
                <tr>
                    <th>Grupo <?= $indices[$index] ?></th>
                </tr>
                <?php
                foreach ($grupo as $alumno) {
                    echo "<tr><td>$alumno</td></tr>";
                }
                ?>
            </table>
    <?php
        }
    }

    $result = getGroups($grupos, $alumnos);
    ?>
    <div class="resultado">
        <?=
        showGroups($result, $abecedario);
        ?>
    </div>

</body>

</html>