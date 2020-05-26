<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();

if (!isset($_SESSION["conectado"])) {
    cabecera("Inicio", MENU_PRINCIPAL, 0);
} else {
    cabecera("Inicio", MENU_PRINCIPAL_CONECTADO, 0);
}

pie();
