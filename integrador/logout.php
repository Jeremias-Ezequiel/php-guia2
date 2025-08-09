<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

session_start();
# Cerrar sesion
if (isset($_GET['cerrar']) && isset($_SESSION['tiempoInicio'])) {

    $_SESSION['tiempoFin'] = date('Y-m-d H:i:s');

    # Usa POO para calcular matematicamente la diferencia entre dos horarios
    $fechaInicio = new DateTime($_SESSION['tiempoInicio']);
    $fechaFin = new DateTime($_SESSION['tiempoFin']);
    $diferencia = $fechaInicio->diff($fechaFin);
    $dias = $diferencia->d;
    $horas = $diferencia->h;
    $minutos = $diferencia->i;
    $segundos = $diferencia->s;
    $tiempoInicio = $_SESSION['tiempoInicio'];
    $usuario = $_SESSION['usuario'];
    $mensaje = "$tiempoInicio - Inicio de sesion del usuario $usuario, transcurrieron $dias dias, $horas horas, $minutos minutos y $segundos segundos hasta cerrar sesion \n";

    # Manejo de archivos
    $archivo = fopen('accesos.txt', 'a');
    fwrite($archivo, $mensaje);
    fclose($archivo);

    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
