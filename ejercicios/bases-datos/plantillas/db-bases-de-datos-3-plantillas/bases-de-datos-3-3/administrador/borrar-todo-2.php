<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();
if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
}

$pdo = conectaDb();

cabecera("Borrar todo 2", MENU_PERSONAS, PROFUNDIDAD_1);

borraTodo();

$pdo = null;

pie();
