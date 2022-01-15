<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit();
}

$usuario  = recoge("usuario");
$password = recoge("password");

if ($usuario != $cfg["rootName"] || encripta($password) != $cfg["rootPassword"]) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
    exit();
}

$_SESSION["conectado"] = true;

header("Location:../index.php");

exit();
