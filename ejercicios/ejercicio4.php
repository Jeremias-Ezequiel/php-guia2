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
    <h2 style="text-align:center;">Creación de formas geométricas</h2>
    <section style="display: flex; justify-content:center; align-items:center;padding:5px;">
    <form method="get">
        <label for="base">Base:</label>
        <input type="number" name="base" required min="1" max="70">
            <label for="colorBorde">Color de borde</label>
        <input type="color" name="colorBorde" required>
        <label for="colorFondo">Color de fondo</label>
        <input type="color" name="colorFondo" required>
        <select name="figura" id="figura" required>
            <option value="" selected disabled>Seleccione una figura</option>
            <option value="triangulo">Triangulo</option>
            <option value="cuadrado">Cuadrado</option>
            <option value="rombo">Rombo</option>
        </select>
        <button type="submit" name="crear">Crear forma</button>
    </form>
    </section>

    <div style="display: flex; justify-content: center; align-items: center;flex-direction: column;">
    <?php
    if (isset($_GET['crear'])) {
        $base = $_GET['base'];
        $colorBorde = $_GET['colorBorde'];
        $colorFondo = $_GET['colorFondo'];
        $figura = $_GET['figura'];
        echo "<p>$figura base $base</p>";
        switch ($figura) {
            case 'cuadrado':
                echo "<pre style='line-heigh : 0.8'>";
                dibujarCuadrado($base, $colorBorde, $colorFondo);
                echo "</pre>";
                break;
            case 'triangulo':
                echo "<pre style='line-heigh : 0.8'>";
                dibujarTriangulo($base, $colorBorde, $colorFondo);
                echo "</pre>";
                break;
            case 'rombo':
                echo "<pre style='line-heigh : 0.8'>";
                dibujarRombo($base, $colorBorde, $colorFondo);
                echo "</pre>";
                break;
            default:
                echo "Elegí otro";
                break;
        }
    }
    ?>
    </div>
    <?php
    function dibujarCuadrado($base, $borde, $fondo)
    {
        for ($i = 0; $i < $base; $i++) {
            for ($j = 0; $j < $base; $j++) {
                if ($j == 0 || $j == ($base - 1) || $i == 0 || $i == ($base - 1)) {
                    echo "<span style='color : $borde'>*</span>";
                } else {
                    echo "<span style='color : $fondo'>*</span>";
                }
            }
            echo "<br>";
        }
    }

    function dibujarTriangulo($base, $borde, $fondo)
    {
        if ($base % 2 == 0) {
            $base += 1;
        }

        // Para saber la cantidad de filas, dividimos la base por 2
        $altura = floor($base / 2);
        for ($i = 0; $i <= $altura; $i++) {
            for ($j = 0; $j < $base; $j++) {
                if ($i == $altura || $j == ($altura - $i) || $j == ($altura + $i)) {
                    echo "<span style='color : $borde'>*</span>";
                } else if ($j > ($altura - $i) && $j < ($altura + $i)) {
                    echo "<span style='color : $fondo'>*</span>";
                } else {
                    echo " ";
                }
            }
            echo "<br>";
        }
    }

    function dibujarRombo($base, $borde, $fondo)
    {
        if ($base % 2 == 0) {
            $base += 1;
        }

        # Centro el rombo
        $centro = floor($base / 2);

        for ($i = 0; $i < $base; $i++) {
            $espacios = abs($centro - $i);
            $asteriscos = $base - (2 * $espacios);

            for ($j = 0; $j < $espacios; $j++) {
                echo " ";
            }

            for ($j = 0; $j < $asteriscos; $j++) {
                if ($j == 0 || $j == ($asteriscos - 1)) {
                    echo "<span style='color : $borde'>*</span>";
                } else {
                    echo "<span style='color : $fondo'>*</span>";
                }
            }

            echo "<br>";
        }
    }
    ?>
</body>

</html>