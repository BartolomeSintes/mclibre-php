<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
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
