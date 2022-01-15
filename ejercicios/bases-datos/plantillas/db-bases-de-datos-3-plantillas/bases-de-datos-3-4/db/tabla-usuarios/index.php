<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"])) {
    header("Location:../../index.php");
    exit;
}

cabecera("Usuarios - Inicio", MENU_USUARIOS, PROFUNDIDAD_2);

pie();
