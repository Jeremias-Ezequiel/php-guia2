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
    <h2>Grupos de trabajo</h2>
    <form method="get">
        <div>
            <label for="cantAlu">Cantidad de alumnos:</label>
            <input type="number" name="cantAlu" id="cantAlu" min="1" required>
        </div>
        <div>
            <label for="aluPorGrupo">Alumnos por grupo:</label>
            <input type="number" name="aluPorGrupo" id="aluPorGrupo" min="1" required>
        </div>
        <button type="submit" name="calcular">Calcular grupos</button>
    </form>

    <?php
    if (isset($_GET['calcular'])) {
        $cantAlu = $_GET['cantAlu'];
        $aluPorGrupo = $_GET['aluPorGrupo'];

        calcularGrupos($cantAlu, $aluPorGrupo);
    }
    function calcularGrupos($cantidadAlu, $alumnosPorGrupo)
    {
        $grupos = (int)($cantidadAlu / $alumnosPorGrupo);
        $libres = $cantidadAlu % $alumnosPorGrupo;
        echo "<p>$cantidadAlu alumnos en grupos de $alumnosPorGrupo</p>";
        echo "<p>Se pueden armar $grupos de $alumnosPorGrupo y quedan $libres alumnos por ubicar</p>";
    }
    ?>
</body>

</html>