<?php
/**
 * Bases de datos 3-1 - borrar-todo-2.php
 *
 * @author    Escriba su nombre
 *
 */

require_once "biblioteca.php";

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
} else {
    $db = conectaDb();
    cabecera("Borrar todo 2", MENU_VOLVER);
    borraTodo($db);
    $db = null;
    pie();
}
