<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "biblioteca.php";

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
}

$pdo = conectaDb();

cabecera("Borrar todo 2", MENU_VOLVER);

borraTodo();

$pdo = null;

pie();
