<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

$usuario = strtolower($_POST['usuario']);
$pass = $_POST['pass'];

require_once 'conexion.php';
$con = conectar();

$query = "SELECT * FROM usuarios WHERE usuario='$usuario'";

$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if ($user['usuario'] == $usuario) {
    if ($user['pass'] == $pass) {
        session_start();
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol_id'];

        # Guardamos la hora de inicio
        $_SESSION['tiempoInicio'] = date('Y-m-d H:i:s');

        switch ($user['rol_id']) {
            case '1':
                header('Location: admin.php');
                exit();
                break;
            case '2':
                header('Location: empleado.php');
                exit();
                break;
            case '3':
                header('Location: profesor.php');
                exit();
                break;
            default:
                die('Ocurrio un error');
        }
    } else {
        header('Location: index.php?nopass');
        die();
    }
} else {
    header('Location: index.php?nouser');
    die();
}
