<?php

function conectar()
{
    $serv = "localhost";
    $usr = "root";
    $pss = "Abcdef2020";
    $bd = "jeremiasOmonteGuia2";
    $port = 3306;
    //el nombre de la base de datos debe ser nombreApellidoGuia2 ej: juanPerezGuia2
    //No olvidar adjuntar el archivo SQL con el codigo de creación original (NO EXPORTAR)

    $c = mysqli_connect($serv, $usr, $pss, $bd, $port);

    return $c;
}
