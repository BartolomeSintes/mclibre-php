<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$borrar = recoge("borrar", default: "No", allowed: ["No", "Sí"]);

if ($borrar != "Sí") {
    header("Location:index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Personas - Borrar todo 2", MENU_PERSONAS, PROFUNDIDAD_1);

borraTodo();

pie();
