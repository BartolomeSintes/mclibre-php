<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
}

$db = conectaDb();
cabecera("Borrar todo 2", MENU_VOLVER);
borraTodo($db, $tablaAgenda, $consultaCreaTabla);

$db = null;
pie();
